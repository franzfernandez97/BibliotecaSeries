// confirmDelete.js

/**
 * Attach confirmDelete functionality to forms with the name "delete_platform".
 */
document.querySelectorAll('form[name="delete_platform"]').forEach(form => {
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        const userConfirmed = confirm(
            "¿Está seguro de eliminar esta plataforma? Todas las series asociadas a ella serán eliminadas."
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
