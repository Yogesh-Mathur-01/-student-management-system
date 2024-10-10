<!-- <?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login.html");
exit;
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout Confirmation</title>
  <style>
    /* Styles for the popup */
    .popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }
    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }
    /* Button Styles */
    .btn {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn-cancel {
      background-color: #dc3545;
    }
  </style>
</head>
<body>

<?php
// Handle logout confirmation
if (isset($_POST['confirm_logout'])) {
    // Perform logout action here, such as destroying session
    session_start();
    session_destroy();
    // Redirect to login page or any other appropriate page
    header("Location: login.php");
    exit();
}
?>

<!-- Confirmation Popup -->
<div class="overlay" id="overlay"></div>
<div class="popup" id="popup">
  <p>Are you sure you want to logout?</p>
  <form method="post">
    <button type="submit" class="btn" id="confirmBtn" name="confirm_logout">Yes</button>
    <button type="button" class="btn btn-cancel" id="cancelBtn">No</button>
  </form>
</div>

<!-- Logout Button -->
<form method="post">
  <button type="submit" class="btn" name="logout">Logout</button>
</form>

<script>
  // Get elements
  const overlay = document.getElementById('overlay');
  const popup = document.getElementById('popup');
  const confirmBtn = document.getElementById('confirmBtn');
  const cancelBtn = document.getElementById('cancelBtn');

  // Function to open popup
  function openPopup() {
    overlay.style.display = 'block';
    popup.style.display = 'block';
  }

  // Function to close popup
  function closePopup() {
    overlay.style.display = 'none';
    popup.style.display = 'none';
  }

  // Event listeners
  document.querySelector('form').addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent form submission
    openPopup();
  });
  confirmBtn.addEventListener('click', closePopup);
  cancelBtn.addEventListener('click', closePopup);
  overlay.addEventListener('click', closePopup);
</script>

</body>
</html>
