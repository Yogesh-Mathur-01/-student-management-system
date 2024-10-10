// Validation functions
function validateEnrollInput(enrollInput) {
    var enrollValue = enrollInput.value.trim();

    if (enrollValue == "") {
        setError(enrollInput, "Enroll no can't be blank");
        return false;
    } else if (enrollValue.length <= 5) {
        setError(enrollInput, "Enroll no must be more than 4 digits");
        return false;
    } else if (enrollValue.length > 20) {
        setError(enrollInput, "Enroll No is too Big");
        return false;
    } else if (!/\d/.test(enrollValue)) {
        setError(enrollInput, "Enroll no must contain at least one number");
        return false;
    } else if ((enrollValue.match(/[a-zA-Z]/g) || []).length > 3) {
        setError(enrollInput, "Enroll no can contain a maximum of 3 alphabets");
        return false;
    } else if (/\s/.test(enrollValue)) {
        setError(enrollInput, "Enroll no  not contain space");
        return false;
    } else {
        setSuccess(enrollInput);
        return true;
    }
}




function validateFullnameInput(nameInput, fieldName) {
    var nameValue = nameInput.value.trim();

    if (nameValue == "") {
        setError(nameInput, fieldName + " can't be blank");
        return false;
    } else if (!/^[a-zA-Z\s]+$/.test(nameValue)) {
        setError(nameInput, fieldName + " must contain only alphabets");
        return false;
    } else if (nameValue.length < 6) {
        setError(nameInput, fieldName + " is too short");
        return false;
    } else if (nameValue.length > 20) {
        setError(nameInput, fieldName + " is too long");
        return false;
    } else {
        setSuccess(nameInput);
        return true;
    }
}

function validateFathernameInput(nameInput, fieldName) {
    var nameValue = nameInput.value.trim();

    if (nameValue == "") {
        setError(nameInput, fieldName + " can't be blank");
        return false;
    } else if (!/^[a-zA-Z\s]+$/.test(nameValue)) {
        setError(nameInput, fieldName + " must contain only alphabets");
        return false;
    } else if (nameValue.length < 4) {
        setError(nameInput, fieldName + " is too short");
        return false;
    } else if (nameValue.length > 20) {
        setError(nameInput, fieldName + " is too long");
        return false;
    } else {
        setSuccess(nameInput);
        return true;
    }
}

function validateMothernameInput(nameInput, fieldName) {
    var nameValue = nameInput.value.trim();

    if (nameValue == "") {
        setError(nameInput, fieldName + " can't be blank");
        return false;
    } else if (!/^[a-zA-Z\s]+$/.test(nameValue)) {
        setError(nameInput, fieldName + " must contain only alphabets");
        return false;
    } else if (nameValue.length < 4) {
        setError(nameInput, fieldName + " is too short");
        return false;
    } else if (nameValue.length > 20) {
        setError(nameInput, fieldName + " is too long");
        return false;
    } else {
        setSuccess(nameInput);
        return true;
    }
}

function validateDateOfBirth(dobInput) {
    var dobValue = dobInput.value.trim();

    if (dobValue == "") {
        setError(dobInput, "Date of Birth can't be blank");
        return false;
    }

    if (!isValidDate(dobValue)) {
        setError(dobInput, "Enter a valid Date of Birth (YYYY-MM-DD)");
        return false;
    }

    var currentDate = new Date();
    var selectedDate = new Date(dobValue);
    var minDate = new Date(currentDate.getFullYear() - 5, currentDate.getMonth(), currentDate.getDate());
    var maxDate = new Date(currentDate.getFullYear() - 150, currentDate.getMonth(), currentDate.getDate());

    if (selectedDate > minDate) {
        setError(dobInput, "Date of Birth should be at least 5 years old from the current date");
        return false;
    }

    if (selectedDate.getFullYear() >= currentDate.getFullYear()) {
        setError(dobInput, "Date of Birth should not be of the upcoming or current year");
        return false;
    }

    if (selectedDate < maxDate) {
        setError(dobInput, "Invalid Date of Birth!");
        return false;
    }

    setSuccess(dobInput);
    return true;
}

