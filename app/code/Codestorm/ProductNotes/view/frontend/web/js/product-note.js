define([
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function (Component, customerData) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();

            const section = customerData.get('product_note');

            section.subscribe(function (data) {
                console.log('Product note updated', data);
            });
        }
    });
});