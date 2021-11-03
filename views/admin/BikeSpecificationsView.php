<?php
$bike_s = new BikeSpecificationController();
$bike_s->setBikeSpecifications();
?>
<!-- -->
<!--CREATE TABLE bike_specifications (-->
<!--bike_specificationsID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,-->
<!--`type` VARCHAR(255) NOT NULL,-->
<!--back_basket INT,-->
<!--mudguards INT,-->
<!--front_basket INT,-->
<!--lights INT,-->
<!--disk_brakes INT,-->
<!--wheel_sizeID INT,-->
<!--braking_systemID INT,-->
<!--drive_typeID INT,-->
<!--created_by INT,-->
<!--FOREIGN KEY (wheel_sizeID) REFERENCES wheel_size (wheel_sizeID),-->
<!--FOREIGN KEY (braking_systemID) REFERENCES braking_system (braking_systemID),-->
<!--FOREIGN KEY (drive_typeID) REFERENCES drive_type (drive_typeID),-->
<!--FOREIGN KEY (created_by) REFERENCES `user` (userID)-->
<!--); -->

<section  class="row col-12">
    <div style="align-items:center; justify-content:space-between; border-bottom:2px dashed rgba(0,0,0,0.15); padding:1rem; width:100%; display: flex;">
        <h1>
            Bike specifications
        </h1>
        <button data-toggle="modal" data-target="#exampleModalCenter" style="height: 3rem;" type="button" class="btn btn-dark">
            Create New
        </button>
    </div>
    <div style="padding-left:1rem; padding:1rem; width:100%;">
        <div class="card bg-light col-12 p-0">
            <table class="table table-sm col-12">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">type</th>
                    <th scope="col">accepts: back basket</th>
                    <th scope="col">accepts: mudguards</th>
                    <th scope="col">accepts: front basket</th>
                    <th scope="col">accepts: lights</th>
                    <th scope="col">accepts: disk brakes</th>
                    <th scope="col">wheel size</th>
                    <th scope="col">braking system</th>
                    <th scope="col">drive type</th>
                    <th scope="col">created by</th>
                    <th scope="col">controls</th>

                </tr>
                </thead>
                <tbody class="col-12">
                <?php foreach ($bike_s->getBikeSpecifications()->fetchAllBikeSpecifications() as $res): ?>
                    <tr>
                        <th scope="row"> <?php echo $res['bike_specificationsID']?></th>
                        <td><?php echo $res['type']?></td>
                        <td><?php $bike_s->getConvert()->yesNo($res['back_basket']); ?></td>
                        <td><?php $bike_s->getConvert()->yesNo($res['mudguards']); ?></td>
                        <td><?php $bike_s->getConvert()->yesNo($res['front_basket']);?></td>
                        <td><?php $bike_s->getConvert()->yesNo($res['lights']);?></td>
                        <td><?php $bike_s->getConvert()->yesNo($res['disk_brakes']);?></td>
                        <td><?php echo $res['wheel_ISO'] . ' / ' . $res['tire_ISO']?></td>
                        <td><?php echo $res['brake_name']?></td>
                        <td><?php echo $res['drive_name']?></td>
                        <td><?php echo $res['first_name'] . " " . $res['last_name']?></td>
                        <td>
                            <form action="" method="post" class="d-inline-block">
                                <input type="text" hidden name="bike_specificationsID" value="<?php echo $res['bike_specificationsID'] ?>">
                                <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm" >
                            </form>
                            <form action="" method="post" class="d-inline-block">
                                <input type="text" hidden name="bike_specificationsID" value="<?php echo $res['bike_specificationsID'] ?>">
                                <input type="submit" name="delete" value="delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete! are you sure?')" >
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>


      <!--    the form for creating and updating drive_type starts here-->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">   
                        <?php echo !$bike_s->getUpdate() ? "Create new bike specifications" : "Update bike specifications ". $text = $bike_s->getOneBike()['type'] ?? "";?> 
                    </h5>
                    <form action="" method="post">
                        <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </form>
                </div>
                <div class="modal-body">
                    <form class="col-12 row mt-5 col-12 col-md-8 offset-md-2 pb-5 mb-5" action="" method="post" id="form">
                        <?php echo $bike_s->getBikeSpecifications()->message ?? ""; ?>
                        <div class="form-group col-12 mt-2">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" id="type" name="type"
                                value=" <?php echo $bike_s->getOneBike()['type'] ?? '' ?>" 
                            >
                        </div>
                        <div class="col-12 border border-primary rounded">
                            <h3>Accepts: </h3>
                            <div class="form-group col-12 mt-2">
                                <span>Back basket</span>
                                <?php foreach ($bike_s->getConvert()->getYesNo() as $cond):?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio"
                                            name="back_basket"
                                            class="custom-control-input"
                                            id="back_basket_<?php
                                            $bike_s->getConvert()->yesNo($cond);?>"
                                            value="<?php echo $cond;?>"
                                            <?php if(isset($bike_s->getOneBike()["back_basket"]) && $bike_s->getOneBike()
                                                ["back_basket"] == $cond
                                            ):?>
                                                checked
                                            <?php endif; ?>
                                        >
                                        <label class="custom-control-label" for="back_basket_<?php
                                            $bike_s->getConvert()->yesNo($cond);?>"
                                        >
                                            <?php $bike_s->getConvert()->yesNo($cond);?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group col-12 mt-2">
                                <span>Lights</span>
                                <?php foreach ($bike_s->getConvert()->getYesNo() as $cond):?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio"
                                            name="lights"
                                            class="custom-control-input"
                                            id="light_<?php $bike_s->getConvert()->yesNo($cond);?>"
                                            value="<?php echo $cond; ?>"
                                            <?php if(isset($bike_s->getOneBike()["lights"]) && $bike_s->getOneBike()["lights"] ==
                                                $cond
                                            ):?>
                                                checked
                                            <?php endif; ?>
                                        >
                                        <label class="custom-control-label" 
                                            for="light_<?php $bike_s->getConvert()->yesNo($cond);?>"
                                        >
                                            <?php $bike_s->getConvert()->yesNo($cond);?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group col-12 mt-2">
                                <span>Mudguards</span>
                                <?php foreach ($bike_s->getConvert()->getYesNo() as $cond):?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio"
                                            name="mudguards"
                                            class="custom-control-input"
                                            id="mudguards_<?php $bike_s->getConvert()->yesNo($cond);?>"
                                            value="<?php echo $cond;?>"
                                            <?php if(isset($bike_s->getOneBike()["mudguards"]) && $bike_s->getOneBike()["mudguards"] ==
                                                $cond
                                            ):?>
                                                checked
                                            <?php endif; ?>
                                        >
                                        <label class="custom-control-label" for="mudguards_<?php
                                            $bike_s->getConvert()->yesNo($cond);?>"
                                        >
                                            <?php $bike_s->getConvert()->yesNo($cond);?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group col-12 mt-2">
                                <span>Front Basket</span>
                                <?php foreach ($bike_s->getConvert()->getYesNo() as $cond):?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio"
                                            name="front_basket"
                                            class="custom-control-input"
                                            id="front_basket_<?php $bike_s->getConvert()->yesNo($cond);?>"
                                            value="<?php echo $cond;?>"
                        `                            <?php if(isset($bike_s->getOneBike()["front_basket"]) && $bike_s->getOneBike()["front_basket"] ==
                                                $cond
                                            ):?>
                                                checked
                                            <?php endif; ?>
                                        >
                                        <label class="custom-control-label" for="front_basket_<?php
                                            $bike_s->getConvert()->yesNo($cond);
                                            ?>"
                                        >
                                            <?php $bike_s->getConvert()->yesNo($cond);?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group col-12 mt-2">
                                <span>Disk Brakes</span>
                                <?php foreach ($bike_s->getConvert()->getYesNo() as $cond):?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio"
                                            name="disk_brakes"
                                            class="custom-control-input"
                                            id="disk_bakes_<?php
                                            $bike_s->getConvert()->yesNo($cond);?>" value="<?php echo $cond;?>"
                                            <?php if(isset($bike_s->getOneBike()["disk_brakes"]) && $bike_s->getOneBike()["disk_brakes"] ==
                                                $cond
                                                ):?>
                                                checked
                                            <?php endif;?>
                                        >
                                        <label class="custom-control-label" for="disk_bakes_<?php
                                            $bike_s->getConvert()->yesNo($cond);?>"
                                        >
                                            <?php $bike_s->getConvert()->yesNo($cond);?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-12 border border-primary rounded mt-2">
                            <h3>Has:</h3>
                            <div class="form-group col-12  mt-2">
                                <label for="wheel_size">Wheel size</label>
                                <select class="custom-select" id="wheel_size" name="wheel_sizeID">
                                    <?php if(($bike_s->getWheel()->fetchAllWheelSizes() !== null)) {
                                        foreach ($bike_s->getWheel()->fetchAllWheelSizes() as $wheel):?>
                                            <option value="<?php echo $wheel['wheel_sizeID'] ?? "" ?>"
                                                    <?php if(!isset($wheel['wheel_sizeID']) && isset($bike_s->getOneBike()['wheel_sizeID']) && $wheel['wheel_sizeID'] ==
                                                        $bike_s->getOneBike()['wheel_sizeID']):?>
                                                        selected
                                                    <?php endif; ?>
                                                    ><?php if(!is_null($wheel['wheel_ISO'])||!is_null($wheel['tire_ISO'])) {
                                                        echo $wheel['wheel_ISO']. ' / ' . $wheel['tire_ISO'];
                                                        } ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php } else {?>
                                    <p>
                                        Create a wheel size first at 
                                        <a href="./WheelSizeView.php">wheel size</a>
                                    </p>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="wheel_size">Braking system</label>
                                <select class="custom-select" id="brake_system" name="braking_systemID">
                                    <?php if(($bike_s->getBrake()->fetchAllBrakeSystems() !== null)) {
                                        foreach ($bike_s->getBrake()->fetchAllBrakeSystems() as $brake):?>
                                            <option value="<?php echo $brake['braking_systemID'] ?? "" ?>"
                                                <?php if(!isset($brake['braking_systemID']) && isset($bike_s->getOneBike()['braking_systemID'])
                                                    &&
                                                    $brake['braking_systemID'] ==
                                                    $bike_s->getOneBike()['braking_systemID']):?>
                                                    selected
                                                <?php endif; ?>
                                            >
                                                <?php echo $brake['name'] ?? ""?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php } else {?>
                                        <p>
                                            Create a brake system first at 
                                            <a href="./BrakeSystemView.php"> brake system</a>
                                        </p>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="wheel_size">Drive Type</label>
                                <select class="custom-select" id="drive_type" name="drive_typeID">
                                    <?php if(($bike_s->getDriveType()->fetchAllDriveTypes() !== null)) {
                                        foreach ($bike_s->getDriveType()->fetchAllDriveTypes() as $drive):?>

                                            <option value="<?php echo $drive['drive_typeID'] ?? "" ?>"
                                                <?php if(!isset($drive['drive_typeID']) && isset($bike_s->getOneBike()['drive_typeID'])
                                                    &&
                                                    $drive['drive_typeID'] ==
                                                    $bike_s->getOneBike()['drive_typeID']):?>
                                                    selected
                                                <?php endif; ?>
                                            ><?php
                                                echo $drive['name'] ?? ""
                                                ?>
                                            </option>


                                        <?php endforeach; ?>
                                    <?php } else {?>
                                        <p>
                                            Create a drive type first at 
                                            <a href="./DriveTypeView.php"> Drive type</a>
                                        </p>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="created_by" value="1">
                        <?php if(isset($bike_s->getOneBike()['bike_specificationsID'])): ?>
                            <input type="text" hidden
                                name = "bike_specificationsID"
                                value = "<?php echo $bike_s->getOneBike()['bike_specificationsID'] ?>"
                            >
                        <?php endif; ?>
                        <div class="form-group col-12 mt-2">
                            <input type="submit" class="btn <?php echo !$bike_s->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                name="<?php echo !$bike_s->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                value="<?php echo !$bike_s->getUpdate() ? 'Create new' : 'update' ?>"
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
