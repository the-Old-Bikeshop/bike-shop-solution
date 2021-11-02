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

<section class="row row col-12 row mt-5 col-md-8 offset-md-2 pb-5">

    <div class="col-12 col-md-12 offset-md-2 mt-5 mb-3 ">
        <h2>
            category list
        </h2>
    </div>
    <table class="table table-sm col-12 col-md-8 offset-md-2 pb-5 border-bottom border-secondary">
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
                        <input type="submit" name="update" value="update" class="btn btn-info" >
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


    <!--    display message-->


    <!--    the form for creating and updating drive_type starts here-->


    <form action="" method="post" class="col-12 row mt-5 col-12 col-md-8 offset-md-2 pb-5"  id="form">

        <p class="text-secondary  col-12"><?php echo !$ct->getUpdate() ? "Create new wheel size" : "Update product " .

                $ct->getOneCategory()['name'] . $ct->getOneCategory()['short_description'];

            ?> </p>
        <div class="form-group col-12 mt-2">
            <label for="name">name</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="wheel ISO"
                   value=" <?php echo $ct->getOneCategory()['name'] ?? '' ?>" required>
        </div>

        <div class="form-group col-12  mt-2">
            <label for="short_description">short description(teaser)</label>
            <input type="text" class="form-control" id="short_description" name="short_description"
                   placeholder="tire ISO"
                   value="<?php echo $ct->getOneCategory()['short_description'] ?? ''?>"">
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
                   value = "<?php echo $ct->getOneCategory()['categoryID'] ?>">

        <?php endif; ?>
        <div class="form-group col-12 mt-2">
            <input type="submit" class="btn <?php echo !$ct->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                   name="<?php echo !$ct->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                   value="<?php echo !$ct->getUpdate() ? 'Create new' : 'update' ?>">
        </div>

    </form>

</section>

