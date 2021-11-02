<?php
$ws=new WheelSizeController();
$ws->setWheelSize();
$ws->getWheelSize();

?>



<section class="row row col-12 row mt-5 col-md-8 offset-md-2 pb-5">

    <div class="col-12 col-md-12 offset-md-2 mt-5 mb-3 ">
        <h2>
            Wheel size
        </h2>
    </div>
    <h3 class="col-12 col-md-8 offset-md-2">All wheel sizes</h3>
    <table class="table table-sm col-12 col-md-8 offset-md-2 pb-5 border-bottom border-secondary">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">wheel ISO</th>
            <th scope="col">tire ISO</th>
            <th scope="col">Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($ws->getWheelSize()->fetchAllWheelSizes() as $res): ?>
            <tr>
                <th scope="row"> <?php echo $res["wheel_sizeID"] ?></th>
                <td><?php echo $res['wheel_ISO']?></td>
                <td><?php echo $res['tire_ISO']?></td>
                <td>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="wheel_sizeID" value="<?php echo $res['wheel_sizeID'] ?>">
                        <input type="submit" name="update" value="update" class="btn btn-info" >
                    </form>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="wheel_sizeID" value="<?php echo $res['wheel_sizeID'] ?>">
                        <input type="submit" name="delete" value="delete" class="btn btn-danger" onclick="return confirm('Delete! are you sure?')" >
                    </form>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>


    <!--    display message-->
    <?php if(isset($ws->getWheelSize()->message)): ?>

        <div class="col-12 col-md-8 offset-md-2">

            <h3><?php var_dump($ws->getwheelSize()->message);  ?></h3>
        </div>

    <?php endif  ?>


    <!--    the form for creating and updating drive_type starts here-->


    <form action="" method="post" class="col-12 row mt-5 col-12 col-md-8 offset-md-2 pb-5"  id="form">

        <p class="text-secondary  col-12"><?php echo !$ws->getUpdate() ? "Create new wheel size" : "Update product " .

                $ws->getWheel()['wheel_ISO'] . $ws->getWheel()['tire_ISO'];

                ?> </p>
        <div class="form-group col-12 mt-2">
            <label for="wheel_ISO">wheel ISO</label>
            <input type="text" class="form-control" id="wheel_ISO" name="wheel_ISO"
                   placeholder="wheel ISO"
                   value=" <?php echo $ws->getWheel()['wheel_ISO'] ?? '' ?>" required>
        </div>
        <div class="form-group col-12  mt-2">
            <label for="tire_iso">tire ISO</label>
            <input type="text" class="form-control" id="tire_iso" name="tire_ISO"
                   placeholder="tire ISO"
                   value="<?php echo $ws->getWheel()['tire_ISO'] ?? ''?>"">
        </div>

        <?php if(isset($ws->getWheel()['wheel_sizeID'])): ?>

            <input type="text" hidden
                   name = "wheel_sizeID"
                   value = "<?php echo $ws->getWheel()['wheel_sizeID'] ?>">

        <?php endif; ?>
        <div class="form-group col-12 mt-2">
            <input type="submit" class="btn <?php echo !$ws->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                   name="<?php echo !$ws->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                   value="<?php echo !$ws->getUpdate() ? 'Create new' : 'update' ?>">
        </div>

    </form>

</section>

