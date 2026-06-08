<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <h1>Admin Dashboard</h1>
    </nav>

   <h2>Add Product</h2>

<div class="admin-box">

    <form id="product-form" method="POST" action="add-product.php">

        <input type="text" id="product-name" name="product_name" placeholder="Product Name" required>
        <br><br>

        <input type="number" id="product-price" name="product_price" placeholder="Product Price" required>
        <br><br>

        <input type="text" id="product-image" name="product_image" placeholder="Image URL" required>
        <br><br>

        <button type="submit">Add Product</button>

    </form>

</div>

<h2>Store Products</h2>

<div id="admin-products"
     class="products"></div>

<br>

<a href="admin-orders.html">
    <button>View Orders</button>
</a>


   <script>

let addProductBtn =
document.getElementById("add-product-btn");

let adminProducts =
document.getElementById("admin-products");

// Load saved products
let savedProducts =
JSON.parse(localStorage.getItem("products")) || [];

// Display saved products
savedProducts.forEach(product => {

    displayProduct(product);

});

// Add Product
addProductBtn.addEventListener("click", function () {

    let name =
    document.getElementById("product-name").value;

    let price =
    document.getElementById("product-price").value;

     let imageInput =
document.getElementById("product-image");

let file =
imageInput.files[0];

let stock =
document.getElementById("product-stock").value;

if (name !== "" && price !== "" && file) {

    let reader = new FileReader();

    reader.onload = function (e) {

        let product = {
    name: name,
    price: price,
    stock: stock,
    image: e.target.result
};

        savedProducts.push(product);

        localStorage.setItem(
            "products",
            JSON.stringify(savedProducts)
        );

        displayProduct(product);

    };

    reader.readAsDataURL(file);

}

// Display Function
function displayProduct(product) {

    let productCard =
    document.createElement("div");

    productCard.classList.add("product");

    productCard.innerHTML = `

    <img src="${product.image}" width="150">

    <h3 class="product-title">
        ${product.name}
    </h3>

    <p class="product-price">
        Price: Ksh ${product.price}
    </p>

    <p class="product-stock">
    Stock: ${product.stock}
</p>

<p class="stock-warning">
    ${product.stock <= 5 ? "⚠ Low Stock" : ""}
</p>

    <button class="edit-btn">
        Edit
    </button>

    <button class="delete-btn">
        Delete
    </button>

`;

    adminProducts.appendChild(productCard);

    // Delete Product
    let deleteBtn =
    productCard.querySelector(".delete-btn");

    deleteBtn.addEventListener("click", function () {

        productCard.remove();

        savedProducts =
        savedProducts.filter(p =>
            p.name !== product.name
        );

        localStorage.setItem(
            "products",
            JSON.stringify(savedProducts)
        );

    });

    // Edit Product
let editBtn =
productCard.querySelector(".edit-btn");

editBtn.addEventListener("click", function () {

    let newName =
    prompt("Enter new product name");

    let newPrice =
    prompt("Enter new price");

    if (newName && newPrice) {

        product.name = newName;
        product.price = newPrice;

        productCard.querySelector(".product-title")
        .innerText = newName;

        productCard.querySelector(".product-price")
        .innerText =
        "Price: Ksh " + newPrice;

        localStorage.setItem(
            "products",
            JSON.stringify(savedProducts)
        );

    }

});

}

</script>


let addProductBtn =
document.getElementById("add-product-btn");

let adminProducts =
document.getElementById("admin-products");

// Load saved products
let savedProducts =
JSON.parse(localStorage.getItem("products")) || [];

// Display saved products
savedProducts.forEach(product => {

    displayProduct(product);

});

// Add Product
addProductBtn.addEventListener("click", function () {

    let name =
    document.getElementById("product-name").value;

    let price =
    document.getElementById("product-price").value;

     let imageInput =
document.getElementById("product-image");

let file =
imageInput.files[0];

let stock =
document.getElementById("product-stock").value;

if (name !== "" && price !== "" && file) {

    let reader = new FileReader();

    reader.onload = function (e) {

        let product = {
            name: name,
            price: price,
            image: e.target.result
        };

        savedProducts.push(product);

        localStorage.setItem(
            "products",
            JSON.stringify(savedProducts)
        );

        displayProduct(product);

    };

    reader.readAsDataURL(file);

}

// Display Function
function displayProduct(product) {

    let productCard =
    document.createElement("div");

    productCard.classList.add("product");

    productCard.innerHTML = `

    <img src="${product.image}" width="150">

    <h3 class="product-title">
        ${product.name}
    </h3>

    <p class="product-price">
        Price: Ksh ${product.price}
    </p>

    <p class="product-stock">
    Stock: ${product.stock}
</p>

<p class="stock-warning">
    ${product.stock <= 5 ? "⚠ Low Stock" : ""}
</p>

    <button class="edit-btn">
        Edit
    </button>

    <button class="delete-btn">
        Delete
    </button>

`;

    adminProducts.appendChild(productCard);

    // Delete Product
    let deleteBtn =
    productCard.querySelector(".delete-btn");

    deleteBtn.addEventListener("click", function () {

        productCard.remove();

        savedProducts =
        savedProducts.filter(p =>
            p.name !== product.name
        );

        localStorage.setItem(
            "products",
            JSON.stringify(savedProducts)
        );

    });

    // Edit Product
let editBtn =
productCard.querySelector(".edit-btn");

editBtn.addEventListener("click", function () {

    let newName =
    prompt("Enter new product name");

    let newPrice =
    prompt("Enter new price");

    if (newName && newPrice) {

        product.name = newName;
        product.price = newPrice;

        productCard.querySelector(".product-title")
        .innerText = newName;

        productCard.querySelector(".product-price")
        .innerText =
        "Price: Ksh " + newPrice;

        localStorage.setItem(
            "products",
            JSON.stringify(savedProducts)
        );

    }

});

}

</script>
</body>

</html>