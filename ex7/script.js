function validateRegister() {

    let name =
        document.getElementById("name").value;

    let email =
        document.getElementById("email").value;

    let password =
        document.getElementById("password").value;

    let role =
        document.getElementById("role").value;


    if (name == "") {

        alert("Please enter your name");

        return false;
    }


    if (email == "") {

        alert("Please enter your email");

        return false;
    }


    if (password == "") {

        alert("Please enter your password");

        return false;
    }


    if (role == "") {

        alert("Please select user type");

        return false;
    }


    return true;
}



function validateLogin() {

    let email =
        document.getElementById("loginEmail").value;

    let password =
        document.getElementById("loginPassword").value;


    if (email == "") {

        alert("Please enter your email");

        return false;
    }


    if (password == "") {

        alert("Please enter your password");

        return false;
    }


    return true;
}