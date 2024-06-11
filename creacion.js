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

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "register.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === "success") {
                alert("¡Registro exitoso!\n¡Bienvenido, " + username + "!");
                window.location.href = "user.html";
                // Vaciar campos del formulario
                document.getElementById("reg-username").value = "";
                document.getElementById("reg-email").value = "";
                document.getElementById("reg-password").value = "";
            } else {
                alert("Correcto: " + xhr.responseText);
            }
        }
    };

    xhr.send("reg-username=" + encodeURIComponent(username) + "&reg-email=" + encodeURIComponent(email) + "&reg-password=" + encodeURIComponent(password));
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}






