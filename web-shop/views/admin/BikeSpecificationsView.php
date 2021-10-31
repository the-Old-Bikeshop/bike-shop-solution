<?php
$bike_s = new BikeSpecificationController();

?>
<!---->
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
<!--);-->

<section  class="row row col-12 row mt-5 col-md-8 offset-md-2 pb-5">
    <h1>Bike specifications</h1>


    <table class="table table-sm col-12 col-md-8 offset-md-2 pb-5 border-bottom border-secondary">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">type</th>
            <th scope="col">back_basket</th>
            <th scope="col">mudguards</th>
            <th scope="col">front_basket</th>
            <th scope="col">lights</th>
            <th scope="col">disk_brakes</th>
            <th scope="col">wheel_size</th>
            <th scope="col">braking_system</th>
            <th scope="col">drive_type</th>
            <th scope="col">created by</th>
            <th scope="col">controls</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($bike_s->getBikeSpecifications()->fetchAllBikeSpecifications() as $res): ?>
            <tr>
                <th scope="row"> <?php echo $res['bike_specificationsID']?></th>
                <td><?php echo $res['type']?></td>
                <td><?php echo $res['back_basket']?></td>
                <td><?php echo $res['mudguards']?></td>
                <td><?php echo $res['front_basket']?></td>
                <td><?php echo $res['lights']?></td>
                <td><?php echo $res['disk_brakes']?></td>
                <td><?php echo $res['wheel_sizeID']?></td>
                <td><?php echo $res['braking_systemID']?></td>
                <td><?php echo $res['drive_typeID']?></td>
                <td><?php echo $res['userID']?></td>
                <td>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="bike_specificationsID" value="<?php echo $res['bike_specificationsID'] ?>">
                        <input type="submit" name="update" value="update" class="btn btn-info" >
                    </form>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="bike_specificationsID" value="<?php echo $res['bike_specificationsID'] ?>">
                        <input type="submit" name="delete" value="delete" class="btn btn-danger" onclick="return confirm('Delete! are you sure?')" >
                    </form>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>

    <form class="col-12 row mt-5 col-12 col-md-8 offset-md-2 pb-5 mb-5" action="" method="post" id="form">
        <p class="text-secondary  col-12"><?php echo !$bike_s->getUpdate() ? "Create new company details" : "Update details "
                . $bike_s->getOneBike()['bike_specificationsID'] ?> </p>
        <div class="form-group col-12 mt-2">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" name="type"
                   value=" <?php echo $bike_s->getOneBike()['type'] ?? '' ?>" >
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
                               $bike_s->getConvert()->yesNo($cond);
                               ?>"

                               value="<?php
                               echo $cond;
                               ?>"

                            <?php if(isset($bike_s->getOneBike()["back_basket"]) && $bike_s->getOneBike()
                                ["back_basket"] ==
                                $cond
                            ):?>
                                checked
                            <?php endif; ?>

                        >
                        <label class="custom-control-label" for="back_basket_<?php
                        $bike_s->getConvert()->yesNo($cond);
                        ?>"><?php
                            $bike_s->getConvert()->yesNo($cond);
                            ?></label>
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
                               id="light_<?php
                               $bike_s->getConvert()->yesNo($cond);
                               ?>"

                               value="<?php
                               echo $cond;
                               ?>"

                            <?php if(isset($bike_s->getOneBike()["lights"]) && $bike_s->getOneBike()["lights"] ==
                                $cond
                            ):?>
                                checked
                            <?php endif; ?>

                        >
                        <label class="custom-control-label" for="light_<?php
                        $bike_s->getConvert()->yesNo($cond);
                        ?>"><?php
                            $bike_s->getConvert()->yesNo($cond);
                            ?></label>
                    </div>

                <?php endforeach; ?>

            </div>

            <div class="form-group col-12 mt-2">
                <span>mudguards</span>
                <?php foreach ($bike_s->getConvert()->getYesNo() as $cond):?>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio"
                               name="mudguards"
                               class="custom-control-input"
                               id="mudguards_<?php
                               $bike_s->getConvert()->yesNo($cond);
                               ?>"

                               value="<?php
                               echo $cond;
                               ?>"

                            <?php if(isset($bike_s->getOneBike()["mudguards"]) && $bike_s->getOneBike()["mudguards"] ==
                                $cond
                            ):?>
                                checked
                            <?php endif; ?>

                        >
                        <label class="custom-control-label" for="mudguards_<?php
                        $bike_s->getConvert()->yesNo($cond);
                        ?>"><?php
                            $bike_s->getConvert()->yesNo($cond);
                            ?></label>
                    </div>

                <?php endforeach; ?>

            </div>

            <div class="form-group col-12 mt-2">
                <span>front basket</span>
                <?php foreach ($bike_s->getConvert()->getYesNo() as $cond):?>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio"
                               name="front_basket"
                               class="custom-control-input"
                               id="front_basket_<?php
                               $bike_s->getConvert()->yesNo($cond);
                               ?>"

                               value="<?php
                               echo $cond;
                               ?>"

                            <?php if(isset($bike_s->getOneBike()["front_basket"]) && $bike_s->getOneBike()["front_basket"] ==
                                $cond
                            ):?>
                                checked
                            <?php endif; ?>

                        >
                        <label class="custom-control-label" for="front_basket_<?php
                        $bike_s->getConvert()->yesNo($cond);
                        ?>"><?php
                            $bike_s->getConvert()->yesNo($cond);
                            ?></label>
                    </div>

                <?php endforeach; ?>

            </div>

            <div class="form-group col-12 mt-2">
                <span>disk brakes</span>
                <?php foreach ($bike_s->getConvert()->getYesNo() as $cond):?>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio"
                               name="disk_brakes"
                               class="custom-control-input"
                               id="disk_bakes_<?php
                               $bike_s->getConvert()->yesNo($cond);
                               ?>"

                               value="<?php
                               echo $cond;
                               ?>"

                            <?php if(isset($bike_s->getOneBike()["disk_brakes"]) && $bike_s->getOneBike()["disk_brakes"] ==
                                $cond
                            ):?>
                                checked
                            <?php endif; ?>

                        >
                        <label class="custom-control-label" for="disk_bakes_<?php
                        $bike_s->getConvert()->yesNo($cond);
                        ?>"><?php
                            $bike_s->getConvert()->yesNo($cond);
                            ?></label>
                    </div>

                <?php endforeach; ?>

            </div>

        </div>

        <div class="col-12 border border-primary rounded mt-2">
            <h3>Has:</h3>

            <div class="form-group col-12  mt-2">
                <label for="wheel_size"></label>
                <!--        creates the select element and the selects using a for loop. -->

                <select class="custom-select" id="wheel_size" name="condition">
                    <?php if(($bike_s->getWheel()->fetchAllWheelSizes())):?>
                        <?php  foreach ($bike_s->getWheel()->fetchAllWheelSizes() as $wheel):?>

                    <option value="<?php echo $wheel['wheel_sizeID'] ?? "" ?>"
                            <?php if(!is_null($wheel['wheel_sizeID']) && $wheel['wheel_sizeID'] == $bike_s->getOneBike()
                            ['wheel_sizeID']):?>
                                selected
                            <?php endif; ?>
                            ><?php if(!is_null($wheel['wheel_ISO'])||!is_null($wheel['tire_ISO'])) {
                                echo $wheel['wheel_ISO']. ' / ' . $wheel['tire_ISO'];
                                } ?>
                    </option>


                        <?php endforeach; ?>
                    <?php else: ?>
                    <p>Create a wheel size first at <a href="./WheelSizeView.php"></a></p>
                    <?php endif;?>
                </select>
                <select class="custom-select" id="wheel_size" name="condition">
                    <?php if(($bike_s->getWheel()->fetchAllWheelSizes()) !== null):?>
                        <?php  foreach ($bike_s->getWheel()->fetchAllWheelSizes() as $wheel):?>

                            <option value="<?php echo $wheel['wheel_sizeID'] ?? "" ?>"
                                <?php if(!is_null($wheel['wheel_sizeID']) && $wheel['wheel_sizeID'] == $bike_s->getOneBike()
                                    ['wheel_sizeID']):?>
                                    selected
                                <?php endif; ?>
                            ><?php if(isset($wheel['wheel_ISO'])||isset($wheel['tire_ISO'])) {
                                    echo $wheel['wheel_ISO']. ' / ' . $wheel['tire_ISO'];
                                } ?>
                            </option>


                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Create a wheel size first at <a href="./WheelSizeView.php"></a></p>
                    <?php endif;?>
                </select>


            </div>

        </div>


        <div class="form-group col-12  mt-2">
            <label for="wheel_sizeID">Company wheel_sizeID</label>
            <textarea class="form-control"
                      id="wheel_sizeID" rows="5"
                      name="wheel_sizeID"><?php echo $bike_s->getOneBike()['wheel_sizeID'] ?? ''?></textarea>
        </div>

        <div class="form-group col-12  mt-2">
            <label for="braking_systemID">Company braking_systemID</label>
            <textarea class="form-control"
                      id="braking_systemID" rows="5"
                      name="braking_systemID"><?php echo $bike_s->getOneBike()['braking_systemID'] ?? ''?></textarea>
        </div>

        <div class="form-group col-12  mt-2">
            <label for="drive_typeID">Company drive_typeID</label>
            <textarea class="form-control"
                      id="drive_typeID" rows="5"
                      name="drive_typeID"><?php echo $bike_s->getOneBike()['drive_typeID'] ?? ''?></textarea>
        </div>
        <div class="form-group col-12  mt-2">-->
                    <label for="created_by">Company created_by</label>
                    <textarea class="form-control"
                              id="created_by" rows="5"
                              name="created_by"><?php echo $bike_s->getOneBike()['created_by'] ??
     ''?></textarea>
                </div>

        <?php if(isset($bike_s->getOneBike()['bike_specificationsID'])): ?>

            <input type="text" hidden
                   name = "bike_specificationsID"
                   value = "<?php echo $bike_s->getOneBike()['bike_specificationsID'] ?>">

        <?php endif; ?>
        <div class="form-group col-12 mt-2">
            <input type="submit" class="btn <?php echo !$bike_s->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                   name="<?php echo !$bike_s->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                   value="<?php echo !$bike_s->getUpdate() ? 'Create new' : 'update' ?>">
        </div>

    </form>

</section>
