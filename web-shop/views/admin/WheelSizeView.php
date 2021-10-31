<?php
$ws=new WheelSizeController();
$ws->setWheelSize();
$ws->getWheelSize();

?>

<section class="col-12 row">
    <div style="align-items:center; justify-content:space-between; border-bottom:2px dashed rgba(0,0,0,0.15); padding:1rem; width:100%; display: flex;">
        <h1>
            Wheel Sizes
        </h1>
        <button data-toggle="modal" data-target="#exampleModalCenter" style="height: 3rem;" type="button" class="btn btn-primary">
            Create New
        </button>
    </div>
    <div style="padding-left:1rem; padding:1rem; width:100%;">
        <h3 style="padding: 0; margin-top:0.5rem;" class="col-12">All Wheel Sizes</h3>
        <div class="card bg-light col-12 p-0">
        <table class="table table-sm col-12">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">wheel ISO</th>
                <th scope="col">tire ISO</th>
                <th scope="col">Controls</th>
            </tr>
            </thead>
            <tbody class="col-12">
            <?php foreach ($ws->getWheelSize()->fetchAllWheelSizes() as $res): ?>
                <tr>
                    <th scope="row"> <?php echo $res["wheel_sizeID"] ?></th>
                    <td><?php echo $res['wheel_ISO']?></td>
                    <td><?php echo $res['tire_ISO']?></td>
                    <td>
                        <form action="" method="post" class="d-inline-block p-0 m-0">
                            <input type="text" hidden name="wheel_sizeID" value="<?php echo $res['wheel_sizeID'] ?>">
                            <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                        </form>
                        <form action="" method="post" class="d-inline-block p-0 m-0">
                            <input type="text" hidden name="wheel_sizeID" value="<?php echo $res['wheel_sizeID'] ?>">
                            <input type="submit" name="delete" value="delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete! are you sure?')" >
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        </div>
    </div>

    <!--    display message-->
    <?php if(isset($ws->getWheelSize()->message)): ?>

        <div class="col-12 col-md-8 offset-md-2">

            <h3><?php var_dump($ws->getwheelSize()->message);  ?></h3>
        </div>

    <?php endif  ?>

    <!--    the form for creating and updating drive_type starts here-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">   
                        <?php echo !$ws->getUpdate() ? "Create new wheel size" : "Update product " .
                                    $ws->getWheel()['wheel_ISO'] . $ws->getWheel()['tire_ISO'];
                        ?> 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="col-12"  id="form">
                        <div class="form-group col-12 mt-2">
                            <label for="wheel_ISO">wheel ISO</label>
                            <input type="text" class="form-control" id="wheel_ISO" name="wheel_ISO"
                                placeholder="wheel ISO"
                                value=" <?php echo $ws->getWheel()['wheel_ISO'] ?? '' ?>" required
                            >
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="tire_iso">tire ISO</label>
                            <input type="text" class="form-control" id="tire_iso" name="tire_ISO"
                                placeholder="tire ISO"
                                value="<?php echo $ws->getWheel()['tire_ISO'] ?? ''?>"
                            >
                        </div>
                        <?php if(isset($ws->getWheel()['wheel_sizeID'])): ?>
                            <input type="text" hidden
                                name = "wheel_sizeID"
                                value = "<?php echo $ws->getWheel()['wheel_sizeID'] ?>"
                            >
                        <?php endif; ?>
                        <div class="form-group col-12 mt-2">
                            <input type="submit" class="btn <?php echo !$ws->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                name="<?php echo !$ws->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                value="<?php echo !$ws->getUpdate() ? 'Create new' : 'update' ?>"
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
