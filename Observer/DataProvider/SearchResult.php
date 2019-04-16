<?php
namespace Inkifi\MissingOrder\Observer\DataProvider;
use Df\Framework\Plugin\View\Element\UiComponent\DataProvider\DataProvider as Plugin;
use Magento\Framework\Api\Search\SearchResult as ApiSearchResult;
use Magento\Framework\Api\Search\SearchResultInterface as ISearchResult;
use Magento\Framework\DB\Select;
use Magento\Framework\Event\Observer as Ob;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider as Provider;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult as UiSearchResult;
use Magento\Sales\Model\ResourceModel\Order\Creditmemo\Grid\Collection as CreditmemoGC;
use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as OrderGC;
use Magento\Sales\Model\ResourceModel\Order\Invoice\Grid\Collection as InvoiceGC;
use Mangoit\MediaclipHub\Model\Orders as mOrder;
// 2019-01-09
final class SearchResult implements ObserverInterface {
	/**
	 * 2019-01-09
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param Ob $o
	 */
	function execute(Ob $o) {
		$provider = $o[Plugin::PROVIDER]; /** @var Provider $provider */
		/** @var ISearchResult|ApiSearchResult|UiSearchResult|OrderGC|InvoiceGC|CreditmemoGC $result */
		$r = $o[Plugin::RESULT];
		// 2017-08-02 For now, we do not handle «sales_order_invoice_grid_data_source»
		// and «sales_order_creditmemo_grid_data_source».
		if ('sales_order_grid_data_source' === $provider->getName()) {
			/**
			 * 2019-01-09
			 * https://github.com/magento/magento2/blob/2.1.0/lib/internal/Magento/Framework/View/Element/UiComponent/DataProvider/SearchResult.php#L37-L40
			 * @see \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult::$document
			 * Структура документа описана здесь: https://mage2.pro/t/1908
			 */
			/** @var string[] $oids */  // 2019-04-16 «63922» or «staging-63922»
			$oids = df_map($r, function(Document $i) {return ikf_ite($i['entity_id']);});
			$f_MAGENTO_ORDER_ID = mOrder::F__MAGENTO_ORDER_ID; /** @var string $f_MAGENTO_ORDER_ID */
			$select = df_db_from('mediaclip_orders', [$f_MAGENTO_ORDER_ID, 'id']); /** @var Select $select */
			$select->where("$f_MAGENTO_ORDER_ID IN (?)", $oids);
			$map = df_conn()->fetchPairs($select); /** @var array(Magento order ID => Mediaclip order ID) $map */
			df_map($r, function(Document $i) use($map) {
				if (
					!in_array($i['status'], ['canceled', 'pending_payment'])
					&& !isset($map[ikf_ite($i['entity_id'])])
				) {
					$i['df_class'] = 'df-missed';
				}
			});
		}
	}
}