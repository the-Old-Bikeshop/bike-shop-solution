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
<div style="display: flex; justify-content:space-between; align-items:flex-start;">
    <?php include_once "./includes/adminNavigation.php"?>
    <section style="width:80vw;">
        <div style="align-items:center; justify-content:space-between; border-bottom:2px dashed rgba(0,0,0,0.15); padding:1rem; width:100%; display: flex;">
            <h1>
                Categories
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
                        <th scope="col">name</th>
                        <th scope="col">short description</th>
                        <th scope="col">description</th>
                        <th scope="col">controls</th>
                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($ct->getCategories()->fetchAll('category') as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res["categoryID"] ?></th>
                            <td><?php echo $res['name']?></td>
                            <td><?php echo $res['short_description']?></td>
                            <td><?php echo $res['description']?></td>
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="text" hidden name="categoryID" value="<?php echo $res['categoryID'] ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="text" hidden name="categoryID" value="<?php echo $res['categoryID'] ?>">
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

        <!--    the form for creating and updating drive_type starts here-->
        <div class="modal fade <?php echo isset($_POST["update"]) ? 'show' : ' ' ?>" id="exampleModalCenter" tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["update"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">   
                            <?php echo !$ct->getUpdate() ? "Create new" : "Update: " .
                                $ct->getOneCategory()['name'] . $ct->getOneCategory()['short_description'];
                            ?> 
                        </h5>
                        <form action="" method="post">
                            <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
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
                                    value="<?php echo $ct->getOneCategory()['short_description'] ?? ''?>"
                                >
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="description">description</label>
                                <textarea
                                    class="form-control"
                                    name="description"
                                    id="description"
                                    rows="5"><?php echo $ct->getOneCategory()['description']??''?></textarea>
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
                                <input type="submit" class="btn btn-secondary" value="Cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

