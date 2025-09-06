<script>
    function showSuccessToast(message) {
        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function () {
            }
        }).showToast();
    }

    function showErrorToast(message) {
        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "linear-gradient(to right, #ff5f6d, #ffc371)",
            },
            onClick: function () {
            }
        }).showToast();
    }

    function showValidationErrors(errors) {
        if (typeof errors === 'object' && !Array.isArray(errors)) {
// Laravel validation errors object
            Object.values(errors).forEach(errorArray => {
                errorArray.forEach(error => {
                    showErrorToast(error);
                });
            });
        } else if (Array.isArray(errors)) {
// Array of errors
            errors.forEach(error => {
                showErrorToast(error);
            });
        } else {
// Single error message
            showErrorToast(errors);
        }
    }
</script>
