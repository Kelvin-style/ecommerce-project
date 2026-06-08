<!DOCTYPE html>
<html>

<head>
    <title>Customer Profile</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <h1>MyShop Profile</h1>
    </nav>

    <div class="profile-box">

        <img src="images/user.png"
             class="profile-image">

        <h2 id="profile-name">
            Customer Name
        </h2>

        <p id="profile-email">
            customer@email.com
        </p>

        <input type="text"
               id="new-name"
               placeholder="Update Name">

        <br><br>

        <input type="email"
               id="new-email"
               placeholder="Update Email">

        <br><br>

        <button id="save-profile">
            Save Profile
        </button>

        <p id="profile-message"></p>

    </div>

    <script>

        let saveBtn =
        document.getElementById("save-profile");

        let profileName =
        document.getElementById("profile-name");

        let profileEmail =
        document.getElementById("profile-email");

        // Load saved profile
        profileName.innerText =
        localStorage.getItem("profileName")
        || "Customer Name";

        profileEmail.innerText =
        localStorage.getItem("profileEmail")
        || "customer@email.com";

        saveBtn.addEventListener("click", function () {

            let newName =
            document.getElementById("new-name").value;

            let newEmail =
            document.getElementById("new-email").value;

            if (newName !== "" && newEmail !== "") {

                profileName.innerText = newName;
                profileEmail.innerText = newEmail;

                localStorage.setItem(
                    "profileName",
                    newName
                );

                localStorage.setItem(
                    "profileEmail",
                    newEmail
                );

                document.getElementById(
                    "profile-message"
                ).innerText =
                "✅ Profile Updated";

            }

        });

    </script>

</body>

</html>