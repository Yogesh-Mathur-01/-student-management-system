function openPopup() {
    document.getElementById('profilePopup').style.display = 'block';
}

function closePopup() {
    document.getElementById('profilePopup').style.display = 'none';
}

document.getElementById('profileBtn').addEventListener('click', function() {
    openPopup();
});
