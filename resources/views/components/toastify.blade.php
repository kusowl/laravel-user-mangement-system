<script>
    function showSuccessToast(message) {
        const openDialog = document.querySelector('dialog[open]');

        if (openDialog) {
            // Create toast inside dialog but outside modal-box
            createToastInDialog(openDialog, message, 'success');
        } else {
            // Regular toast for non-dialog context
            Toastify({
                text: message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                    border_radius: "30px",
                    zIndex: "99999"
                },
            }).showToast();
        }
    }

    function showErrorToast(message) {
        const openDialog = document.querySelector('dialog[open]');

        if (openDialog) {
            // Create toast inside dialog but outside modal-box
            createToastInDialog(openDialog, message, 'error');
        } else {
            // Regular toast for non-dialog context
            Toastify({
                text: message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    zIndex: "99999"
                },
                onClick: function() {}
            }).showToast();
        }
    }

    // Function to create toast inside dialog
    function createToastInDialog(dialog, message, type = 'success') {
        // Check if toast container already exists in this dialog
        let toastContainer = dialog.querySelector('.dialog-toast-container');

        if (!toastContainer) {
            // Create toast container inside dialog but outside modal-box
            toastContainer = document.createElement('div');
            toastContainer.className = 'dialog-toast-container';
            toastContainer.style.cssText = `
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
            pointer-events: none;
        `;

            // Insert as first child of dialog (before modal-box)
            dialog.insertBefore(toastContainer, dialog.firstChild);
        }

        // Create individual toast
        const toast = document.createElement('div');
        const bgGradient = type === 'success' ?
            'linear-gradient(to right, #00b09b, #96c93d)' :
            'linear-gradient(to right, #ff5f6d, #ffc371)';

        toast.className = 'dialog-toast';
        toast.style.cssText = `
        background: ${bgGradient};
        color: white;
        padding: 12px 20px;
        border-radius: 30px;
        margin-bottom: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transform: translateX(100%);
        transition: transform 0.3s ease;
        pointer-events: auto;
        cursor: pointer;
        max-width: 300px;
        word-wrap: break-word;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
    `;

        // Add message and close button
        toast.innerHTML = `
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" style="
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-left: 10px;
            padding: 0;
            line-height: 1;
        ">&times;</button>
    `;

        toastContainer.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 10);

        // Auto remove after 3 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();

                        // Remove container if empty
                        if (toastContainer.children.length === 0) {
                            toastContainer.remove();
                        }
                    }
                }, 300);
            }
        }, 3000);
    }
</script>
