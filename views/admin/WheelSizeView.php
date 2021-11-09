<?php
$ws=new WheelSizeController();
$ws->setWheelSize();
$ws->getWheelSize();

?>

<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Wheel Sizes
            </h1>
            <button data-toggle="modal" data-target="#exampleModalCenter" style="height: 3rem;" type="button" class="btn btn-dark admin-main-button">
                Create New
            </button>
        </div>
        <div class="page_content_wrapper">
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
                    <?php foreach ($ws->getWheelSize()->fetchAll('wheel_size') as $res): ?>
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
        <div class="modal fade <?php echo isset($_POST["update"]) ? 'show' : ' ' ?>" id="exampleModalCenter" tabindex="-1" 
            role="dialog" 
            aria-labelledby="exampleModalCenterTitle"
            <?php echo isset($_POST["update"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">   
                            <?php echo !$ws->getUpdate() ? "Create new" : "Update: " .
                                        $ws->getWheel()['wheel_ISO'] . $ws->getWheel()['tire_ISO'];
                            ?> 
                        </h5>
                        <form action="" method="post">
                            <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
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
                                <input type="submit" class="btn btn-secondary" value="Cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

