<?php

/*
    START SESSION

    session_start() allows this page to access
    the session data of the current user.
*/
session_start();


/*
    UNPROTECTED ROUTE

    The register page should only be accessible
    when the user is logged out.

    If $_SESSION['user'] already contains a user,
    it means the user is already authenticated.

    header() redirects the user to index.php.
    exit stops the rest of this file from running.
*/
if (!empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>
</head>

<body>

    <main>

        <!-- REGISTER SECTION -->
        <section>

            <h1>Register</h1>

            <p>Create an account.</p>


            <!--
                REGISTER FORM

                The form asks the user for:
                1. Email
                2. Password
                3. Retype Password

                JavaScript will handle the validation
                before saving the account.
            -->
            <form id="registerForm">

                <!-- EMAIL -->
                <div>
                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                    >
                </div>


                <!-- PASSWORD -->
                <div>
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                    >
                </div>


                <!-- RETYPE PASSWORD -->
                <div>
                    <label for="retypePassword">Retype Password</label>

                    <input
                        type="password"
                        id="retypePassword"
                        name="retypePassword"
                        required
                    >
                </div>


                <!--
                    ERROR MESSAGE

                    JavaScript will change the text inside
                    this paragraph if registration fails.
                -->
                <p id="errorMessage"></p>


                <!-- REGISTER BUTTON -->
                <button type="submit">
                    Register
                </button>

            </form>


            <!-- LINK TO LOGIN -->
            <p>
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </section>

    </main>


    <script>

        /*
            GET HTML ELEMENTS

            querySelector() finds an HTML element
            using its id.

            These variables allow JavaScript to access
            and control the form and its input fields.
        */
        const registerForm = document.querySelector("#registerForm");
        const emailInput = document.querySelector("#email");
        const passwordInput = document.querySelector("#password");
        const retypePasswordInput = document.querySelector("#retypePassword");
        const errorMessage = document.querySelector("#errorMessage");


        /*
            REGISTER FORM EVENT

            addEventListener() waits for the register
            form to be submitted.

            The function inside it will run every time
            the user clicks the Register button.
        */
        registerForm.addEventListener("submit", (event) => {

            /*
                PREVENT DEFAULT SUBMISSION

                preventDefault() prevents the form from
                immediately refreshing/submitting.

                This gives JavaScript time to validate
                the user's input first.
            */
            event.preventDefault();


            /*
                GET INPUT VALUES

                .value gets the value entered by the user.

                trim() removes unnecessary spaces before
                and after the email.
            */
            const email = emailInput.value.trim();
            const password = passwordInput.value;
            const retypePassword = retypePasswordInput.value;


            /*
                PASSWORD VALIDATION

                Check whether the password and retyped
                password are the same.

                If they are different, display an error
                and stop the function using return.
            */
            if (password !== retypePassword) {

                errorMessage.textContent =
                    "Passwords do not match.";

                return;
            }


            /*
                SAVE ACCOUNT

                localStorage.setItem() stores information
                inside the user's browser.

                The registered email will later be used
                for validation on login.php.

                The password is also stored for this
                simplified laboratory activity.
            */
            localStorage.setItem("registeredEmail", email);
            localStorage.setItem("registeredPassword", password);


            /*
                REDIRECT TO LOGIN

                After successful registration,
                send the user to login.php.
            */
            window.location.href = "login.php";

        });

    </script>

</body>
</html>