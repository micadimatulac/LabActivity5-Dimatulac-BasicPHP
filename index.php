<?php

/* TO RUN: localhost/Labs/LabActivity5-Dimatulac-BasicPHP*/


/*
    START SESSION

    index.php needs access to the current
    session to determine if the user is logged in.
*/
session_start();


/*
    PROTECTED ROUTE

    index.php should only be accessible when
    the user is authenticated.

    If $_SESSION['user'] is empty, there is
    no authenticated user.

    Redirect the visitor to login.php.
*/
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}


/*
    LOGOUT REQUEST

    The logout button sends a POST request
    containing the name "logout".

    isset() checks if that value exists
    inside the POST request.
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {

    /*
        REMOVE SESSION DATA

        session_unset() removes all variables
        currently stored in the session.
    */
    session_unset();


    /*
        DESTROY SESSION

        session_destroy() completely destroys
        the current session.
    */
    session_destroy();


    /*
        REDIRECT AFTER LOGOUT

        After logging out, send the user
        back to login.php.

        Because index.php is protected,
        they cannot access it again until
        they successfully log in.
    */
    header('Location: login.php');
    exit;
}


/*
    GET USER EMAIL

    Since the user passed the protected route
    check, we know that $_SESSION['user'] exists.

    Get the user's email so it can be displayed
    on the page.
*/
$userEmail = $_SESSION['user']['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>
</head>

<body>

    <main>

        <!-- HOME SECTION -->
        <section>

            <h1>Welcome!</h1>

            <p>You are logged in as:</p>


            <!--
                DISPLAY USER EMAIL

                htmlspecialchars() safely displays
                the user's email on the HTML page.
            -->
            <p>
                <?php echo htmlspecialchars($userEmail); ?>
            </p>


            <!--
                LOGOUT FORM

                When this button is clicked, the form
                sends a POST request back to index.php.

                PHP detects the "logout" value above
                and destroys the current session.
            -->
            <form method="POST">

                <button
                    type="submit"
                    name="logout"
                >
                    Logout
                </button>

            </form>

        </section>

    </main>

</body>
</html>