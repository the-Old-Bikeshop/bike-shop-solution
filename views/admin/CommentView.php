<?php
$comment = new CommentController();
$comment->setComment();
?>
<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Comments
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
                        <th scope="col">for Post</th>
                        <th scope="col">made by</th>
                        <th scope="col">made at</th>
                        <th scope="col">controls</th>

                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($comment->fetchAllComments() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res["commentID"] ?></th>
                            <td><?php echo $res['title']?></td>
                            <td><?php echo $res['content']?></td>
                            <td><?php echo $res['postID']?></td>
                            <td><?php echo $res['userID']?></td>
                            <td><?php echo $res['created_at']?></td>
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="commentID" value="<?php echo $res['commentID']
                                    ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="commentID" value="<?php echo $res['commentID']
                                    ?>">
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
            <?php echo $comment->getComments()->message  ?>
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
                            <?php echo !$comment->getUpdate() ? "Create new" : "Update: " .
                                $comment->getOneComment()['title']
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
                                <label for="postID">For post</label>
                                <select class="custom-select" id="postID" name="postID">
                                    <?php if ($comment->fetchAllPosts() !== null) {
                                        foreach ($comment->fetchAllPosts() as $post):?>
                                            <option value="<?php echo $post['postID'] ?? '' ?>"

                                            ><?php echo $post["title"] ?? ""?></option>

                                        <?php endforeach; ?>

                                    <?php }; ?>
                                </select>
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="title"
                                       value=" <?php echo $comment->getOneComment()['title'] ?? '' ?>" required
                                >
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="postContent">post content</label>
                                <textarea
                                    class="form-control"
                                    name="content"
                                    id="postContent"
                                    rows="5"><?php echo $comment->getOneComment()['content']??''?></textarea>
                            <input type="hidden" name="userID" value="1">

                            <?php if(isset($comment->getOneComment()['commentID'])): ?>
                                <input type="hidden" hidden
                                       name = "commentID"
                                       value = "<?php echo $comment->getOneComment()['commentID'] ?>"
                                >
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn <?php echo !$comment->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                       name="<?php echo !$comment->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                       value="<?php echo !$comment->getUpdate() ? 'Create new' : 'update' ?>"
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

