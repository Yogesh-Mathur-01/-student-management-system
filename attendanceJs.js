// Function to submit attendance
function submitAttendance() {
    var enroll = document.getElementById("enroll").value;
    var name = document.getElementById("name").value;

    // Send AJAX request to check if student is registered and attendance is submitted
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "attendance.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.registered && !response.attendanceSubmitted) {
                    document.getElementById("attendanceForm").submit();
                } else {
                    var message = response.registered ? "You have already submitted attendance for today." : "Only registered students can submit attendance.";
                    document.getElementById("modalText").innerText = message;
                    modal.style.display = "block";
                }
            } catch (error) {
                console.error("Error parsing JSON response:", error);
                // Handle error (e.g., display a generic error message)
            }
        }
    };
    xhr.send("enroll=" + enroll);
}
