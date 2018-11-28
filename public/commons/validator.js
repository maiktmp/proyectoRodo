/**
 *  Add error classes to parent
 *
 * @param $formGroup
 * @param message
 */
function addError($formGroup, message) {
    $formGroup.addClass('has-error');

    var $message = $('<div>', {class: 'help-block', text: message});
    $formGroup.append($message);
}

/**
 *  Add ok to parent
 *
 * @param $formGroup
 * @param div
 */

function addOk($formGroup, div) {
    $formGroup.removeClass('has-error');
    var $div = $('<div>', {class: 'help-block', text: div});
    $formGroup.append($div);
}

/**
 *  Removes error classes from parent
 * @param $formGroup
 */

function clearErrors($formGroup) {
    $formGroup.removeClass('has-error');
    $formGroup.find('.help-block').remove();
}

/**
 *  Validates name input
 *
 * @param $input
 * @returns {boolean}
 */

function validateName($input) {
    var name = $input.val().trim();
    return typeof name !== 'undefined' && name.length > 3;
}

/**
 *  Validates that input is not empty
 *
 * @param $input
 * @returns {boolean}
 */

function validateNonEmpty($input) {
    if (typeof $input === 'undefined' || typeof $input.val() === 'undefined') {
        return false;
    }

    var value = $input.val().trim();
    return typeof value !== 'undefined' && value.length > 0;
}

/**
 *  Validates email, it validates it has the correct format for an email.
 *
 * @param $input
 * @returns {boolean}
 */

function validateEmail($input) {
    var re = /\S+@\S+\.\S+/;
    return re.test($input.val());
}

/**
 *  Validates the input is an integer.
 *
 * @param $input
 * @returns {boolean}
 */

function validateInteger($input) {
    return !isNaN($input.val()) &&
        parseInt(Number($input.val())) == $input.val() &&
        !isNaN(parseInt($input.val(), 10));
}

/**
 *  Validates the input has only a numeric value.
 *
 * @param $input
 * @returns {boolean}
 */

function validateNumber($input) {
    return validateNonEmpty($input) && !isNaN($input.val());
}

/**
 *  Validates if bank chosen is not null
 *
 * @param $input
 * @returns {boolean}
 */

function validateBank($input) {
    var bank = $input.val();

    if (typeof bank !== 'undefined' && bank !== null) {
        return true;
    }

    return false;
}


/**
 * Check that input value contains only digits and
 * spaces and that length be greater of 5 chars
 *
 * @param $input
 */
function validatePhone($input) {
    var phone = $input.val();

    if (typeof phone !== 'undefined' && phone.trim().length > 3) {
        // TODO check only digits

        return true;
    }

    return false;
}

/**
 *  Validates clabe, for now it only validate it is not empty.
 *
 * @param $input
 * @returns {boolean}
 */

function validateClabe($input) {
    var clabe = $input.val();

    if (typeof clabe !== 'undefined' && clabe.trim().length > 0) {
        return true;
    }

    return false;
}
