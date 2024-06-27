function login() {
    var username = document.getElementById("login-username").value;
    var password = document.getElementById("login-password").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            if (response.trim() === "success") {
                alert("¡Inicio de sesión exitoso!\n¡Bienvenido, " + username + "!");
                window.location.href = "perfil.html"; // Redirigir a perfil.html 
            } else {
                alert("El nombre de usuario o la contraseña son incorrectos.");
            }
        }
    };

    var params = "login-username=" + encodeURIComponent(username) + "&login-password=" + encodeURIComponent(password);
    xhr.send(params);
}







