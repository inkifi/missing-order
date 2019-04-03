<?php
namespace Inkifi\MissingOrder;
use Magento\Sales\Model\Order as O;
use Mangoit\MediaclipHub\Observer\CheckoutSuccess as CS;
use Mangoit\MediaclipHub\Model\Orders as mOrder;
// 2019-01-29
final class Processor {
	/**
	 * 2019-01-29
	 * @return bool
	 */
	function eligible() {return
		!in_array($this->_o->getStatus(), ['canceled', 'pending_payment'])
		&& !df_fetch_one('mediaclip_orders', 'id', [mOrder::F__MAGENTO_ORDER_ID => $this->_o->getId()])
	;}

	/**
	 * 2019-01-29
	 */
	function post() {CS::post($this->_o);}

	/**
	 * 2019-01-29
	 * @used-by s()
	 * @param O $o
	 */
	private function __construct(O $o) {$this->_o = $o;}

	/**
	 * 2019-01-29
	 * @used-by pid()
	 * @var O
	 */
	private $_o;

	/**
	 * 2019-01-29
	 * @param int|null $oid [optional]
	 * @return self
	 */
	static function s($oid = null) {return dfcf(function($oid) {return
		new self(df_order($oid))
	;}, [intval($oid ?: df_request('order_id'))]);}
}