function isValidDate(dateString) {
    var regex = /^\d{4}-\d{2}-\d{2}$/;
    if (!regex.test(dateString)) return false;
    var parts = dateString.split("-");
    var year = parseInt(parts[0], 10);
    var month = parseInt(parts[1], 10);
    var day = parseInt(parts[2], 10);
    if (month < 1 || month > 12) return false;
    if (day < 1 || day > 31) return false;
    if ((month === 4 || month === 6 || month === 9 || month === 11) && day === 31) return false;
    if (month === 2) {
        var isLeapYear = (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
        if (day > 29 || (day === 29 && !isLeapYear)) return false;
    }
    return true;
}

function validateMobileNumber(mobileInput) {
    var mobileValue = mobileInput.value.trim();

    if (mobileValue == "") {
        setError(mobileInput, "Mobile number can't be blank");
        return false;
    } else if (!/^[6-9]\d{9}$/.test(mobileValue)) {
        setError(mobileInput, "Invalid mobile number");
        return false;
    } else if (mobileValue.length !== 10) {
        setError(mobileInput, "Mobile number must be 10 digits long");
        return false;
    } else if (!/^\d+$/.test(mobileValue)) {
        setError(mobileInput, "Mobile number must contain only digits");
        return false;
    } else {
        setSuccess(mobileInput);
        return true;
    }
}

function validateEmail(emailInput) {
    var emailValue = emailInput.value.trim();

    if (emailValue == "") {
        setError(emailInput, "Email address can't be blank");
        return false;
    } else if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(emailValue)) {
        setError(emailInput, "Invalid email address");
        return false;
    } else {
        setSuccess(emailInput);
        return true;
    }
}

function validateCategorySelection() {
    var categoryInput = document.getElementById("category");
    var selectedOption = categoryInput.value;

    // If no category is selected, display error message and return false
    if (selectedOption === "") {
        setError(categoryInput, "Please select a category.");
        return false;
    } else {
        setSuccess(categoryInput);
        return true;
    }
}

function validateaddressInput(nameInput, fieldName) {
    var nameValue = nameInput.value.trim();

    if (nameValue == "") {
        setError(nameInput, fieldName + " can't be blank");
        return false;
    }
    else if (nameValue.length < 4) {
        setError(nameInput, fieldName + " is too short");
        return false;
    } else if (nameValue.length > 40) {
        setError(nameInput, fieldName + " is too long");
        return false;
    } else {
        setSuccess(nameInput);
        return true;
    }
}

function validatecityInput(nameInput, fieldName) {
    var nameValue = nameInput.value.trim();

    if (nameValue == "") {
        setError(nameInput, fieldName + " can't be blank");
        return false;
    }
    else if (nameValue.length < 4) {
        setError(nameInput, fieldName + " is too short");
        return false;
    } else if (nameValue.length > 40) {
        setError(nameInput, fieldName + " is too long");
        return false;
    } else {
        setSuccess(nameInput);
        return true;
    }
}

function validatepincode(pincodeInput) {
    var pincodeValue = pincodeInput.value.trim();

    if (pincodeValue == "") {
        setError(pincodeInput, "Pin code can't be blank");
        return false;
    } else if (pincodeValue.length !== 6) {
        setError(pincodeInput, "Pin code must be 6 digits long");
        return false;
    } else if (!/^\d+$/.test(pincodeValue)) {
        setError(pincodeInput, "Pin code must contain only digits");
        return false;
    } else {
        setSuccess(pincodeInput);
        return true;
    }
}

function validatedepartSelection() {
    var departInput = document.getElementById("depart");
    var selectedOption = departInput.value;

    // If no category is selected, display error message and return false
    if (selectedOption === "") {
        setError(departInput, "Please select a Department.");
        return false;
    } else {
        setSuccess(departInput);
        return true;
    }
}

function validatebranchSelection() {
    var branchInput = document.getElementById("branch");
    var selectedOption = branchInput.value;

    // If no category is selected, display error message and return false
    if (selectedOption === "") {
        setError(branchInput, "Please select a Branch.");
        return false;
    } else {
        setSuccess(branchInput);
        return true;
    }
}

