
function showNotification(message, type = "success") {
    const notificationElement = document.getElementById("notification");

    notificationElement.innerHTML = "";
    notificationElement.className = ""; 
    notificationElement.innerHTML = message;

    if (type === "success") {
        notificationElement.classList.add("success-notification");
    } else if (type === "error") {
        notificationElement.classList.add("error-notification");
    }

    notificationElement.style.display = "block";

    setTimeout(() => {
        notificationElement.style.display = "none";
        notificationElement.className = ""; 
        notificationElement.innerHTML = "";
    }, 5000); 
}

function showSuccessNotification(message) {
    showNotification(message, "success");
}

function showErrorNotification(message) {
    showNotification(message, "error");
}
