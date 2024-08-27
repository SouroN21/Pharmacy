// Function to simulate viewing details
function viewDetails(type) {
    alert("Viewing details for " + type);
}

// Adding event listeners to the view buttons
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.view-button').forEach(button => {
        button.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            viewDetails(type);
        });
    });
});