function validatecourseSelection() {
    var courseInput = document.getElementById("course");
    var selectedOption = courseInput.value;

    // If no category is selected, display error message and return false
    if (selectedOption === "") {
        setError(courseInput, "Please select a course.");
        return false;
    } else {
        setSuccess(courseInput);
        return true;
    }
}

function validatesemester(semesterInput) {
    var semesterValue = semesterInput.value.trim();

    if (semesterValue == "") {
        setError(semesterInput, "Semester can't be blank");
        return false;
    } else if (semesterValue >= 1 & semesterValue >= 9) {
        setError(semesterInput, "semester can't greater then 8")
        return false;

    } else {
        setSuccess(semesterInput);
        return true;
    }
}



// Event listeners for real-time validation
document.getElementById("Enroll_no").addEventListener("input", function (event) {
    validateEnrollInput(event.target);
});

document.getElementById("fullname").addEventListener("input", function (event) {
    validateFullnameInput(event.target, "Full name");
});

document.getElementById("fathername").addEventListener("input", function (event) {
    validateFathernameInput(event.target, "Father name");
});

document.getElementById("mothername").addEventListener("input", function (event) {
    validateMothernameInput(event.target, "Mother name");
});

document.getElementById("dob").addEventListener("input", function (event) {
    validateDateOfBirth(event.target);
});

document.getElementById("mobile").addEventListener("input", function (event) {
    validateMobileNumber(event.target);
});

document.getElementById("email").addEventListener("input", function (event) {
    validateEmail(event.target);
});

document.getElementById("category").addEventListener("change", function (event) {
    validateCategorySelection(event.target)
});

document.getElementById("address").addEventListener("input", function (event) {
    validateaddressInput(event.target, "Address");
});

document.getElementById("city").addEventListener("input", function (event) {
    validatecityInput(event.target, "city");
});

document.getElementById("pincode").addEventListener("input", function (event) {
    validatepincode(event.target);
});

document.getElementById("depart").addEventListener("change", function (event) {
    validatedepartSelection(event.target)
});

document.getElementById("branch").addEventListener("change", function (event) {
    validatebranchSelection(event.target)
});

document.getElementById("course").addEventListener("change", function (event) {
    validatecourseSelection(event.target)
});

document.getElementById("semester").addEventListener("input", function (event) {
    validatesemester(event.target);
});


// Form submission event listener
document.getElementById("btnsubmit").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default form submission behavior
    if (validateForm()) {
        document.getElementById("form").submit
            (); // Submit the form

    } else {
        showAlert("Please correct the errors before submitting.");
    }
});

// Form validation function
function validateForm() {
    var isValid = true;

    // Check each input field
    var enrollInput = document.getElementById("Enroll_no");
    if (!validateEnrollInput(enrollInput)) {
        isValid = false;
    }

    var fullnameInput = document.getElementById("fullname");
    if (!validateFullnameInput(fullnameInput, "Full name")) {
        isValid = false;
    }

    var fathernameInput = document.getElementById("fathername");
    if (!validateFathernameInput(fathernameInput, "Father name")) {
        isValid = false;
    }

    var mothernameInput = document.getElementById("mothername");
    if (!validateMothernameInput(mothernameInput, "Mother name")) {
        isValid = false;
    }

    var dobInput = document.getElementById("dob");
    if (!validateDateOfBirth(dobInput)) {
        isValid = false;
    }

    var mobileInput = document.getElementById("mobile");
    if (!validateMobileNumber(mobileInput)) {
        isValid = false;
    }

    var emailInput = document.getElementById("email");
    if (!validateEmail(emailInput)) {
        isValid = false;
    }

    var isValidCategory = validateCategorySelection();
    if (!isValidCategory) {
        isValid = false;
    }

    var addressInput = document.getElementById("address");
    if (!validateaddressInput(addressInput, "Father name")) {
        isValid = false;
    }

    var cityInput = document.getElementById("city");
    if (!validatecityInput(cityInput, "Father name")) {
        isValid = false;
    }

    var pincodeInput = document.getElementById("pincode");
    if (!validatepincode(pincodeInput)) {
        isValid = false;
    }

    var isValiddepart = validatedepartSelection();
    if (!isValiddepart) {
        isValid = false;
    }

    var isValidbranch = validatebranchSelection();
    if (!isValidbranch) {
        isValid = false;
    }

    var isValidcourse = validatecourseSelection();
    if (!isValidcourse) {
        isValid = false;
    }

    var semesterInput = document.getElementById("semester");
    if (!validatesemester(semesterInput)) {
        isValid = false;
    }

    return isValid;
}



