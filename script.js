
let cartCount = localStorage.getItem("cartCount") || 0;
let total = localStorage.getItem("total") || 0;

total = Number(total);
cartCount = Number(cartCount);

let cart = document.getElementById("cart");
let totalText = document.getElementById("total");

cart.innerText = "Cart (" + cartCount + ")";
totalText.innerText = "Total: Ksh " + total;

let addButtons = document.querySelectorAll(".add-cart");
let removeButtons = document.querySelectorAll(".remove-cart");

// Add to Cart
addButtons.forEach(button => {
    button.addEventListener("click", function () {
        cartCount++;
        total += Number(button.dataset.price);

        cart.innerText = "Cart (" + cartCount + ")";
        totalText.innerText = "Total: Ksh " + total;

        localStorage.setItem("cartCount", cartCount);
        localStorage.setItem("total", total);
    });
});

// Remove from Cart
removeButtons.forEach(button => {
    button.addEventListener("click", function () {

        let price = Number(button.dataset.price);

        if (cartCount > 0 && total >= price) {

            cartCount--;
            total -= price;

            cart.innerText = "Cart (" + cartCount + ")";
            totalText.innerText = "Total: Ksh " + total;

            localStorage.setItem("cartCount", cartCount);
            localStorage.setItem("total", total);
        }

    });
});

let checkoutBtn = document.getElementById("checkout");

checkoutBtn.addEventListener("click", function () {

    if (cartCount > 0) {

        let orders =
        JSON.parse(localStorage.getItem("orders")) || [];

        let newOrder = {
            id: Date.now(),
            total: total,
            date: new Date().toLocaleString()
        };

        orders.push(newOrder);

        localStorage.setItem(
            "orders",
            JSON.stringify(orders)
        );

        alert("Purchase successful! Total = Ksh " + total);

        cartCount = 0;
        total = 0;

        cart.innerText = "Cart (0)";
        totalText.innerText = "Total: Ksh 0";

        localStorage.setItem("cartCount", 0);
        localStorage.setItem("total", 0);

    } else {

        alert("Your cart is empty!");

    }

});

let search = document.getElementById("search");
let products = document.querySelectorAll(".product");

search.addEventListener("keyup", function () {
    let value = search.value.toLowerCase();

    products.forEach(product => {
        let name = product.querySelector("h3").innerText.toLowerCase();

        if (name.includes(value)) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
        }
    });
});

let darkButton = document.getElementById("dark-mode");

// Load saved theme
if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark");
}

// Toggle dark mode
darkButton.addEventListener("click", function () {

    document.body.classList.toggle("dark");

    // Save theme
    if (document.body.classList.contains("dark")) {
        localStorage.setItem("theme", "dark");
    } else {
        localStorage.setItem("theme", "light");
    }

});

let plusButtons = document.querySelectorAll(".plus");
let minusButtons = document.querySelectorAll(".minus");

plusButtons.forEach(button => {

    button.addEventListener("click", function () {

        let qty = button.parentElement.querySelector(".qty");

        qty.innerText++;

    });

});

minusButtons.forEach(button => {

    button.addEventListener("click", function () {

        let qty = button.parentElement.querySelector(".qty");

        if (qty.innerText > 1) {

            qty.innerText--;

        }

    });

});

let wishlistButtons = document.querySelectorAll(".wishlist");

let wishlistCount = localStorage.getItem("wishlistCount") || 0;

let wishlistText = document.getElementById("wishlist-count");

wishlistText.innerText = "Wishlist (" + wishlistCount + ")";

wishlistButtons.forEach(button => {

    button.addEventListener("click", function () {

        wishlistCount++;

        wishlistText.innerText =
        "Wishlist (" + wishlistCount + ")";

        localStorage.setItem("wishlistCount", wishlistCount);

    });

});

let categoryButtons =
document.querySelectorAll(".category-btn");

categoryButtons.forEach(button => {

    button.addEventListener("click", function () {

        let category = button.dataset.category;

        products.forEach(product => {

            if (
                category === "all" ||
                product.dataset.category === category
            ) {

                product.style.display = "block";

            } else {

                product.style.display = "none";

            }

        });

    });

});

let reviewButtons =
document.querySelectorAll(".review-btn");

reviewButtons.forEach(button => {

    button.addEventListener("click", function () {

        let reviewInput =
        button.parentElement.querySelector(".review-input");

        let reviewText =
        button.parentElement.querySelector(".review-text");

        if (reviewInput.value !== "") {

            reviewText.innerText =
            "⭐ " + reviewInput.value;

            reviewInput.value = "";

        }

    });

});

let stars = document.querySelectorAll(".star");

stars.forEach((star, index) => {

    star.addEventListener("click", function () {

        let allStars =
        star.parentElement.querySelectorAll(".star");

        allStars.forEach((s, i) => {

            if (i <= index) {

                s.style.opacity = "1";

            } else {

                s.style.opacity = "0.3";

            }

        });

    });

});

let receiptBtn = document.getElementById("receipt-btn");

if (receiptBtn) {

    receiptBtn.addEventListener("click", function () {

        if (total > 0) {

            const { jsPDF } = window.jspdf;

            let doc = new jsPDF();

            doc.setFontSize(18);
            doc.text("MyShop Receipt", 20, 20);

            doc.setFontSize(12);
            doc.text("Cart Items: " + cartCount, 20, 40);
            doc.text("Total Amount: Ksh " + total, 20, 50);
            doc.text("Date: " + new Date().toLocaleString(), 20, 60);

            doc.save("receipt.pdf");

        } else {

            alert("No items in cart!");

        }

    });

}

