<h1>This is the brake </h1>


<?php
//spl_autoload_register(function ($class)
//{require_once"../classes/".$class.".php";});
//
//$session = new SessionHandle();
//if ($session->confirm_logged_in()) {
//    $redirect = new Redirect("login.php");
//}


?>

<?php
//$update = false;
//$brake = new BrakeType();
//if(isset($_POST['submit-new'])) {
//    $brake = new BrakeType($_POST['name'], $_POST['condition']);
//    $brake->createBrakeSystem();
//}elseif(isset($_POST['update'])) {
//    $brake = new BrakeType();
//    $update= true;
//
//    $val = $brake->fetchOneBrakeSystem($_POST['braking_systemID']);
//}elseif(isset($_POST['submit-update'])){
//    $brake = new BrakeType();
//    $brake->updateBrakeSystem($_POST['name'], $_POST['condition'], $_POST['braking_systemID'] );
//}elseif(isset($_POST['delete'])) {
//    $brake = new BrakeType();
//    $brake->deleteBrakeSystem($_POST['braking_systemID']);
//}
//
//$convert = new Convert();

?>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Admin</title>
</head>
<body>





<section class="row">

    <div class="col-12 col-md-12 offset-md-2 mt-5 mb-3 ">
        <h2>
            Brake systems
        </h2>
    </div>
    <h3 class="col-12 col-md-8 offset-md-2">All brake systems</h3>
    <table class="table table-sm col-12 col-md-8 offset-md-2 pb-5 border-bottom border-secondary">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Condition id</th>
            <th scope="col">Condition</th>
            <th scope="col">Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($brake->fetchAllBrakeSystems() as $res): ?>
            <tr>
                <th scope="row"> <?php echo $res['braking_systemID']?></th>
                <td><?php echo $res['name']?></td>
                <td><?php echo $res['condition']?></td>
                <td><?php echo $convert->condition($res['condition'])?></td>
                <td>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="braking_systemID" value="<?php echo $res['braking_systemID'] ?>">
                        <input type="submit" name="update" value="update" class="btn btn-info" >
                    </form>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="braking_systemID" value="<?php echo $res['braking_systemID'] ?>">
                        <input type="submit" name="delete" value="delete" class="btn btn-danger" onclick="return confirm('Delete! are you sure?')" >
                    </form>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>


    <!--    display message-->
    <?php if(isset($brake->message)): ?>

        <div class="col-12 col-md-8 offset-md-2">
            <h3><?php echo $brake->message ?></h3>
        </div>

    <?php endif  ?>


    <!--    the form for creating and updating drive_type starts here-->



    <form class="col-12 row mt-5 col-12 col-md-8 offset-md-2 pb-5" action="" method="post" id="form">
        <p class="text-secondary  col-12"><?php echo !$update ? "Create new drive type" : "Update product " . $val['name'] ?> </p>
        <div class="form-group col-12 mt-2">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="name of the drive type" value=" <?php echo isset($val['name']) ? $val['name'] : '' ?>" required>
        </div>

        <div class="form-group col-12  mt-2">
            <label for="condition">Products condition</label>

            <!--        creates the select element and the selects using a for loop. -->

            <select class="custom-select" id="condition" name="condition">
                <?php  for($i = 1; $i < 6; $i++ ):?>
                    <option value= <?php echo $i ?>
                            <?php if(isset($val['condition']) && $val["condition"] == $i):?>
                            selected
                        <?php endif; ?>
                    >
                        <?php echo $convert->condition($i) ?></option>

                <?php endfor; ?>
            </select>
        </div>
        <?php if(isset($val['braking_systemID'])): ?>

            <input type="text" hidden name = "braking_systemID" value = "<?php echo $val['braking_systemID'] ?>">

        <?php endif; ?>
        <div class="form-group col-12 mt-2">
            <input type="submit" class="btn <?php echo !$update ? 'btn-primary' : 'btn-info' ?>" name="<?php echo !$update ? 'submit-new' : 'submit-update' ?>" value="<?php echo !$update ? 'Create new' : 'update' ?>">
        </div>

    </form>

</section>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
