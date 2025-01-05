function validatePhoneNumber(input_str) {
    var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    return re.test(input_str);
}

function validateForm(event) {
    var phone = document.getElementById('phone').value;
    if (!validatePhoneNumber(phone)) {
        document.getElementById('phone_error').classList.remove('hidden');
    } else {
        document.getElementById('phone_error').classList.add('hidden');
        window.location.href = 'error.html';
    }
    event.preventDefault();
}

document.addEventListener('DOMContentLoaded', () => {
    // Ensure `verifyform` exists before adding event listener
    const form = document.getElementById('verifyform');
    if (form) {
        form.addEventListener('submit', validateForm);
    } else {
        console.error('Form with ID "verifyform" not found.');
    }

    $('form').on('keyup', '#phone', function () {
        var $input = $(this),
            value = $input.val(),
            length = value.length,
            inputCharacter = parseInt(value.slice(-1));

        if (!((length > 1 && inputCharacter >= 0 && inputCharacter <= 9) || (length === 1 && inputCharacter >= 7 && inputCharacter <= 9))) {
            $input.val(value.substring(0, length - 1));
        }
    });
});
