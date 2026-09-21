<?php

/*
    START SESSION

    This allows the page to check if
    the user is currently logged in.
*/
session_start();


/*
    UNPROTECTED ROUTE

    register.php should only be accessed
    when the user is logged out.

    If the user is already logged in,
    redirect them to index.php.
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

                The user needs to enter an email,
                password, and retype the password.
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

                    Registration errors will be
                    displayed inside this paragraph.
                -->
                <p id="errorMessage"></p>


                <!-- REGISTER BUTTON -->
                <button type="submit">
                    Register
                </button>

            </form>


            <!-- LOGIN LINK -->
            <p>
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </section>

    </main>


    <script>

        /*
            GET HTML ELEMENTS

            querySelector() is used to select the
            form, inputs, and error message.
        */
        const registerForm = document.querySelector("#registerForm");
        const emailInput = document.querySelector("#email");
        const passwordInput = document.querySelector("#password");
        const retypePasswordInput = document.querySelector("#retypePassword");
        const errorMessage = document.querySelector("#errorMessage");


        /*
            REGISTER FORM EVENT

            This function runs when the user
            submits the registration form.
        */
        registerForm.addEventListener("submit", (event) => {

            /*
                STOP DEFAULT FORM SUBMISSION

                This allows JavaScript to validate
                the inputs before continuing.
            */
            event.preventDefault();


            /*
                GET USER INPUT

                Get the values entered by the user.

                trim() removes unnecessary spaces
                before and after the email.
            */
            const email = emailInput.value.trim();
            const password = passwordInput.value;
            const retypePassword = retypePasswordInput.value;


            /*
                GET EXISTING REGISTERED EMAIL

                Check localStorage to see if an email
                has already been registered.
            */
            const registeredEmail =
                localStorage.getItem("registeredEmail");


            /*
                CHECK FOR DUPLICATE EMAIL

                If a registered email already exists
                and it is the same as the entered email,
                do not allow another registration.

                toLowerCase() makes the comparison
                case-insensitive.

                Example:
                mica@gmail.com
                MICA@gmail.com

                These will be treated as the same email.
            */
            if (
                registeredEmail &&
                email.toLowerCase() === registeredEmail.toLowerCase()
            ) {

                errorMessage.textContent =
                    "This email is already registered.";

                return;
            }


            /*
                PASSWORD VALIDATION

                Check if the password and retyped
                password are the same.

                If they do not match, registration
                will not continue.
            */
            if (password !== retypePassword) {

                errorMessage.textContent =
                    "Passwords do not match.";

                return;
            }


            /*
                SAVE REGISTERED ACCOUNT

                Save the user's email and password
                inside localStorage.

                These values will later be retrieved
                by login.php for validation.
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