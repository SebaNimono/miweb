document.addEventListener("DOMContentLoaded", function () {
    const cartItems = document.getElementById("cart-items");
    const totalElement = document.getElementById("total");
    const paymentSection = document.getElementById("payment");
    const cardNumberInput = document.getElementById("card-number");
    const expiryDateInput = document.getElementById("expiry-date");
    const cvvInput = document.getElementById("cvv");
    const checkoutButton = document.getElementById("checkout");

    let total = 0;
    let cart = {}; //  para mantener el conteo de los médicos en el carrito

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
        const listItem = cartItems.querySelector(`li:contains("${itemName}")`);
        listItem.textContent = `${itemName}: $${item.price} x ${item.quantity}`;

        if (item.quantity === 1) {
            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Eliminar";
            deleteButton.classList.add("delete-item");

            deleteButton.addEventListener("click", function () {
                total -= item.price;
                totalElement.textContent = `Total: $${total}`;
                item.quantity--;
                if (item.quantity === 0) {
                    delete cart[itemName];
                    listItem.remove();
                } else {
                    updateCartItem(item);
                }
                if (total === 0) {
                    paymentSection.style.display = "none";
                }
            });

            listItem.appendChild(deleteButton);
        }
    }

    document.querySelectorAll(".select-doctor").forEach(function (button) {
        button.addEventListener("click", function () {
            const doctorName = this.parentNode.querySelector("p").textContent;
            const doctorPrice = parseInt(this.getAttribute("data-price"));
            if (!cart[doctorName]) {
                addToCart(doctorName, doctorPrice);
            }
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

        const cardRegex = /^(\d\s?){4}(\d\s?){4}(\d\s?){4}(\d\s?){4}$/; // Expresión regular con espacios opcionales
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

        const cartItemsArray = Object.keys(cart).map(doctorName => {
            return {
                doctorName: doctorName,
                doctorPrice: cart[doctorName].price,
                quantity: cart[doctorName].quantity
            };
        });

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "save_order.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = xhr.responseText;
                if (response.trim() === "success") {
                    alert("¡Pedido guardado con éxito!");
                    cartItems.innerHTML = "";
                    total = 0;
                    totalElement.textContent = `Total: $${total}`;
                    paymentSection.style.display = "none";
                    cardNumberInput.value = "";
                    expiryDateInput.value = "";
                    cvvInput.value = "";
                    cart = {}; // Reiniciar el carrito después de la compra
                } else {
                    alert("Error al guardar el pedido: " + response);
                }
            }
        };

        const params = JSON.stringify({
            cartItems: cartItemsArray,
            cardNumber: cardNumber,
            expiryDate: expiryDate,
            cvv: cvv
        });

        xhr.send(params);
    });
});














