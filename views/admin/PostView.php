<?php
$post = new PostController();
$post->setPost();
?>
<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Categories
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
                        <th scope="col">title</th>
                        <th scope="col">content</th>
                        <th scope="col">for Product</th>
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
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="postID" value="<?php echo $res['postID'] ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
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

        <!--    the form for creating and updating drive_type starts here-->
        <div class="modal fade <?php echo isset($_POST["update"]) ? 'show' : ' ' ?>" id="exampleModalCenter" tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["update"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo !$post->getUpdate() ? "Create new" : "Update: " .
                                $post->getOnePost()['name'] . $post->getOnePost()['short_description'];
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
    </section>
</div>
