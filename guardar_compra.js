function guardarCompra() {
    var doctorName = document.getElementById("doctor_name").value;
    var doctorPrice = document.getElementById("doctor_price").value;
    var quantity = document.getElementById("quantity").value;
    var cardNumber = document.getElementById("card_number").value;
    var expiryDate = document.getElementById("expiry_date").value;
    var cvv = document.getElementById("cvv").value;

    if (!doctorName || !doctorPrice || !quantity || !cardNumber || !expiryDate || !cvv) {
        alert("Por favor, complete todos los campos.");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save_order.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            if (response.trim() === "success") {
                alert("¡Pedido guardado con éxito!");
            } else {
                alert("Error al guardar el pedido: " + response);
            }
        }
    };

    var params = "doctor_name=" + encodeURIComponent(doctorName) + 
                 "&doctor_price=" + encodeURIComponent(doctorPrice) + 
                 "&quantity=" + encodeURIComponent(quantity) + 
                 "&card_number=" + encodeURIComponent(cardNumber) + 
                 "&expiry_date=" + encodeURIComponent(expiryDate) + 
                 "&cvv=" + encodeURIComponent(cvv);
                 
    xhr.send(params);
}
