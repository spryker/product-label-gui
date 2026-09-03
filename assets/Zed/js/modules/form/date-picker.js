/**
 * Copyright (c) 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

'use strict';

/**
 * Legacy jQuery datepicker setup, including the manual min/max bookkeeping that keeps the two ends
 * of the validity range consistent.
 *
 * @deprecated Superseded by `DatePickerType` and the Gui DateTimePicker, which handle range linking
 *   declaratively. Kept only for installations running spryker/gui older than 5.4.0.
 *
 * @param {string} validFromSelector
 * @param {string} validToSelector
 *
 * @return {void}
 */
function initialize(validFromSelector, validToSelector) {
    // From spryker/gui 5.4.0 on, these fields are built with `DatePickerType`, which marks them with
    // `data-spryker-picker` and lets the Gui DateTimePicker initialize and range-link them. Older Gui
    // versions have no such type, so the legacy picker below is set up instead.
    if ($(validFromSelector).is('[data-spryker-picker]')) {
        return;
    }

    initDatePicker(validFromSelector, function (e) {
        var selectedDate = $(validFromSelector).datepicker('getDate');
        if (!selectedDate) {
            return;
        }

        selectedDate.setDate(selectedDate.getDate() + 1);
        $(validToSelector).datepicker('option', 'minDate', selectedDate);
    });

    initDatePicker(validToSelector, function () {
        var selectedDate = $(validToSelector).datepicker('getDate');
        if (!selectedDate) {
            return;
        }

        selectedDate.setDate(selectedDate.getDate() - 1);
        $(validFromSelector).datepicker('option', 'maxDate', selectedDate);
    });
}

/**
 * @param {string} nodeSelector
 * @param {function} onCloseCallback
 *
 * @return {void}
 */
function initDatePicker(nodeSelector, onCloseCallback) {
    $(nodeSelector).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 2,
        defaultDate: 0,
        onClose: onCloseCallback,
    });
}

module.exports = {
    initialize: initialize,
};
