<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <h1>MyShop Checkout</h1>
    </nav>

    <h2>Complete Your Order</h2>

    <form id="checkout-form">

        <input type="text" id="name" placeholder="Full Name" required><br><br>

        <input type="email" id="email" placeholder="Email" required><br><br>

        <input type="text" id="phone" placeholder="Phone Number" required><br><br>

        <input type="text" id="address" placeholder="Delivery Address" required><br><br>

        <button type="submit">Place Order</button>

    </form>

    <h2>M-Pesa Payment</h2>

<div class="mpesa-box">

    <input type="text"
           id="mpesa-number"
           placeholder="Enter M-Pesa Number">

    <br><br>

    <input type="number"
           id="mpesa-amount"
           placeholder="Enter Amount">

    <br><br>

    <button id="pay-btn">
        Pay with M-Pesa
    </button>

    <p id="payment-message"></p>

</div>

    <p id="message"></p>

    <script>

        let form = document.getElementById("checkout-form");
        let message = document.getElementById("message");

        form.addEventListener("submit", function(event) {

            event.preventDefault();

            let name = document.getElementById("name").value;

            message.innerText =
            "✅ Thank you " + name + "! Your order has been placed successfully.";

            form.reset();

        });

    </script>

    <script>

let payBtn = document.getElementById("pay-btn");

payBtn.addEventListener("click", function () {

    let number =
    document.getElementById("mpesa-number").value;

    let amount =
    document.getElementById("mpesa-amount").value;

    let paymentMessage =
    document.getElementById("payment-message");

    if (number !== "" && amount !== "") {

        paymentMessage.innerText =
        "✅ Payment request sent to " + number;

    } else {

        paymentMessage.innerText =
        "❌ Enter phone number and amount";

    }

});

</script>

</body>
</html>