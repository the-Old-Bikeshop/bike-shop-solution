<?php
spl_autoload_register(function ($class)
{include"../classes/".$class.".php";});

$session = new SessionHandle();

//look for logout keyword and log the user out if == 1
if (isset($_GET['logout']) && $_GET['logout'] == 'Logout') {
    $logout = new Logout();
    $msg = "You are now logged out.";
}elseif ($session->logged_in()) {
    $redirect = new Redirect("../admin.php");
}
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    $login = new Login($_POST['email'],$_POST['pass']);
    $msg = $login->message;
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>

        <section class="container row">
            <?php
            if (!empty($msg)) {echo "<p class='col col-12'>" . $msg . "</p>";}
            ?>

            <h2 class="col col-12 text-center"> Please login</h2>

            <form action="" method="post" class="col col-12 col-md-6 offset-md-3">
                <div class="form-row row">
                    <div class="col-12 col-md-8 offset-md-2 mb-3">
                        <label for="email">Email</label>
                        <input type='email' class="form-control" id="email" placeholder="email" value = "" name="email" required ">
                    </div>
                    <div class="col-12 col-md-8 offset-md-2 mb-3">
                        <label for="validationDefaultPassword">Password</label>
                        <input type="password" class="form-control" id="validationDefaultPassword" placeholder="Password" aria-describedby="inputGroupPrepend2" name="pass" required>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2 mb-3">
                        <input  type="submit" name="submit" value="Login"/>
                    </div>

                </div>



            </form>
        </section>
    </body>
</html>
