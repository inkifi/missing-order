var i = 0;
define (['Magento_Ui/js/grid/listing'], function (listing) {'use strict'; return listing.extend ({
	defaults: {template: 'Inkifi_MissingOrder/listing'}
	,getRowClass: function(r) {return r['df_class'] ? r['df_class'] : (i++ % 2 ? '_odd-row' : '');}
});});