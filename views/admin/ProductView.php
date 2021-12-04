<?php
$product = new ProductsController();
$product->setProduct();

?>

<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Products
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
                        <th scope="col">price</th>
                        <th scope="col">model_name</th>
                        <th scope="col">stock</th>
                        <th scope="col">description</th>
                        <th scope="col">short_description</th>
                        <th scope="col">length</th>
                        <th scope="col">weight</th>
                        <th scope="col">color</th>
                        <th scope="col">bike_specificationsID</th>
                        <th scope="col">brandID</th>
                        <th scope="col">images</th>
                        <th scope="col">created_by</th>
                        <th scope="col">created_at</th>
                        <th scope="col">Controls</th>
                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($product->getAllProducts() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res['productID']?></th>
                            <td><?php echo $res['name']?></td>
                            <td><?php echo $res['price']?></td>
                            <td><?php echo $res['model_name']?></td>
                            <td><?php echo $res['stock']?></td>
                            <td><?php echo $res['description']?></td>
                            <td><?php echo $res['short_description']?></td>
                            <td><?php echo $res['length']?></td>
                            <td><?php echo $res['weight']?></td>
                            <td><?php echo $res['color']?></td>
                            <td>
                                <?php echo $product->getOneBikeSpecificationType($res['bike_specificationsID'])?>
                            </td>
                            <td>

                                <?php echo $product->getOneBrandName($res['brandID'])?>
                            </td>
                            <td>
                                <?php foreach($product->getProducts()->fetchImageList($res['productID']) as $img): ?>

                                <?php $url = $product->getOneImage($img['imageID']); ?>
                                        <img
                                            src="<?php echo '/bike-shop-solution/public/img/' . $res['URL'] ?>?>"
                                            alt="<?php echo $url['alt'] ?? '' ?>"
                                            height="50px"
                                        >
                                    <?php echo $url['URL'] ?>
                                <?php endforeach; ?>
                            </td>
                            <td><?php echo $res['created_by']?></td>
                            <td><?php echo $res['created_at']?></td>
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="productID" value="<?php echo $res['productID'] ?>">
                                    <input type="submit" name="update" value="update"  class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="favorites" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="likedProductsID" value="<?php echo $res['productID'] ?>">
                                    <input type="hidden" hidden name="userID" value="<?php echo $_SESSION['userID'] ?>">
                                    <input type="submit" name="like"
                                           value="<?php if(array_search($res['productID'],
                                               array_column( $_SESSION['userFavorites'], 'productID')) !== false) {
                                                echo 'unlike';
                                            }else {
                                                echo 'like';
                                            }?>"
                                           class="btn btn-outline-secondary
                                    btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="productID" value="<?php echo $res['productID'] ?>">
                                    <input type="submit" name="addImage" value="add image" class="btn btn-outline-secondary
                                    btn-sm" >
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="productID" value="<?php echo $res['productID'] ?>">
                                    <input type="submit" name="addCategory" value="add category" class="btn
                                    btn-outline-secondary
                                    btn-sm" >
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="productID" value="<?php echo $res['productID'] ?>">
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
        <?php if(isset($product->getProducts()->message)): ?>
            <div class="col-12 col-md-8 offset-md-2">
                <h3><?php echo $product->getProducts()->message ?></h3>
            </div>
        <?php endif  ?>

        <?php if(isset($product->getProductImage()->message)): ?>
            <div class="col-12 col-md-8 offset-md-2">
                <h3><?php echo $product->getProductImage()->message ?></h3>
            </div>
        <?php endif  ?>

        <?php if($product->getMessage() !== null): ?>
            <div class="col-12 col-md-8 offset-md-2">
                <h3><?php echo $product->getMessage() ?></h3>
            </div>
        <?php endif  ?>

        <?php if($product->getLike()->getLikes()->message !== null): ?>
            <div class="col-12 col-md-8 offset-md-2">
                <h3><?php echo $product->getLike()->getLikes()->message ?></h3>
            </div>
        <?php endif  ?>


        <!--    the form for creating and updating drive_type starts here-->
        <div class="modal fade <?php echo isset($_POST["update"]) ? 'show' : ' ' ?>" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["update"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo !$product->getUpdate() ? "Create new" : "Update: " . $product->getProduct()['name'] ?>
                        </h5>
                        <form action="" method="post" >
                            <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                    </div>
                    <div class="modal-body">
                        <form class="col-12" action="" method="post" id="form" enctype="multipart/form-data" >
                            <div class="form-group col-12 mt-2">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="product_name" placeholder="name of the drive type"
                                    value=" <?php echo $product->getProduct()['name'] ?? '' ?>"
                                    required
                                >
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="model_name">model_name</label>
                                <input type="text" class="form-control" id="model_name" name="model_name" placeholder="model_name"
                                    value=" <?php echo $product->getProduct()['model_name'] ?? '' ?>"
                                    required>
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="short_description">short_description</label>
                                <input type="text" class="form-control" id="short_description" name="short_description" placeholder="short_description"
                                    value=" <?php echo $product->getProduct()['short_description'] ?? '' ?>"
                                    >
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="price">price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="price"
                                    value=" <?php echo $product->getProduct()['price'] ?? '' ?>"
                                    >
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="stock">stock</label>
                                <input type="text" class="form-control" id="stock" name="stock" placeholder="stock"
                                    value=" <?php echo $product->getProduct()['stock'] ?? '' ?>"
                                    >
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="color">color</label>
                                <input type="text" class="form-control" id="color" name="color" placeholder="color"
                                    value=" <?php echo $product->getProduct()['color'] ?? '' ?>"
                                    >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="weight">weight</label>
                                <input type="text" class="form-control" id="weight" name="weight" placeholder="weight"
                                    value=" <?php echo $product->getProduct()['stock'] ?? '' ?>"
                                >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="length">length</label>
                                <input type="text" class="form-control" id="length" name="length" placeholder="length"
                                    value=" <?php echo $product->getProduct()['length'] ?? '' ?>"
                                >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="description">description</label>
                                <textarea  class="form-control" id="description" name="description" placeholder="description"><?php echo $product->getProduct()['description'] ?? '' ?></textarea>
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="description">Brand</label>
                                <select class="custom-select" id="brand" name="brandID">
                                    <?php if(($product-> getAllBrands() !== null)) {
                                        foreach ($product-> getAllBrands() as $brand):?>
                                            <option value="<?php echo $brand['brandID'] ?? "" ?>"
                                                <?php if(!isset($brand['brandID']) && isset($product->getProduct()['brandID']) &&
                                                    $brand['brandID'] ==
                                                    $product->getProduct()['brandID']):?>
                                                    selected
                                                <?php endif; ?>
                                            >
                                                <?php echo $brand['name'] ?? ""?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php } else {?>
                                        <p>Create a brake system first at <a href="./BrandView.php"> brake system</a></p>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="description">Bike specifications</label>
                                <select class="custom-select" id="brand" name="bike_specificationsID">
                                    <?php if(($product->getAllBikeSpecifications() !== null)) {
                                        foreach ($product->getAllBikeSpecifications() as $speks):?>
                                            <option value="<?php echo $speks['bike_specificationsID'] ?? "" ?>"
                                                <?php if(!isset($speks['bike_specificationsID']) && isset($product->getProduct()
                                                        ['bike_specificationsID']) &&
                                                    $speks['bike_specificationsID'] ==
                                                    $product->getProduct()['bike_specificationsID']):?>
                                                    selected
                                                <?php endif; ?>
                                            >
                                            <?php
                                              echo $speks['type'] ?? ""
                                            ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php } else {?>
                                        <p>Create a brake system first at <a href="./BikeSpecificationsView.php"> brake system</a></p>
                                    <?php } ?>
                                </select>
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
                            <input type="hidden" name="created_by" value="1">
                            <?php if(isset($product->getProduct()['productID'])): ?>
                                <input type="hidden" hidden name = "productID" value = "<?php echo $product->getProduct()['productID']?>">
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn
                                    <?php echo !$product->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                    name="<?php echo !$product->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                    value="<?php echo !$product->getUpdate() ? 'Create new' : 'update' ?>">
                                <form action="">
                                    <input type="submit" class="btn btn-secondary" value="Cancel">
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade <?php echo isset($_POST["addImage"]) ? 'show' : ' ' ?>" id="addImage"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["addImage"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo $_POST['addImage'] ? "Add or remove image for" : "" .
                                $product->getProduct()['name'] ?>
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
                                <?php foreach($product->getProducts()->fetchImageList($_POST['productID']) as $img): ?>
                                    <?php $url = $product->getOneImage($img['imageID']); ?>
                                    <img
                                            src="./public/img/<?php echo $url['URL'] ?? '' ?>"
                                            alt="<?php echo $url['alt'] ?? '' ?>"
                                            height="50px"
                                    >
                                    <?php echo $url['URL'] ?>
                                        <input type="hidden" name="deleteImageID" value="<?php echo $img['imageID'] ?>">
                                        <input type="hidden" name="deleteProductID" value="<?php echo $_POST['productID']?>">
                                        <input type="submit" name="deleteImage" value="delete image">
                                <?php endforeach; ?>
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

                            <?php if(isset($_POST['productID'])): ?>
                                <input type="hidden" hidden name = "productID" value = "<?php echo $_POST['productID'] ?>">
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
        <div class="modal fade <?php echo isset($_POST["addCategory"]) ? 'show' : ' ' ?>" id="addCategory"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["addCategory"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo $_POST['addCategory'] ? "Add or remove category for" : "" .
                                $product->getProduct()['name'] ?>
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
                                <?php foreach($product->getCategoriesForProduct($_POST['productID']) as
                                              $categotyID):
                                    ?>
                                    <?php $category = $product->fetchOneCategory($categotyID['categoryID']) ?>
                                    <?php echo $category['name'] ?>
                                    <input type="hidden" name="deleteCategoryID" value="<?php echo $category['categoryID'] ?>">
                                    <input type="hidden" name="deleteProductID" value="<?php echo $_POST['productID']?>">
                                    <input type="submit" name="deleteCategory" value="delete category">
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="category">Product Category</label>
                                <select class="custom-select col-12 mt-2"
                                        name="categoryID"
                                        id="category">
                                    <?php if($product->getAllCategories() !== null): ?>
                                        <?php foreach($product->getAllCategories() as $cat): ?>
                                        <option value="<?php echo $cat["categoryID"]?>"><?php echo $cat["name"]
                                            ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <?php if(isset($_POST['productID'])): ?>
                                <input type="hidden" hidden name = "productID" value = "<?php echo $_POST['productID'] ?>">
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn btn-primary"
                                       name="addNewCategory"
                                       value="add new category">
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
