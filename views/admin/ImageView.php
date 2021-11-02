<?php


$img = new ImageController();
$img->setImage();

?>


<div class="container-fluid m-2 row">
    <section class="row col-12 row mt-5 col-md-8 offset-md-2 pb-5">

        <div class="col-12 col-md-12 offset-md-2 mt-5 mb-3 ">
            <h2>
                Images
            </h2>
        </div>
        <h3 class="col-12 col-md-8 offset-md-2">All images</h3>
        <table class="table table-sm col-12 col-md-8 offset-md-2 pb-5 border-bottom border-secondary">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">URL</th>
                <th scope="col">alt</th>
                <th scope="col">Image</th>
                <th scope="col">Controls</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($img->getImage()->fetchAllImages() as $res): ?>
                <tr>
                    <th scope="row"> <?php echo $res['imageID']?></th>
                    <td><?php echo $res['name']?></td>
                    <td><?php echo $res['URL']?></td>
                    <td><?php echo $res['alt']?></td>
                    <td><img src="<?php echo '/bike-shop-solution/public/img/' . $res['URL'] ?>"
                             height="100px" alt="<?php echo $res['alt'] ?>"
                    </td>
<!--                    <td><img src="../../../public/61795542e0e6b_north-american-cycle-courier-championship.jpeg"-->
<!--                             height="100px" alt="--><?php //echo $res['alt'] ?><!--"-->
<!--                    </td>-->

                    <td>

<!--                        . $res['URL']-->
                        <form action="" method="post" class="d-inline-block">
                            <input type="text" hidden name="imageID" value="<?php echo $res['imageID'] ?>">
                            <input type="submit" name="update" value="update" class="btn btn-info" >
                        </form>
                        <form action="" method="post" class="d-inline-block">
                            <input type="text" hidden name="imageID" value="<?php echo $res['imageID'] ?>">
                            <input type="submit" name="delete" value="delete" class="btn btn-danger" onclick="return confirm('Delete! are you sure?')" >
                        </form>
                    </td>

                </tr>
            <?php endforeach ?>

            </tbody>
        </table>


        <!--    display message-->
        <?php if(isset($img->getImage()->message)): ?>

            <div class="col-12 col-md-8 offset-md-2">
                <h3><?php echo $img->getImage()->message ?></h3>
            </div>

        <?php endif  ?>


        <!--    the form for creating and updating drive_type starts here-->



        <form class="col-12 row mt-5 col-md-8 offset-md-2 pb-5" action="" method="post" id="form" enctype="multipart/form-data">
            <p class="text-secondary  col-12"><?php echo !$img->getUpdate() ? "Create new drive type" : "Update product " .  $img->getImg()['name'] ?? '' ?> </p>
            <div class="form-group col-12 mt-2">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name of the  drive type"
                       value=" <?php echo isset($img->getImg()['name']) ? $img->getImg()['name'] : '' ?>" required>
            </div>

            <div class="form-group col-12 mt-2">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" placeholder="upload image"
            </div>


            <div class="form-group col-12 mt-2">
                <label for="URL">URL</label>
                <input type="text" class="form-control" id="URL" name="URL" placeholder="URL"
                       value="<?php echo isset($img->getImg()['URL']) ? trim($img->getImg()['URL']) : ''?>" required>
            </div>

            <div class="form-group col-12 mt-2">
                <label for="alt">Alt</label>
                <input type="text" class="form-control" id="alt" name="alt" placeholder="alt form the image"
                       value=" <?php echo isset($img->getImg()['name']) ? $img->getImg()['name'] : '' ?>" required>
            </div>

            <?php  if(isset($img->getImg()['URL'])):?>
                <img
                        src="<?php echo isset($img->getImg()['URL']) ? $img->getImg()['URL'] : '' ?> "
                        alt="<?php echo isset($img->getImg()['alt']) ? $img->getImg()['alt'] : '' ?>">
            <?php endif; ?>

            <?php if(isset($img->getImg()['imageID'])): ?>

                <input type="text" hidden name="imageID" value ="<?php echo $img->getImg()['imageID'] ?>">

            <?php endif; ?>
            <div class="form-group col-12 mt-2">
                <input type="submit" class="btn <?php echo !$img->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                       name="<?php echo !$img->getUpdate() ? 'submit-new' : 'submit-update' ?>" value="<?php echo
                !$img->getUpdate() ? 'Create new' : 'update' ?>">
            </div>

        </form>

    </section>
</div>


