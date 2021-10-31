<?php
//CREATE TABLE category (
//    categoryID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//  `name` VARCHAR(100) NOT NULL,
//  `description` TEXT,
//  short_description VARCHAR(255)
//);
    $ct = new CategoryController();
    $ct->setcategories();
?>
<section class="row col-12">
    <div style="align-items:center; justify-content:space-between; border-bottom:2px dashed rgba(0,0,0,0.15); padding:1rem; width:100%; display: flex;">
        <h1>
            Categories
        </h1>
        <button data-toggle="modal" data-target="#exampleModalCenter" style="height: 3rem;" type="button" class="btn btn-primary">
            Create New
        </button>
    </div>
    <div style="padding-left:1rem; padding:1rem; width:100%;">
        <h3 style="padding: 0; margin-top:0.5rem;" class="col-12">All Categories</h3>
        <table class="table table-sm col-12 col-md-8 pb-5 border-bottom border-secondary">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">short description</th>
                <th scope="col">description</th>
                <th scope="col">controls</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ct->getCategories()->fetchAllCategories() as $res): ?>
                <tr>
                    <th scope="row"> <?php echo $res["categoryID"] ?></th>
                    <td><?php echo $res['name']?></td>
                    <td><?php echo $res['short_description']?></td>
                    <td><?php echo $res['description']?></td>
                    <td>
                        <form action="" method="post" class="d-inline-block">
                            <input type="text" hidden name="categoryID" value="<?php echo $res['categoryID'] ?>">
                            <input type="submit" name="update" value="update" class="btn btn-secondary" >
                        </form>
                        <form action="" method="post" class="d-inline-block">
                            <input type="text" hidden name="categoryID" value="<?php echo $res['categoryID'] ?>">
                            <input type="submit" name="delete" value="delete" class="btn btn-danger" onclick="return confirm('Delete! are you sure?')" >
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <!--    display message-->

    <!--    the form for creating and updating drive_type starts here-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">   
                        <?php echo !$ct->getUpdate() ? "Create new wheel size" : "Update product " .
                            $ct->getOneCategory()['name'] . $ct->getOneCategory()['short_description'];
                        ?> 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="col-12" id="form">
                        <div class="form-group col-12 mt-2">
                            <label for="name">name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="wheel ISO"
                                value=" <?php echo $ct->getOneCategory()['name'] ?? '' ?>" required
                            >
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="short_description">short description(teaser)</label>
                            <input type="text" class="form-control" id="short_description" name="short_description"
                                placeholder="tire ISO"
                                value="<?php echo $ct->getOneCategory()['short_description'] ?? ''?>"
                            >
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="description">description</label>
                            <textarea
                                class="form-control"
                                name="description"
                                id="description"
                                rows="5"><?php echo $ct->getOneCategory()['description']??''?>
                            </textarea>
                        </div>
                        <?php if(isset($ct->getOneCategory()['categoryID'])): ?>
                            <input type="text" hidden
                                name = "categoryID"
                                value = "<?php echo $ct->getOneCategory()['categoryID'] ?>"
                            >
                        <?php endif; ?>
                        <div class="form-group col-12 mt-2">
                            <input type="submit" class="btn <?php echo !$ct->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                name="<?php echo !$ct->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                value="<?php echo !$ct->getUpdate() ? 'Create new' : 'update' ?>"
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

