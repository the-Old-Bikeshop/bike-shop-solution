<?php
spl_autoload_register(function ($class)
{require_once"../classes/".$class.".php";});
$user = new User();

$result = [];

if (isset($_POST['update'])) {

    $user->updateValues(
            $_POST['nick_name'],
            $_POST['last_name'],
            $_POST['first_name'],
            $_POST['phone_number'],
            $_POST['rank'],
            $_POST['email'],
            $_POST['userID']
            );

    $result = $user->fetchUser($_POST['userID']);
}elseif(isset($_POST['userID'])) {
    $result = $user->fetchUser($_POST['userID']);
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

    <title>Update user <?php echo $result['nick_name']?></title>
</head>
<body>

<div class="m-3">
    <h1>Update user <?php echo $result['nick_name']?></h1>

    <?php if(isset($user->message)): ?>

        <div>
            <h3><?php echo $user->message ?></h3>
        </div>

    <?php endif  ?>
    <a href="user.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back to user overview</a>
</div>
<?php if ($result) { ?>
    <section class="container">
        <form action="" method="POST">
            <div class="form-row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="first_name">First name</label>
                            <input type="text" class="form-control" id="first_name" placeholder="First name" value="<?php echo $result['first_name']?>" name="first_name" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="last_name">Last name</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Last name" value="<?php echo $result['last_name']?>" name="last_name" required >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="nick_name">nick_name</label>
                            <input type="text" class="form-control" id="nick_name" placeholder="nick_name" value="<?php echo $result['nick_name']?>" name="nick_name" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="email">Email</label>
                            <input type='email' class="form-control" id="email" placeholder="email" value = "<?php echo $result['email']?>" name="email" required ">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="nick_name">Phone</label>
                            <input type="number" class="form-control" id="nick_name" placeholder="phone nr" value="<?php echo $result['phone_number']?>" name="phone_number" required>
                        </div>
                        <input  hidden type="text" class="form-control" id="validationDefault06"  required value=1 name='rank'>
                        <input  hidden type="text" class="form-control" id="validationDefault07"  required value="<?php echo $_POST['userID']?>" name='userID'>
                    </div>
            </div>
            </div>

            <button class="btn btn-primary" type="submit" name="update">Submit form</button>
        </form>
    </section>
<?php
}
?>

</body>
</html>

