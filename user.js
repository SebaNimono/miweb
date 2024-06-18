function login() {
    var username = document.getElementById("login-username").value;
    var password = document.getElementById("login-password").value;

    if (username === "" || password === "") {
        alert("Por favor, complete todos los campos");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText.trim();
            if (response === "success") {
                alert("¡Inicio de sesión exitoso!\n¡Bienvenido, " + username + "!");
                window.location.href = "cuenta.php"; // Redirigir al perfil del usuario
            } else {
                alert("El nombre de usuario o la contraseña son incorrectos.");
            }
        }
    };

    xhr.send("login-username=" + encodeURIComponent(username) + "&login-password=" + encodeURIComponent(password));
}
















