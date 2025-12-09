setTimeout(function() {
    document.querySelectorAll('.alert-container').forEach(function(alert) {
        alert.style.transition = "opacity 0.5s ease";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500); // remove do DOM após o fade
    });
}, 6000);