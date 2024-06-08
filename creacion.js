function register() {
    
    var username = document.getElementById("reg-username").value;
    var email = document.getElementById("reg-email").value;
    var password = document.getElementById("reg-password").value;

    
    if (username === "" || email === "" || password === "") {
        alert("Por favor, complete todos los campos");
        return;
    }

    
    if (!validateEmail(email)) {
        alert("Por favor, ingrese un correo electrónico válido");
        return;
    }

    
    sessionStorage.setItem("username", username);
    sessionStorage.setItem("email", email);
    sessionStorage.setItem("password", password);

    
    alert("Registro exitoso!\nUsuario: " + username + "\nCorreo Electrónico: " + email);
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

