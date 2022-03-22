function validateLogin() {
    var email = document.forms["loginForm"]["idemail"].value;
    var pass = document.forms["loginForm"]["idpass"].value;
    if ((email === "") || (pass === "")) {
        alert("Please fill out your username/password");
        return false;
    }
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(String(email))) {
        alert("Please correct your email");
        return false;
    }
}

function validateRegister() {
    var email = document.forms["registerForm"]["idemail"].value;
    var pass = document.forms["registerForm"]["idpass"].value;
    var phone = document.forms["registerForm"]["idphone"].value;
    var name = document.forms["registerForm"]["idname"].value;
    if ((email === "") || (pass === "") || (phone === "") || (name === "")) {
        alert("Please fill out all required info");
        return false;
    }
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(String(email))) {
        alert("Please correct your email");
        return false;
    }
}

function cartDialog() {
    var r = confirm("Add Furniture?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}

function DeleteDialog() {
    var r = confirm("Delete Furniture?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}

function UpdateDialog() {
    var r = confirm("Update Furniture Info?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}

function paymentDialog() {
    var r = confirm("Are you sure want to procee to payment?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}