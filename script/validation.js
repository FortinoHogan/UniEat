function isLetter(char) {
    return (
        (char >= "a" && char <= "z") ||
        (char >= "A" && char <= "Z")
    );
}

function validateName(username) {
    for (var i = 0; i < username.length; i++) {
        var char = username.charAt(i);
        if (username.charAt(i) === ' ') {
            continue;
        }
        if (!isLetter(char)) {
            return false;
        }
    }
    return true;
}

function validatePhoneNum(phoneNum) {
    var i = 0;
    if (phoneNum[0] === '+') {
        i = 1;
    }
    for (i; i < phoneNum.length; i++) {

        if (isNaN(phoneNum[i])) {
            return false
        }
    }
    return true
}

function validatePrice(price) {
    for (var i = 0; i < price.length; i++) {
        if (isNaN(price[i])) {
            return false
        }
    }
    return true
}

const registerValidation = () => {
    let email = document.getElementById("email");
    let username = document.getElementById("username");
    let phoneNumber = document.getElementById("phoneNumber");
    let password = document.getElementById("password");
    let confirmPassword = document.getElementById("confirmPassword");
    if (email.value == "") {
        alert("Email cannot be blank");
        return false;
    }
    else if (email.value.split("@").length > 2 || email.value.split("@").length == 1) {
        alert("Email must have at least 1 @")
        return false
    }
    else if (!email.value.split("@")[1].includes(".")) {
        alert("Email must have . after @")
        return false
    }
    if (username.value == "") {
        alert("Username cannot be blank");
        return false;
    }
    else if (username.value.length < 5) {
        alert("Username must be at least 5 letters");
        return false
    }
    else if (!validateName(username.value)) {
        alert("Username must only contain letters");
        return false
    }
    if (phoneNumber.value == "") {
        alert("Phone Number cannot be blank");
        return false;
    }
    else if (!validatePhoneNum(phoneNumber.value)) {
        alert("Phone Number must only contain numbers");
        return false
    }
    if (password.value == "") {
        alert("Password cannot be blank");
        return false;
    }
    else if (password.value.length < 6) {
        alert("Password must be at least 6 characters");
        return false
    }
    if (confirmPassword.value == "") {
        alert("Confirm Password cannot be blank");
        return false;
    }
    else if (confirmPassword.value != password.value) {
        alert("Confirm Password must be same with Password");
        return false;
    }
    return true
}

const addAdminValidation = () => {
    let email = document.getElementById("email");
    let username = document.getElementById("username");
    let phoneNumber = document.getElementById("phoneNumber");
    let male = document.querySelector("#male")
    let female = document.querySelector("#female")
    if (username.value == "") {
        alert("Username cannot be blank");
        return false;
    }
    else if (username.value.length < 5) {
        alert("Username must be at least 5 letters");
        return false
    }
    else if (!validateName(username.value)) {
        alert("Username must only contain letters");
        return false
    }
    if (email.value == "") {
        alert("Email cannot be blank");
        return false;
    }
    else if (email.value.split("@").length > 2 || email.value.split("@").length == 1) {
        alert("Email must have at least 1 @")
        return false
    }
    else if (!email.value.split("@")[1].includes(".")) {
        alert("Email must have . after @")
        return false
    }
    if (phoneNumber.value == "") {
        alert("Phone Number cannot be blank");
        return false;
    }
    else if (!validatePhoneNum(phoneNumber.value)) {
        alert("Phone Number must only contain numbers");
        return false
    }
    if (male.checked == false && female.checked == false) {
        alert("Gender must be choosen");
        return false
    }
    return true
}

const addTenantValidation = () => {
    let username = document.getElementById("username");
    let email = document.getElementById("email");
    let phoneNumber = document.getElementById("phoneNumber");
    if (username.value == "") {
        alert("Username cannot be blank");
        return false;
    }
    else if (username.value.length < 5) {
        alert("Username must be at least 5 letters");
        return false
    }
    else if (!validateName(username.value)) {
        alert("Username must only contain letters");
        return false
    }
    if (email.value == "") {
        alert("Email cannot be blank");
        return false;
    }
    else if (email.value.split("@").length > 2 || email.value.split("@").length == 1) {
        alert("Email must have at least 1 @")
        return false
    }
    else if (!email.value.split("@")[1].includes(".")) {
        alert("Email must have . after @")
        return false
    }
    if (phoneNumber.value == "") {
        alert("Phone Number cannot be blank");
        return false;
    }
    else if (!validatePhoneNum(phoneNumber.value)) {
        alert("Phone Number must only contain numbers");
        return false
    }
}

const addCategoryValidation = () => {
    let category = document.querySelector("#category");
    if (category.value == "") {
        alert("Category cannot be blank");
        return false
    }
    return true
}

const addItemValidation = () => {
    let name = document.querySelector("#name");
    let price = document.querySelector("#price");
    if (name.value == "") {
        alert("Name cannot be blank");
        return false
    }
    else if (name.value.length < 5) {
        alert("Name must be at least 5 letters");
        return false
    }
    else if (!validateName(name.value)) {
        alert("Name must only contain letters");
        return false
    }
    if (price.value == "") {
        alert("Price cannot be blank");
        return false
    }
    else if (!validatePrice(price.value)) {
        alert("Price must only contain numbers");
        return false
    }
    else if (parseInt(price.value) < 1000) {
        alert("Price must be at least 1000");
        return false
    }
    return true
}

var addModal = document.querySelector(".add-category-modal");
var editModal = document.querySelector(".edit-category-modal");
var addBtn = document.querySelector(".new-category-button");
var editBtns = document.querySelectorAll("#edit-category-button");
var closeButtons = document.querySelectorAll(".close-button");
var cancelButtons = document.querySelectorAll(".cancel-button");
var categoryInput = document.getElementById("category");
var editCategoryInput = document.getElementById("edit-category");
var editIdInput = document.getElementById("id");

addBtn.onclick = function () {
    addModal.style.display = "block";
}

editBtns.forEach(function (editBtn) {
    editBtn.onclick = function () {
        editModal.style.display = "block";
        editCategoryInput.value = this.getAttribute("data-category");
        editIdInput.value = this.getAttribute("data-id");
    }
});

closeButtons.forEach(function (closeButton) {
    closeButton.onclick = function () {
        addModal.style.display = "none";
        editModal.style.display = "none";
    }
});

cancelButtons.forEach(function (cancelButton) {
    cancelButton.onclick = function () {
        addModal.style.display = "none";
        editModal.style.display = "none";
    }
});

window.onclick = function (event) {
    if (event.target == addModal) {
        addModal.style.display = "none";
    }
    if (event.target == editModal) {
        editModal.style.display = "none";
    }
}