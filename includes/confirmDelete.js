// confirmDelete.js

/**
 * Attach confirmDelete functionality to forms with the name "delete_platform".
 */
document.querySelectorAll('form[name="delete_form"]').forEach(form => {
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        const userConfirmed = confirm(
            "¿Está seguro de  ejecutar esta operación? Ten encuenta que información relacionada a este registro podría ser eliminada y no se podrá recuperar"
        );

        if (userConfirmed) {
            // Submit the specific form that triggered the event
            form.submit();
        } else {
            // Redirect to list.php if the user cancels
            window.location.href = "list.php";
        }
    });
});
