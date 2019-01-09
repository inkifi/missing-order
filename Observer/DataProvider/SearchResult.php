<?php
namespace Inkifi\MissingOrder\Observer\DataProvider;
use Df\Framework\Plugin\View\Element\UiComponent\DataProvider\DataProvider as Plugin;
use Magento\Framework\Api\Search\SearchResult as ApiSearchResult;
use Magento\Framework\Api\Search\SearchResultInterface as ISearchResult;
use Magento\Framework\Event\Observer as Ob;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider as Provider;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult as UiSearchResult;
use Magento\Sales\Model\ResourceModel\Order\Creditmemo\Grid\Collection as CreditmemoGC;
use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as OrderGC;
use Magento\Sales\Model\ResourceModel\Order\Invoice\Grid\Collection as InvoiceGC;
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
		$result = $o[Plugin::RESULT];
		// 2017-08-02 For now, we do not handle «sales_order_invoice_grid_data_source»
		// and «sales_order_creditmemo_grid_data_source».
		if ('sales_order_grid_data_source' === $provider->getName()) {
			/**
			 * 2019-01-09
			 * https://github.com/magento/magento2/blob/2.1.0/lib/internal/Magento/Framework/View/Element/UiComponent/DataProvider/SearchResult.php#L37-L40
			 * @see \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult::$document
			 * Структура документа описана здесь: https://mage2.pro/t/1908
			 */
			df_map($result, function(Document $item) {
				$item['df_class'] = 'complete';
			});
		}
	}
}