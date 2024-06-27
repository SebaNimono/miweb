document.addEventListener("DOMContentLoaded", function () {
    function mostrarCompras() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "mostrar_compras.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                if (response.trim() === "error") {
                    alert("Error al recuperar las compras. Por favor, inténtelo de nuevo más tarde.");
                    return;
                }

                
                var compras = JSON.parse(response);
                var listaCompras = document.getElementById("lista-compras");

                // Limpiar la lista de compras antes de agregar nuevas
                listaCompras.innerHTML = "";

                
                compras.forEach(function (compra) {
                    var listItem = document.createElement("li");
                    listItem.textContent = `Doctor: ${compra.doctor_name}, Precio: $${compra.total_price}`;
                    listaCompras.appendChild(listItem);
                });

                
                document.getElementById("compras").style.display = "block";
            }
        };
        xhr.send();
    }

    
    function cerrarSesion() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "logout.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                if (response.trim() === "success") {
                    alert("Sesión cerrada correctamente.");
                    window.location.href = "index.html"; // Redirigir a la página de inicio
                } else {
                    alert("Error al cerrar sesión.");
                }
            }
        };
        xhr.send();
    }

    //  para mostrar las compras al cargar la página
    mostrarCompras();
});
