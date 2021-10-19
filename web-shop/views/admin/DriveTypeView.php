<?php

$dt = new DriveTypeController();
$dt->setDriveType();
$dt->getDriveType();


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

<section class="row row col-12 row mt-5 col-md-8 offset-md-2 pb-5">

    <div class="col-12 col-md-12 offset-md-2 mt-5 mb-3 ">
        <h2>
            Drive Type
        </h2>
    </div>
    <h3 class="col-12 col-md-8 offset-md-2">All drive types</h3>
    <table class="table table-sm col-12 col-md-8 offset-md-2 pb-5 border-bottom border-secondary">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Short description</th>
            <th scope="col">Description</th>
            <th scope="col">Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dt->getDriveType()->fetchAllDriveTypes() as $res): ?>
            <tr>
                <th scope="row"> <?php echo $res["drive_typeID"] ?></th>
                <td><?php echo $res['name']?></td>
                <td><?php echo $res['short_description']?></td>
                <td><?php echo $res['description']?></td>
                <td>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="drive_typeID" value="<?php echo $res['drive_typeID'] ?>">
                        <input type="submit" name="update" value="update" class="btn btn-info" >
                    </form>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="drive_typeID" value="<?php echo $res['drive_typeID'] ?>">
                        <input type="submit" name="delete" value="delete" class="btn btn-danger" onclick="return confirm('Delete! are you sure?')" >
                    </form>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>


    <!--    display message-->
    <?php if(isset($dt->getDriveType()->message)): ?>

        <div class="col-12 col-md-8 offset-md-2">
            <h3><?php echo $dt->getDriveType()->message ?></h3>
        </div>

    <?php endif  ?>


    <!--    the form for creating and updating drive_type starts here-->



    <form class="col-12 row mt-5 col-12 col-md-8 offset-md-2 pb-5" action="" method="post" id="form">
        <p class="text-secondary  col-12"><?php echo !$dt->getUpdate() ? "Create new drive type" : "Update product " . $dt->getDrive()['name'] ?> </p>
        <div class="form-group col-12 mt-2">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="name of the drive type"
                   value=" <?php echo $dt->getDrive()['name'] ?? '' ?>" required>
        </div>
        <div class="form-group col-12  mt-2">
            <label for="short_description">Short description(max 255 characters)</label>
            <input type="text" class="form-control" id="short_description" name="short_description"
                   placeholder="short description 255 characters"
                   value="<?php echo $dt->getDrive()['short_description'] ?? ''?>"">
        </div>
        <div class="form-group col-12  mt-2">
            <label for="description">Describe products in detail</label>
            <textarea class="form-control"
                      id="description" rows="5"
                      name="description"><?php echo $dt->getDrive()['description'] ?? ''?></textarea>
        </div>
        <?php if(isset($dt->getDrive()['drive_typeID'])): ?>

            <input type="text" hidden
                   name = "drive_typeID"
                   value = "<?php echo $dt->getDrive()['drive_typeID'] ?>">

        <?php endif; ?>
        <div class="form-group col-12 mt-2">
            <input type="submit" class="btn <?php echo !$dt->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                   name="<?php echo !$dt->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                   value="<?php echo !$dt->getUpdate() ? 'Create new' : 'update' ?>">
        </div>

    </form>

</section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
