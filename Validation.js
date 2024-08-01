// Common function to check if email exists
function checkEmailExists(email, callback) {
    fetch('CheckEmail.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            email: email
        })
    })
    .then(response => response.json())
    .then(data => {
        callback(data.exists);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Login validation
function dataexistingchecking(event) {
    event.preventDefault();
    
    var form = document.getElementById("loginForm");
    var formData = new FormData(form);
    var errorLabel = document.getElementById("txtError");

    fetch('Login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            errorLabel.innerHTML = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

    return false;
}

// Sign up validation
function validateSignUp(event) {
    event.preventDefault();

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("passwordconfirm").value;
    var errorLabel = document.getElementById("txtError");

    if (password !== confirmPassword) {
        errorLabel.innerHTML = "Passwords do not match. Please re-enter.";
        return false;
    } else {
        errorLabel.innerHTML = "";
    }

    checkEmailExists(email, (exists) => {
        if (exists) {
            errorLabel.innerHTML = "This email is already registered. Please use a different email.";
        } else {
            document.getElementById("signupform").submit();
        }
    });

    return false;
}