function setError(u, msg) {
    var parentBox = u.parentElement;
    parentBox.className = "inputClass error"; // Corrected class name to match your HTML structure
    var span = parentBox.querySelector("span");
    var fa = parentBox.querySelector(".fa");
    span.innerText = msg;
    fa.className = "fa fa-exclamation-circle";
}



function setSuccess(inputField) {
    var parentBox = inputField.parentElement;
    var fa = parentBox.querySelector(".fa");

    // Check if the input field is empty
    if (inputField.value.trim() === "") {
        parentBox.classList.remove("success"); // Remove 'success' class if input is empty
        fa.className = ""; // Reset the class for the icon
    } else {
        parentBox.classList.add("success"); // Add 'success' class if input is not empty
        fa.className = "fa fa-check-circle"; // Use the correct class for the success icon
    }
}

document.getElementById('depart').addEventListener('change', function () {
    var selectedDepartment = this.value;
    console.log("Selected Department: " + selectedDepartment); // Debugging

    var branchSelect = document.getElementById('branch');
    var courseSelect = document.getElementById('course');

    // Clear existing options
    branchSelect.innerHTML = '<option value="" disabled selected>Select Branch</option>';
    courseSelect.innerHTML = '<option value="" disabled selected>Select Course</option>';

    // Make an AJAX request to fetch branches and courses based on selected department
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_data.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText); // Debugging
            var data = JSON.parse(xhr.responseText);
            console.log(data); // Debugging
            if (data.length > 0) {
                data.forEach(function (row) {
                    branchSelect.innerHTML += '<option value="' + row.branch + '">' + row.branch + '</option>';
                    courseSelect.innerHTML += '<option value="' + row.course + '">' + row.course + '</option>';
                });
            }
        }
    };
    xhr.send('department=' + selectedDepartment);
});







function showAlert(message) {
    var alertModal = document.getElementById("alertModal");
    var alertMessage = document.getElementById("alertMessage");
    alertMessage.innerText = message;
    alertModal.style.display = "block";
    // alertModal.style.color = "red";


}



document.addEventListener("DOMContentLoaded", function () {
    var alertModal = document.getElementById("alertModal");
    var closeButton = document.querySelector("#alertModal .close");

    closeButton.addEventListener("click", function () {
        alertModal.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target == alertModal) {
            alertModal.style.display = "none";
        }
    });
});

// let popup =document.getElementById("popup-content");

// function openpopup(){
//     popup.classList.add("popup-content");
// } 

// function closepopup(){
//     popup.classList.remove("popup-content");
// }

function openPopup() {
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

document.getElementById('form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission

    // Here you can add your form submission logic
    // For example, you can use AJAX to submit the form data to the server
    // For demonstration purposes, I'm just simulating a successful submission
    var submissionSuccessful = true;

    if (submissionSuccessful) {
        // Show the popup only if submission is successful
        openPopup();
        // Redirect to the home page after a successful submission
        setTimeout(function () {
            window.location.href = 'home1.html';
        }, 3000); // Redirect after 3 seconds (adjust as needed)
    }
});





// Get the modal
document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("myModal");
    var confirmBtn = document.getElementById("confirmBtn");
    var cancelBtn = document.getElementById("cancelBtn");
    var submitBtn = document.getElementById("btnsubmit");

    submitBtn.addEventListener("click", function (event) {
        event.preventDefault();
        if (validateForm()) {
            modal.style.display = "block";
        }
    });

    confirmBtn.addEventListener("click", function () {
        var form = document.getElementById("form");
        form.submit(); // Submit the form
        modal.style.display = "none"; // Hide the modal after submission
    });

    cancelBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Close the modal if the user clicks on the 'x' button
    var closeBtn = document.querySelector(".close");
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Close the modal if the user clicks anywhere outside of it
    window.addEventListener("click", function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});









