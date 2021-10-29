<?php
$br = new BrakeSystemController();

$br->setBrake();
$br->getBrake();
?>

<div class="container-fluid m-2 row">
    <section class="row col-12 row mt-5 col-md-8 offset-md-2 pb-5">

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
            <?php foreach ($br->getBrake()->fetchAllBrakeSystems() as $res): ?>
                <tr>
                    <th scope="row"> <?php echo $res['braking_systemID']?></th>
                    <td><?php echo $res['name']?></td>
                    <td><?php echo $res['condition']?></td>
                    <td><?php $br->getConvert()->condition($res['condition'])?></td>
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



        <form class="col-12 row mt-5 col-md-8 offset-md-2 pb-5" action="" method="post" id="form">
            <p class="text-secondary  col-12"><?php echo !$br->getUpdate() ? "Create new drive type" : "Update product " . $br->getVal()['name'] ?> </p>
            <div class="form-group col-12 mt-2">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name of the drive type" value=" <?php echo isset($br->getVal()['name']) ? $br->getval()['name'] : '' ?>" required>
            </div>


            <div class="form-group col-12  mt-2">
                <label for="condition">Products condition</label>
                <!--        creates the select element and the selects using a for loop. -->

                <select class="custom-select" id="condition" name="condition">
                    <?php foreach ($br->getConvert()->getConditionValues() as $cond):?>


                        <option value= <?php echo $cond . " " ?>
                                <?php if(isset($br->getVal()["condition"]) && $br->getVal()["condition"] == $cond ):?>
                                selected
                            <?php endif; ?>
                        >
                        <?php
                            $br->getConvert()->condition($cond);
                        ?>
                    </option>

                    <?php endforeach; ?>

                </select>


            </div>
            <?php if(isset($val['braking_systemID'])): ?>

                <input type="text" hidden name = "braking_systemID" value = "<?php echo $val['braking_systemID'] ?>">

            <?php endif; ?>
            <div class="form-group col-12 mt-2">
                <input type="submit" class="btn <?php echo !$br->getUpdate() ? 'btn-primary' : 'btn-info' ?>" name="<?php echo !$br->getUpdate() ? 'submit-new' : 'submit-update' ?>" value="<?php echo !$br->getUpdate() ? 'Create new' : 'update' ?>">
            </div>

        </form>

    </section>
</div>


