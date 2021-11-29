<?php
$brand = new BrandController();
$brand->setBrand();
?>
<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Brands
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
                        <th scope="col">name</th>
                        <th scope="col">description</th>
                        <th scope="col">short_description</th>
                        <th scope="col">website</th>
                        <th scope="col">image</th>
                        <th scope="col">controls</th>
                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($brand->fetchAllBrands() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res["brandID"] ?></th>
                            <td><?php echo $res['name']?></td>
                            <td><?php echo ($res['description'])?></td>
                            <td><?php echo $res['short_description']?></td>
                            <td><?php echo $res['website']?></td>
                            <td>
                                <?php if(isset($res['URL'])): ?>
                                <img
                                        src="<?php echo $res['URL']?>"
                                        alt="<?php echo $res['alt']?>"
                                height="50px"></td>
                            <?php endif?>
                            <td>    
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="brandID" value="<?php echo $res['brandID'] ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="brandID" value="<?php echo $res['brandID'] ?>">
                                    <input type="submit" name="addImage" value="add image" class="btn btn-outline-secondary
                                    btn-sm" >
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="brandID" value="<?php echo $res['brandID'] ?>">
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
        <h3>
            <?php echo $brand->getBrands()->message  ?>
        </h3>


        <!--    the form for creating and updating drive_type starts here-->
        <div class="modal fade <?php echo isset($_POST["update"]) ? 'show' : ' ' ?>" id="exampleModalCenter" tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["update"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo !$brand->getUpdate() ? "Create new" : "Update: " .
                                $brand->getOneBrand()['name'] . $brand->getOneBrand()['short_description'];
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
                                       placeholder="name"
                                       value=" <?php echo $brand->getOneBrand()['name'] ?? '' ?>" required
                                >
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="description">Description</label>
                                <textarea
                                    class="form-control"
                                    name="description"
                                    id="description"
                                    rows="5"><?php echo $brand->getOneBrand()['description']??''?></textarea>
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="short_description">Short description</label>
                                <textarea
                                    class="form-control"
                                    name="short_description"
                                    id="short_description"
                                    rows="5"><?php echo $brand->getOneBrand()['short_description']??''?></textarea>
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="website">website</label>
                                <input type="text" class="form-control" id="website" name="website"
                                       placeholder="www.website.com"
                                       value=" <?php echo $brand->getOneBrand()['website'] ?? '' ?>" required
                                >
                            </div>

                            <?php if(isset($brand->getOneBrand()['brandID'])): ?>
                                <input type="hidden" hidden
                                       name = "brandID"
                                       value = "<?php echo $brand->getOneBrand()['brandID'] ?>"
                                >
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn <?php echo !$brand->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                       name="<?php echo !$brand->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                       value="<?php echo !$brand->getUpdate() ? 'Create new' : 'update' ?>"
                                >
                                <input type="submit" class="btn btn-secondary" value="Cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade <?php echo isset($_POST["addImage"]) ? 'show' : ' ' ?>" id="addImage" tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["addImage"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-name" id="exampleModalLongname">

                            <?php echo $_POST['addImage'] ? "Add or remove image for" : "" .
                                $brand->getOneBrand()['name'];?>
                        </h5>
                        <form action="" method="post" >
                            <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                    </div>
                    <div class="modal-body">
                        <form class="col-12" action="" method="post" id="form" enctype="multipart/form-data" >
                            <div class="d-flex">
                                <?php if(isset($brand->getOneBrand()['imageID'])):?>
                                    <img
                                            src="<?php echo $brand->getOneImage()['URL'] ?>"
                                            alt="<?php echo $brand->getOneImage()['alt'] ?>"
                                            height="50px"
                                    >
                                <?php endif; ?>

                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="description">Product Image</label>
                                <div class="form-group col-12 mt-2">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="image name"
                                           value=""
                                    >
                                </div>
                                <div class="form-group col-12 mt-2">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="form-group col-12 mt-2">
                                    <label for="URL">URL</label>
                                    <input type="text" class="form-control" id="URL" name="URL"
                                           value=""
                                    >
                                </div>
                                <div class="form-group col-12 mt-2">
                                    <label for="alt">Alt</label>
                                    <input type="text" class="form-control" id="alt" name="alt" placeholder="alt form the image"
                                           value=""
                                    >
                                </div>
                            </div>

                            <?php if(isset($_POST['brandID'])): ?>
                                <input type="hidden" hidden name="brandID" value = "<?php echo $_POST['brandID'] ?>">
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn btn-primary"
                                       name="addNewImage"
                                       value="add New Image">
                                <form action="" method="post">
                                    <input type="submit" class="btn btn-secondary" value="Cancel">
                                </form>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
