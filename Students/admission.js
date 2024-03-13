function validateForm() {
    /*Names*/
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var fatherName = document.getElementById("fatherName").value;
    var motherName = document.getElementById("motherName").value;

    if (!validateName(firstName, "First Name")) {
        return false;
    }

    if (!validateName(lastName, "Last Name")) {
        return false;
    }

    if (!validateName(fatherName, "Father's Name")) {
        return false;
    }

    if (!validateName(motherName, "Mother's Name")) {
        return false;
    }

    /*Citizenship*/
    var citizenshipNumber = document.getElementById('citizenship').value;

    if (!validateNepaliCitizenship(citizenshipNumber)) {
        return false;
    }

    return true;
}

/*Name Validation*/
function validateName(name, fieldName) {
    var nameRegex = /^[a-zA-Z\s]+$/;

    if (name.trim() === "") {
        alert(fieldName + " cannot be empty.");
        return false;
    }

    if (!nameRegex.test(name)) {
        alert(fieldName + " should contain only alphabetical letters.");
        return false;
    }

    return true;
}

/*Citizenship validation*/
function validateNepaliCitizenship(citizenshipNumber) {
    // Check if the citizenship number is not empty
    if (!citizenshipNumber.trim()) {
        alert("Citizenship number cannot be empty.");
        return false;
    }

    // Check if the citizenship number consists of 11 digits
    if (!/^\d{11}$/.test(citizenshipNumber)) {
        alert("Citizenship number must contain 11 digits.");
        return false;
    }

    // Extract date of birth, district code, and citizen code from the citizenship number
    var dobPart = citizenshipNumber.substring(0, 7);
    var districtCode = citizenshipNumber.substring(7, 9);
    var citizenCode = citizenshipNumber.substring(9, 11);

    // Check if the district code and citizen code are numeric
    if (isNaN(districtCode) || isNaN(citizenCode)) {
        alert("Citizenship number is invalid.");
        return false;
    }

    // Additional checks based on specific rules (Example: date of birth range)
    // Note: Actual rules may vary, and you should refer to the official documentation.

    // Check if the date of birth is within a reasonable range (adjust as needed)
    var dobTimestamp = Date.parse(dobPart);
    var currentTimestamp = Date.now();
    var minTimestamp = Date.parse('1900-01-01'); // Adjust as needed

    if (dobTimestamp < minTimestamp || dobTimestamp > currentTimestamp) {
        alert("Citizenship number did not match the time criteria.");
        return false;
    }

    return true;
}