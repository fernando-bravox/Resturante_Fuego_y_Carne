document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const errorMessage = urlParams.get('error');
    const successMessage = urlParams.get('success');
    
    if (errorMessage) {
        document.getElementById('errorMessage').textContent = errorMessage;
    }
    if (successMessage) {
        document.getElementById('successMessage').textContent = successMessage;
    }
});
