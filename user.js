function login() {
    
    var username = document.getElementById("login-username").value;
    var password = document.getElementById("login-password").value;

    var storedUsername = sessionStorage.getItem("username");
    var storedPassword = sessionStorage.getItem("password");

    
    if (username === storedUsername && password === storedPassword) {
        alert("¡Inicio de sesión exitoso!\n¡Bienvenido, " + username + "!");
        window.location.href = "index.html"; 
    } else {
        alert("El nombre de usuario o la contraseña son incorrectos.");
    }
}






