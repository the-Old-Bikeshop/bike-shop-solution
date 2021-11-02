<?php
    // Initializing admin Drive Type controller
    $dt = new DriveTypeController();
    $dt->setDriveType();
    $dt->getDriveType();
?>
<section class="row col-12">
    <div style="align-items:center; justify-content:space-between; border-bottom:2px dashed rgba(0,0,0,0.15); padding:1rem; width:100%; display: flex;">
        <h1>
            Drive Types
        </h1>
        <button data-toggle="modal" data-target="#exampleModalCenter" style="height: 3rem;" type="button" class="btn btn-primary">
            Create New
        </button>
    </div>
    <div style="padding-left:1rem; padding:1rem; width:100%;">
        <div class="card bg-light col-12 p-0">
            <table class="table table-sm col-12">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Short description</th>
                        <th scope="col">Description</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody class="col-12">
                    <?php foreach ($dt->getDriveType()->fetchAllDriveTypes() as $res) : ?>
                        <tr class="ml-2">
                            <th scope="row"> <?php echo $res["drive_typeID"] ?></th>
                            <td><?php echo $res['name'] ?></td>
                            <td><?php echo $res['short_description'] ?></td>
                            <td><?php echo $res['description'] ?></td>
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="text" hidden name="drive_typeID" value="<?php echo $res['drive_typeID'] ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="text" hidden name="drive_typeID" value="<?php echo $res['drive_typeID'] ?>">
                                    <input type="submit" name="delete" value="delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete! are you sure?')">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--    display message-->
    <?php if (isset($dt->getDriveType()->message)) : ?>
        <div class="col-12 col-md-8 offset-md-2">
            <h3><?php echo $dt->getDriveType()->message ?></h3>
        </div>
    <?php endif  ?>

    <!--    the form for creating and updating drive_type starts here-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <?php echo !$dt->getUpdate() ? "Create new drive type" : "Update product " . $dt->getDrive()['name'] ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="col-12" action="" method="post" id="form">
                        <div class="form-group col-12 mt-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name of the drive type" value=" <?php echo $dt->getDrive()['name'] ?? '' ?>" required>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="short_description">Short description(max 255 characters)</label>
                            <input type="text" class="form-control" id="short_description" name="short_description" placeholder="short description 255 characters" value="<?php echo $dt->getDrive()['short_description'] ?? '' ?>"">
                        </div>
                        <div class=" form-group col-12 mt-2">
                            <label for="description">Describe products in detail</label>
                            <textarea class="form-control" id="description" rows="5" name="description"><?php echo $dt->getDrive()['description'] ?? '' ?></textarea>
                        </div>
                        <?php if (isset($dt->getDrive()['drive_typeID'])) : ?>
                            <input type="text" hewidden name="drive_typeID" value="<?php echo $dt->getDrive()['drive_typeID'] ?>">
                        <?php endif; ?>
                        <div class="form-group col-12 mt-2">
                            <input type="submit" class="btn <?php echo !$dt->getUpdate() ? 'btn-primary' : 'btn-info' ?>" name="<?php echo !$dt->getUpdate() ? 'submit-new' : 'submit-update' ?>" value="<?php echo !$dt->getUpdate() ? 'Create new' : 'update' ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
