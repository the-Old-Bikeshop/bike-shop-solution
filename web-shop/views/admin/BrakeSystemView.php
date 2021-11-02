<?php
    // Initializing admin Brake system controller
    $br = new BrakeSystemController();

    $br->setBrake();
    $br->getBrake();
?>

<section class="row col-12">
    <div style="align-items:center; justify-content:space-between; border-bottom:2px dashed rgba(0,0,0,0.15); padding:1rem; width:100%; display: flex;">
        <h1>
            Break Systems
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
                    <th scope="col">Condition id</th>
                    <th scope="col">Condition</th>
                    <th scope="col">Controls</th>
                </tr>
                </thead>
                <tbody class="col-12">
                <?php foreach ($br->getBrake()->fetchAllBrakeSystems() as $res): ?>
                    <tr>
                        <th scope="row"> <?php echo $res['braking_systemID']?></th>
                        <td><?php echo $res['name']?></td>
                        <td><?php echo $res['condition']?></td>
                        <td><?php $br->getConvert()->condition($res['condition'])?></td>
                        <td>
                            <form action="" method="post" class="d-inline-block p-0 m-0">
                                <input type="text" hidden name="braking_systemID" value="<?php echo $res['braking_systemID'] ?>">
                                <input type="submit" name="update" value="update"  class="btn btn-outline-secondary btn-sm">
                            </form>
                            <form action="" method="post" class="d-inline-block p-0 m-0">
                                <input type="text" hidden name="braking_systemID" value="<?php echo $res['braking_systemID'] ?>">
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
    <?php if(isset($brake->message)): ?>
        <div class="col-12 col-md-8 offset-md-2">
            <h3><?php echo $brake->message ?></h3>
        </div>
    <?php endif  ?>

    <!--    the form for creating and updating drive_type starts here-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <?php echo !$br->getUpdate() ? "Create new drive type" : "Update product " . $br->getVal()['name'] ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="col-12" action="" method="post" id="form">
                        <div class="form-group col-12 mt-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name of the drive type" value=" <?php echo isset($br->getVal()['name']) ? $br->getval()['name'] : '' ?>" required>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="condition">Products condition</label>
                            <!-- creates the select element and the selects using a for loop. -->
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
                        <?php if(isset($br->getVal()['braking_systemID'])): ?>
                            <input type="text" hidden name = "braking_systemID" value = "<?php echo $br->getVal()['braking_systemID'] ?>">
                        <?php endif; ?>
                        <div class="form-group col-12 mt-2">
                            <input type="submit" class="btn <?php echo !$br->getUpdate() ? 'btn-primary' : 'btn-info' ?>" name="<?php echo !$br->getUpdate() ? 'submit-new' : 'submit-update' ?>" value="<?php echo !$br->getUpdate() ? 'Create new' : 'update' ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


