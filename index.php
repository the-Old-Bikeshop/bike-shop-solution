
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/styles/adminNavigation.css">
    <title>Admin</title>
</head>
<body style="padding:0; margin:0;">
<div style="display:flex; justify-content:space-between;">

    <!--    --><?php //include_once "./includes/adminNavigation.php" ?>
    <div style="width:80vw;">
        <?php require_once('./Routes.php');

        function __autoload($class_name)
        {

            if (file_exists('./controllers/' . $class_name . '.php')) {
                require_once './controllers/' . $class_name . '.php';
            } elseif (file_exists('./controllers/admin/' . $class_name . '.php')) {
                require_once './controllers/admin/' . $class_name . '.php';
            } elseif (file_exists('./public/includes/' . $class_name . '.php')) {
                require_once './public/includes/' . $class_name . '.php';
            }
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>



