define (['Magento_Ui/js/grid/listing'], function (listing) {'use strict'; return listing.extend ({
	defaults: {template: 'Inkifi_MissingOrder/listing'}
	,getRowClass: function(r) {
		debugger;
		return r['df_class'];
	}
});});