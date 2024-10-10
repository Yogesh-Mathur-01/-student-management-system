// homescript.js

// Get the profile button and popup menu
var profileBtn = document.getElementById("profileBtn");
var profilePopup = document.getElementById("profilePopup");

// Function to open the popup menu
function openPopup() {
    profilePopup.style.display = "block";
}

// Function to close the popup menu
function closePopup() {
    profilePopup.style.display = "none";
}

// Event listener to open the popup menu when the profile button is clicked
profileBtn.addEventListener("click", function() {
    openPopup();
});

// Event listener to close the popup menu when the close button is clicked
document.querySelector(".close-btn").addEventListener("click", function() {
    closePopup();
});


