<?php
spl_autoload_register(function ($class)
{require_once"../classes/".$class.".php";});

if(isset($_POST['submit'])) {
    $user = new User($_POST['nick_name'], $_POST['last_name'], $_POST['first_name'], $_POST['phone_number'], $_POST['rank'], $_POST['email']);
    $user->createUser($_POST['password'], 15);

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

    <title>Create new user</title>
</head>
<body>

<div class="m-3">
    <h1>Create new user</h1>

    <?php if(isset($user->message)): ?>

        <div>
            <h3><?php echo $user->message ?></h3>
        </div>

    <?php endif  ?>
    <a href="user.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back to user overview</a>
</div>

<section class="container">

    <form action="" method="post">
        <div class="form-row">
            <div class="col-md-5 mb-3">
                <label for="first_name">First name</label>
                <input type="text" class="form-control" id="first_name" placeholder="First name" value="" name="first_name" required>
            </div>
            <div class="col-md-5 mb-3">
                <label for="last_name">Last name</label>
                <input type="text" class="form-control" id="last_name" placeholder="Last name" value="" name="last_name" required >
            </div>
            <div class="col-md-5 mb-3">
                <label for="nick_name">nick_name</label>
                <input type="text" class="form-control" id="nick_name" placeholder="nick_name" value="" name="nick_name" required>
            </div>
            <div class="col-md-5 mb-3">
                <label for="validationDefaultPassword">Password</label>
                <input type="password" class="form-control" id="validationDefaultPassword" placeholder="Password" aria-describedby="inputGroupPrepend2" name="password" required>
            </div>

        </div>
        <div class="form-row">
            <div class="col-md-5 mb-3">
                <label for="email">Email</label>
                <input type='email' class="form-control" id="email" placeholder="email" value = "" name="email" required ">
            </div>
            <div class="col-md-5 mb-3">
                <label for="nick_name">Phone</label>
                <input type="number" class="form-control" id="nick_name" placeholder="phone nr" value="" name="phone_number" required>
            </div>
                <input  hidden type="text" class="form-control" id="validationDefault05" placeholder="Zip" required value = 1 name = 'rank'>

        </div>

        <button class="btn btn-primary" type="submit" name="submit">Create user</button>
    </form>
</section>
</body>
</html>
