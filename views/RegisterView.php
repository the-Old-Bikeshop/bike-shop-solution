<?php
$init = new UserController;

// This keeps track if user sends the request
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch($_POST['type']) {
        case 'register';
            $init->register();
            break;
        default:
            echo "shieet...";
    }
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
        <div style="height:100vh; background-color:black; width:100vw; display:flex; align-items:center; justify-content:center;">
            <div style="background-color: whitesmoke; width:25rem; padding-top:2rem; height: auto; display:flex; align-items:center; justify-content:center; padding-bottom:2rem; border-radius: 20px;">
                <section class="container row">
                    <h2 style="margin-bottom:2rem;" class="col col-12 text-center">Sign up.</h2>
                    <form action="" method="post" class="col col-12">
                        <input type="hidden" name="type" value="register">
                        <div style="display: flex; align-items:center; justify-content:center;" class="form-row row">
                            <div class="col-12 col-md-11">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" name="first_name" class="form-control">
                            </div>
                            <div class="col-12 col-md-11" style="margin-top:8px;">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" name="last_name" class="form-control">
                            </div>
                            <div class="col-12 col-md-11" style="margin-top:8px;">
                                <label for="email">Email</label>
                                <input id="email" type="text" name="email" class="form-control">
                            </div>
                            <div class="col-12 col-md-11" style="margin-top:8px;">
                                <label for="nick_name">Nickname</label>
                                <input id="nick_name" type="text" name="nick_name" class="form-control">
                            </div>
                            <div class="col-12 col-md-11" style="margin-top:8px;">
                                <label for="password">Password</label>
                                <input id="password" type="text" name="password" class="form-control">
                            </div>
                            <div class="col-12 col-md-11" style="margin-top:8px;">
                                <label for="password">Password repeat</label>
                                <input id="password" type="text" name="password_repeated" class="form-control">
                            </div>
                            <input type="hidden" name="role" value="1">
                            <div class="col-12"  style="display:flex; align-items:center; justify-content:center;">
                                <button type="submit" name="submit" style="margin-top:30px;" class="btn btn-dark col-12 col-md-10">Sign up</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-12"  style="display:flex; align-items:center; justify-content:center;">
                        <button style="margin-top:30px;" class="btn btn-outline-dark col-12 col-md-10" type="submit" name="submit">Sign in</button>
                    </div>
                </section>
            </div>
        </div>
    </body>
</html>
