<form onsubmit="return validateForm()">
    <input type="text" id="username" placeholder="Username"><br><br>
    <input type="password" id="password" placeholder="Password"><br><br>
    <button type="submit">Login</button>
</form>

<script>
    function validateForm() {
        let user = document.getElementById("username").value;
        let pass = document.getElementById("password").value;

        if (user === "" || pass === "") {
            alert("All fields are required!");
            return false;
        }

        if (pass.length < 6) {
            alert("Password must be at least 6 characters!");
            return false;
        }

        alert("Validation successful!");
        return true;
    }
</script>