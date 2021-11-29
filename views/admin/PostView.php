<?php
$post = new PostController();
$post->setPost();
?>
<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Posts
            </h1>
            <button data-toggle="modal" data-target="#modal" style="height: 3rem;" type="button" class="btn btn-dark
            admin-main-button">
                Create New
            </button>
        </div>
        <div class="page_content_wrapper">
            <div class="card bg-light col-12 p-0">
                <table class="table table-sm col-12">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">title</th>
                        <th scope="col">content</th>
                        <th scope="col">for Product</th>
                        <th scope="col">images</th>
                        <th scope="col">controls</th>
                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($post->fetchAllPosts() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res["postID"] ?></th>
                            <td><?php echo $res['title']?></td>
                            <td><?php echo htmlspecialchars_decode($res['content'])?></td>
                            <td><?php echo $res['productID']?></td>
                            <td>
                                <?php foreach($post->getPosts()->fetchImageList($res['postID']) as $img): ?>

                                    <?php $url = $post->getOneImage($img['imageID']); ?>
                                    <img
                                            src="<?php echo '/bike-shop-solution/public/img/' . $res['URL'] ?>?>"
                                            alt="<?php echo $url['alt'] ?? '' ?>"
                                            height="50px"
                                    >
                                    <?php echo $url['URL'] ?>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="postID" value="<?php echo $res['postID'] ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="postID" value="<?php echo $res['postID'] ?>">
                                    <input type="submit" name="addImage" value="add image" class="btn btn-outline-secondary
                                    btn-sm" >
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="postID" value="<?php echo $res['postID'] ?>">
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
            <?php echo $post->getPosts()->message  ?>
        </h3>
            <div class="col-12 col-md-8 offset-md-2">
                <h3><?php echo $post->getPostImage()->message ?></h3>
            </div>


        <!--    the form for creating and updating drive_type starts here-->
        <div class="modal fade <?php echo isset($_POST["update"]) ? 'show' : ' ' ?>" id="modal" tabindex="-1"
             role="dialog"
             aria-labelledby="modal-title" aria-hidden="true"
            <?php echo isset($_POST["update"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo !$post->getUpdate() ? "Create new" : "Update: " .
                                $post->getOnePost()['title']
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
                                <label for="productID">For product(can be empty)</label>
                                <select class="custom-select" id="productID" name="productID">
                                    <?php if ($post->fetchAllProducts() !== null) {
                                        foreach ($post->fetchAllProducts() as $product):?>
                                            <option value="<?php echo $product['productID'] ?? '' ?>"

                                            ><?php echo $product["name"] ?? ""?></option>

                                        <?php endforeach; ?>

                                    <?php }; ?>
                                </select>
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="title"
                                       value=" <?php echo $post->getOnePost()['title'] ?? '' ?>" required
                                >
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="postContent">post content</label>
                                <textarea
                                    class="form-control"
                                    name="content"
                                    id="postContent"
                                    rows="5"><?php echo $post->getOnePost()['content']??''?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace( 'postContent' );
                                </script>
                            </div>
                            <input type="hidden" name="userID" value="1">

                            <?php if(isset($post->getOnePost()['postID'])): ?>
                                <input type="hidden" hidden
                                       name = "postID"
                                       value = "<?php echo $post->getOnePost()['postID'] ?>"
                                >
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn <?php echo !$post->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                       name="<?php echo !$post->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                       value="<?php echo !$post->getUpdate() ? 'Create new' : 'update' ?>"
                                >
                                <input type="submit" class="btn btn-secondary" value="Cancel">
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
                                $post->getOnePost()['title'] ?>
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
                                <?php foreach($post->getPosts()->fetchImageList($_POST['postID']) as $img): ?>
                                    <?php $url = $post->getOneImage($img['imageID']); ?>
                                    <img
                                            src="./public/img/<?php echo $url['URL'] ?? '' ?>"
                                            alt="<?php echo $url['alt'] ?? '' ?>"
                                            height="50px"
                                    >
                                    <?php echo $url['URL'] ?>
                                    <input type="hidden" name="deleteImageID" value="<?php echo $img['imageID'] ?>">
                                    <input type="hidden" name="deleteProductID" value="<?php echo $_POST['postID']?>">
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

                            <?php if(isset($_POST['postID'])): ?>
                                <input type="hidden" hidden name="postID" value = "<?php echo $_POST['postID'] ?>">
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
