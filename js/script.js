const signUpButton = document.getElementById("signUpButton");
const signInButton = document.getElementById("signInButton");
const signInForm = document.getElementById("signInForm");
const signUpForm = document.getElementById("signUpForm");

signUpButton.addEventListener("click", function () {
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
});

signInButton.addEventListener("click", function () {
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
});

function showNotification(message, redirectUrl) {
    alert(message);
    if (redirectUrl) {
        window.location.href = redirectUrl; 
    }
}

function login() {
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;

    if (email && password) {
        showNotification("Successfully logged in!", "homepage.php"); 
    } else {
        alert("Please enter both email and password.");
    }
}

function logout() {
    showNotification("Successfully logged out!", "index.php"); 
}

const loginButton = document.getElementById("loginButton");
if (loginButton) {
    loginButton.addEventListener("click", login);
}

const logoutButton = document.getElementById("logoutButton");
if (logoutButton) {
    logoutButton.addEventListener("click", logout);
}
function showNotification(message) {
    alert(message);
}

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    form.addEventListener("submit", (event) => {
        const itemName = document.getElementById("itemName").value.trim();
        const itemDescription = document.getElementById("itemDescription").value.trim();
        const itemPrice = document.getElementById("itemPrice").value.trim();
        const itemImage = document.getElementById("itemImage").files[0];

        if (!itemName || !itemDescription || !itemPrice || !itemImage) {
            event.preventDefault();
            showNotification("All fields are required!");
            return;
        }

        const allowedExtensions = ["jpg", "jpeg", "png"];
        const fileExtension = itemImage.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            event.preventDefault();
            showNotification("You can only upload JPG, JPEG, or PNG files!");
            return;
        }

        if (itemImage.size > 5000000) {
            event.preventDefault();
            showNotification("Your image file size must be less than 5MB!");
        }
    });
});


