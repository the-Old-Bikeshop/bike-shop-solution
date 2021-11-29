<?php
$img = new ImageController();
$img->setImage();
?>

<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Images
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
                        <th scope="col">Name</th>
                        <th scope="col">URL</th>
                        <th scope="col">alt</th>
                        <th scope="col">Image</th>
                        <th scope="col">Controls</th>
                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($img->getAllImages() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res['imageID']?></th>
                            <td><?php echo $res['name']?></td>
                            <td><?php echo $res['URL']?></td>
                            <td><?php echo $res['alt']?></td>
                            <td>
                            <image src="<?php echo '/bike-shop-solution/public/img/' . $res['URL'] ?>"
                                    height="100px" alt="<?php echo $res['alt'] ?>"
                            />
                            </td>
                            <td>
                                <form action="" method="post" class="d-inline-block">
                                    <input type="hidden" hidden name="imageID" value="<?php echo $res['imageID'] ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block">
                                    <input type="hidden" hidden name="imageID" value="<?php echo $res['imageID'] ?>">
                                    <input type="submit" name="delete" value="<?php if(array_search($res['imageID'],
                                            array_column( $img->getUsedImages(), 'usedImageID')) !== false): ?>
                                                image in use
                                            <?php else: ?>
                                                delete
                                            <?php endif; ?>"
                                           <?php if(array_search($res['imageID'],
                                               array_column( $img->getUsedImages(), 'usedImageID')) !== false): ?>
                                                disabled
                                            <?php endif; ?>
                                           class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete! are you sure?')">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>          


            <!--    display message-->
            <?php if(isset($img->getImage()->message)): ?>

                <div class="col-12 col-md-8 offset-md-2">
                    <h3><?php echo $img->getImage()->message ?></h3>
                </div>

            <?php endif  ?>


            <!--    the form for creating and updating drive_type starts here-->

            <!--    the form for creating and updating drive_type starts here-->
        <div class="modal fade  <?php echo isset($_POST["update"]) ? 'show' : ' ' ?>" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["update"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo !$img->getUpdate() ? "Create new" : "Update: " .  $img->getImg()['name'] ?? '' ?>
                        </h5>
                        <form action="" method="post">
                            <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                    </div>
                    <div class="modal-body">
                        <form class="col-12" action="" method="post" id="form" enctype="multipart/form-data">
                            <div class="form-group col-12 mt-2">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="name of the  drive type"
                                    value=" <?php echo isset($img->getImg()['name']) ? $img->getImg()['name'] : '' ?>" required
                                >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="URL">URL</label>
                                <input type="text" class="form-control" id="URL" name="URL"
                                    value="<?php echo isset($img->getImg()['URL']) ? trim($img->getImg()['URL']) : ''?>"
                                >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="alt">Alt</label>
                                <input type="text" class="form-control" id="alt" name="alt" placeholder="alt form the image"
                                    value=" <?php echo isset($img->getImg()['name']) ? $img->getImg()['name'] : '' ?>" required
                                >
                            </div>
                            <?php if(isset($img->getImg()['imageID'])): ?>
                                <input type="hidden" hidden name="imageID" value ="<?php echo $img->getImg()['imageID'] ?>">
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn <?php echo !$img->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                    name="<?php echo !$img->getUpdate() ? 'submit-new' : 'submit-update' ?>" value="<?php echo
                                    !$img->getUpdate() ? 'Create new' : 'update' ?>"
                                >
                                <input type="submit" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" value="Cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>




















