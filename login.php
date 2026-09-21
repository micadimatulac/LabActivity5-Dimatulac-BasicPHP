<?php

/*
    START SESSION

    This allows PHP to access the current
    user's session information.
*/
session_start();


/*
    UNPROTECTED ROUTE

    login.php should only be accessed when
    the user is logged out.

    If the user already exists in the session,
    redirect them to index.php.
*/
if (!empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}


/*
    HANDLE LOGIN REQUEST

    This section only runs when the form
    sends a POST request.

    JavaScript performs the client-side validation
    before allowing the form to reach this section.
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /*
        GET EMAIL

        $_POST contains the information submitted
        by the login form.

        If email does not exist, use an empty
        string instead.
    */
    $email = $_POST['email'] ?? '';


    /*
        CREATE USER SESSION

        Store the authenticated user's email
        inside $_SESSION.

        This session will be used by index.php
        to determine if the user is logged in.
    */
    $_SESSION['user'] = [
        'email' => $email,
    ];


    /*
        REDIRECT AFTER LOGIN

        After creating the session, redirect
        the authenticated user to index.php.
    */
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
</head>

<body>

    <main>

        <!-- LOGIN SECTION -->
        <section>

            <h1>Login</h1>

            <p>Enter your registered account.</p>


            <!--
                LOGIN FORM

                method="POST" sends the form information
                to PHP using a POST request.
            -->
            <form id="loginForm" method="POST">

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


                <!--
                    ERROR MESSAGE

                    JavaScript will display validation
                    errors inside this paragraph.
                -->
                <p id="errorMessage"></p>


                <!-- LOGIN BUTTON -->
                <button type="submit">
                    Login
                </button>

            </form>


            <!-- LINK TO REGISTER -->
            <p>
                Don't have an account?
                <a href="register.php">Register</a>
            </p>

        </section>

    </main>


    <script>

        /*
            GET HTML ELEMENTS

            querySelector() selects the elements
            that JavaScript needs to use.
        */
        const loginForm = document.querySelector("#loginForm");
        const emailInput = document.querySelector("#email");
        const passwordInput = document.querySelector("#password");
        const errorMessage = document.querySelector("#errorMessage");


        /*
            LOGIN FORM EVENT

            This function runs whenever the user
            submits the login form.
        */
        loginForm.addEventListener("submit", (event) => {

            /*
                GET REGISTERED ACCOUNT

                localStorage.getItem() retrieves the
                email and password that were saved
                during registration.
            */
            const registeredEmail =
                localStorage.getItem("registeredEmail");

            const registeredPassword =
                localStorage.getItem("registeredPassword");


            /*
                GET LOGIN INPUT

                Get the email and password currently
                entered by the user.
            */
            const enteredEmail =
                emailInput.value.trim();

            const enteredPassword =
                passwordInput.value;


            /*
                CHECK IF AN ACCOUNT EXISTS

                If no registered email or password
                exists in localStorage, prevent login.

                preventDefault() stops the form from
                being submitted to PHP.
            */
            if (!registeredEmail || !registeredPassword) {

                event.preventDefault();

                errorMessage.textContent =
                    "No registered account found. Please register first.";

                return;
            }


            /*
                VALIDATE EMAIL

                Compare the entered email with the email
                saved during registration.

                If they are different, stop the form
                and display an error message.
            */
            if (enteredEmail !== registeredEmail) {

                event.preventDefault();

                errorMessage.textContent =
                    "Incorrect email. Please enter your registered email.";

                return;
            }


            /*
                VALIDATE PASSWORD

                Compare the entered password with the
                registered password.

                If they are different, stop the form
                and display an error message.
            */
            if (enteredPassword !== registeredPassword) {

                event.preventDefault();

                errorMessage.textContent =
                    "Incorrect password.";

                return;
            }


            /*
                SUCCESSFUL VALIDATION

                Remove any previous error message.

                Since preventDefault() was NOT called,
                the form will continue normally.

                The POST request will be received by
                the PHP code at the top of login.php.
            */
            errorMessage.textContent = "";

        });

    </script>

</body>
</html>