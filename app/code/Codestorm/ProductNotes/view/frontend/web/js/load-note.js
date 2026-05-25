define([
    'jquery',
    'mage/url'
], function ($, urlBuilder) {
    'use strict';

    return function (productId) {
        $.ajax({
            url: urlBuilder.build('productnotes/note/pdp'),
            type: 'GET',
            data: { product_id: productId },
            success: function (res) {
                $('#product-note-container').html(
                    res.note && res.note.content
                        ? '<div>' + res.note.content + '</div>'
                        : '<textarea name="content"></textarea>'
                );
            }
        });
    };
});