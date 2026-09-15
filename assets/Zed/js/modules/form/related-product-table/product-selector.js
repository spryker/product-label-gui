/**
 * Copyright (c) 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

'use strict';

function ProductSelector() {
    var productSelector = {};
    var selectedProducts = {};

    productSelector.addProductToSelection = function (idProduct, row) {
        selectedProducts[idProduct] = row;
    };

    productSelector.removeProductFromSelection = function (idProduct) {
        delete selectedProducts[idProduct];
    };

    productSelector.isProductSelected = function (idProduct) {
        return selectedProducts.hasOwnProperty(idProduct);
    };

    productSelector.clearAllSelections = function () {
        selectedProducts = {};
    };

    productSelector.getSelected = function () {
        return selectedProducts;
    };

    /**
     * @return {Array} Rows of everything selected, the table of the selection is built from them.
     */
    productSelector.getRows = function () {
        return Object.keys(selectedProducts).map(function (id) {
            return selectedProducts[id];
        });
    };

    return productSelector;
}

module.exports = {
    /**
     * @return {ProductSelector}
     */
    create: function () {
        return new ProductSelector();
    },
};
