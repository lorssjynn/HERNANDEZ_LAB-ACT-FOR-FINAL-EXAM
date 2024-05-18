<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #D8AE7E; 
        }
        .form-container {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #FF5733;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="form-container" id="login-form-container">
    <h2>Login</h2>
    <form id="login-form">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="#" id="show-register">Register</a></p>
</div>

<div class="form-container" id="register-form-container" style="display: none;">
    <h2>Register</h2>
    <form id="register-form">
        <label for="new-username">New Username:</label><br>
        <input type="text" id="new-username" name="new-username" required><br>
        <label for="new-password">New Password:</label><br>
        <input type="password" id="new-password" name="new-password" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="#" id="show-login">Login</a></p>
</div>

<div class="container" style="display:none;">
    <h1>Welcome to the Canteen!</h1>
    <p>Here are the Menu and their Prices:</p>
    <ul class="menu">
        <li>Carbonara - 70 PHP</li>
        <li>Meals w/ Rice (Any Ulam) - 80 PHP</li>
        <li>Palabok - 50 PHP</li>
        <li>Coke - 20 PHP</li>
        <li>Gulaman - 15 PHP</li>
    </ul>

    <form id="order-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="menu">Menu:</label>
        <select id="menu" name="menu">
            <option value="Carbonara">Carbonara</option>
            <option value="Meals w/ Rice">Meals w/ Rice (Any Ulam)</option>
            <option value="Palabok">Palabok</option>
            <option value="Coke">Coke</option>
            <option value="Gulaman">Gulaman</option>
        </select><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1"><br>

        <label for="cash">Cash:</label>
        <input type="number" id="cash" name="cash" min="0" step="0.01"><br>

        <button type="submit" id="submit-button" style="background-color: #FF5733;">Submit</button>
    </form>

    <div class="total-cost">
        <h2 id="total-cost-heading">Total Cost of the order:</h2>
        <p id="total-cost"></p>
        <h2 id="change-heading">Your Change:</h2>
        <p id="change"></p>
        <p>Thank you for Ordering! Come Back Again~</p>
    </div>
</div>

<script>
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const loginFormContainer = document.getElementById("login-form-container");
    const registerFormContainer = document.getElementById("register-form-container");
    const container = document.querySelector(".container");

    document.getElementById("show-register").addEventListener("click", function(event) {
        event.preventDefault();
        loginFormContainer.style.display = "none";
        registerFormContainer.style.display = "block";
    });

    document.getElementById("show-login").addEventListener("click", function(event) {
        event.preventDefault();
        loginFormContainer.style.display = "block";
        registerFormContainer.style.display = "none";
    });

    loginForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(loginForm);
        const username = formData.get("username");
        const password = formData.get("password");

        // Check if username and password match (add your authentication logic here)
        if (username === "Lorsjyn" && password === "1016") {
            loginFormContainer.style.display = 'none';
            container.style.display = 'block';
        } else {
            alert("Invalid username or password. Please try again.");
        }
    });

    registerForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(registerForm);
        const newUsername = formData.get("LorahJyn");
        const newPassword = formData.get("0925");

        // Here you would typically send the new username and password to your backend for registration
        // For simplicity, let's just log the new credentials for now
        console.log("New Username:", newUsername);
        console.log("New Password:", newPassword);

        // Optionally, you can reset the form after registration
        registerForm.reset();
        alert("Registration successful! You can now login with your new credentials.");
    });

    const menuPrices = {
        "Carbonara": 70,
        "Meals w/ Rice": 80,
        "Palabok": 50,
        "Coke": 20,
        "Gulaman": 15
    };

    const orderForm = document.getElementById("order-form");
    const submitButton = document.getElementById("submit-button");
    const totalCostDiv = document.querySelector(".total-cost");
    const totalCostHeading = document.getElementById("total-cost-heading");
const totalCostPara = document.getElementById("total-cost");
const changeHeading = document.getElementById("change-heading");
const changePara = document.getElementById("change");

orderForm.addEventListener("submit", function(event) {
    event.preventDefault();
    const formData = new FormData(orderForm);
    const selectedMenu = formData.get("menu");
    const quantity = parseInt(formData.get("quantity"));
    const cash = parseFloat(formData.get("cash"));

    const totalCost = menuPrices[selectedMenu] * quantity;
    const change = cash - totalCost;

    totalCostHeading.innerHTML = "";
    totalCostPara.textContent = "";
    changeHeading.innerHTML = "";
    changePara.textContent = "";

    totalCostDiv.style.display = "block";
    submitButton.style.backgroundColor = "#66CC66"; 

    const resultWindow = window.open('', '_blank');
    resultWindow.document.write('<h2>Total Cost of the order:</h2>');
    resultWindow.document.write('<p>' + totalCost + ' PHP</p>');
    resultWindow.document.write('<h2>Your Change:</h2>');
    resultWindow.document.write('<p>' + change + ' PHP</p>');
    resultWindow.document.write('<p>Thank you for Ordering! Come Back Again~</p>');
    resultWindow.document.body.style.backgroundColor = '#D8AE7E'; 

    resultWindow.focus();
});
</script>

</body>
</html>