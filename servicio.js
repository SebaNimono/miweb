document.addEventListener("DOMContentLoaded", function () {
    const cartItems = document.getElementById("cart-items");
    const totalElement = document.getElementById("total");
    const paymentSection = document.getElementById("payment");
    const cardNumberInput = document.getElementById("card-number");
    const expiryDateInput = document.getElementById("expiry-date");
    const cvvInput = document.getElementById("cvv");
    const checkoutButton = document.getElementById("checkout");

    let total = 0;
    let cart = {}; // Objeto para mantener el conteo de los médicos en el carrito

    function addToCart(itemName, price) {
        if (cart[itemName]) {
            cart[itemName].quantity++;
            updateCartItem(cart[itemName]);
        } else {
            cart[itemName] = { quantity: 1, price: price };
            const listItem = document.createElement("li");
            listItem.textContent = `${itemName}: $${price} x 1`;

            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Eliminar";
            deleteButton.classList.add("delete-item");

            deleteButton.addEventListener("click", function () {
                total -= price * cart[itemName].quantity;
                totalElement.textContent = `Total: $${total}`;
                delete cart[itemName];
                listItem.remove();
                if (total === 0) {
                    paymentSection.style.display = "none";
                }
            });

            listItem.appendChild(deleteButton);
            cartItems.appendChild(listItem);
        }

        total += price;
        totalElement.textContent = `Total: $${total}`;
        paymentSection.style.display = "block";
    }

    function updateCartItem(item) {
        const itemName = Object.keys(cart).find((key) => cart[key] === item);
        const listItem = Array.from(cartItems.children).find((li) => li.textContent.includes(itemName));
        listItem.firstChild.textContent = `${itemName}: $${item.price} x ${item.quantity}`;
    }

    document.querySelectorAll(".select-doctor").forEach(function (button) {
        button.addEventListener("click", function () {
            const doctorName = this.parentNode.querySelector("p").textContent;
            const doctorPrice = parseInt(this.getAttribute("data-price"));
            addToCart(doctorName, doctorPrice);
        });
    });

    checkoutButton.addEventListener("click", function () {
        const cardNumber = cardNumberInput.value;
        const expiryDate = expiryDateInput.value;
        const cvv = cvvInput.value;

        if (!cardNumber || !expiryDate || !cvv) {
            alert("Por favor, complete todos los campos de pago.");
            return;
        }

        const cardRegex = /^(\d{4}\s?){4}$/; // Expresión regular con espacios opcionales
        const expiryRegex = /^(0[1-9]|1[0-2])\/[0-9]{2}$/;
        const cvvRegex = /^[0-9]{3}$/;

        if (!cardRegex.test(cardNumber)) {
            alert("Por favor, introduzca un número de tarjeta válido.");
            return;
        }

        if (!expiryRegex.test(expiryDate)) {
            alert("Por favor, introduzca una fecha de vencimiento válida en formato MM/AA.");
            return;
        }

        if (!cvvRegex.test(cvv)) {
            alert("Por favor, introduzca un CVV válido.");
            return;
        }

        // Enviar datos al servidor
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "process_order.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        const cartData = Object.keys(cart).map(key => ({
            doctor_name: key,
            price: cart[key].price,
            quantity: cart[key].quantity
        }));

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText === "success") {
                    alert("¡Muchas gracias por su compra!");
                    cartItems.innerHTML = "";
                    total = 0;
                    totalElement.textContent = `Total: $${total}`;
                    paymentSection.style.display = "none";
                    cardNumberInput.value = "";
                    expiryDateInput.value = "";
                    cvvInput.value = "";
                    cart = {}; // Reiniciar el carrito después de la compra
                } else {
                    alert("Error al procesar el pago. Intente nuevamente.");
                }
            }
        };

        const data = `username=${encodeURIComponent("someUsername")}` +
                     `&card_number=${encodeURIComponent(cardNumber)}` +
                     `&expiry_date=${encodeURIComponent(expiryDate)}` +
                     `&cvv=${encodeURIComponent(cvv)}` +
                     `&cart=${encodeURIComponent(JSON.stringify(cartData))}` +
                     `&total=${encodeURIComponent(total)}`;

        xhr.send(data);
    });
});















