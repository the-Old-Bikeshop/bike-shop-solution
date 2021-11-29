<?php
$review = new ReviewController();
$review->setReview();
?>
<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Reviews
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
                        <th scope="col">made by</th>
                        <th scope="col">made at</th>
                        <th scope="col">rating</th>
                        <th scope="col">state</th>

                        <th scope="col">controls</th>

                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($review->fetchAllReviews() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res["reviewID"] ?></th>
                            <td><?php echo $res['title']?></td>
                            <td><?php echo $res['content']?></td>
                            <td><?php echo $res['last_name'] . " " . $res['first_name']?></td>
                            <td><?php echo $res['created_at']?></td>
                            <td><?php echo $res['rating']?></td>
                            <td><?php $review->getStatus()->reviewStatus($res['state'])?></td>
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="reviewID" value="<?php echo $res['reviewID']
                                    ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="reviewID" value="<?php echo $res['reviewID']
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
            <?php echo $review->getReviews()->message  ?>
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
                            <?php echo !$review->getUpdate() ? "Create new" : "Update: " .
                                $review->getOneReview()['title']
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
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="title"
                                       value=" <?php echo $review->getOneReview()['title'] ?? '' ?>"
                                >
                            </div>
                            <div>
                                rate:
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value="3">
                                    <label class="form-check-label" for="inlineRadio3">3</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value="4">
                                    <label class="form-check-label" for="inlineRadio3">4</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rating" id="inlineRadio3"
                                           value="5" checked>
                                    <label class="form-check-label" for="inlineRadio3">5</label>
                                </div>
                            </div>


                            <div class="form-group col-12  mt-2">
                                <label for="postContent">post content</label>
                                <textarea
                                    class="form-control"
                                    name="content"
                                    id="postContent"
                                    rows="5"><?php echo $review->getOneReview()['content']??''?></textarea>

                            </div>
                            <div class="column-form-item form-group col-12  mt-2">
                                <label for="state">Order status</label>
                                <select class="custom-select" id="state" name="state">
                                    <?php if ($review->getStatuses() !== null) : ?>
                                        <?php foreach ($review->getStatuses() as $state):?>
                                            <option value="<?php echo $state; ?>"
                                                <?php if(($review->getOneReview() !== null) &&
                                                    ($review->getStatus()->getReviewStatuses() !== null)
                                                    ):?>

                                                        <?php if(($review->getOneReview()['state'] ?? ''  == $state))
                                                            : ?>
                                                            selected
                                                        <?php endif;?>
                                                <?php endif; ?>

                                            ><?php $review->getStatus()->reviewStatus($state);?></option>

                                        <?php endforeach ;?>

                                    <?php endif ;?>
                                </select>
                            </div>
                                <input type="hidden" name="userID" value="<?php echo $_SESSION['userID'] ?? '1' ?>">




                                <?php if(isset($review->getOneReview()['reviewID'])): ?>
                                    <input type="hidden" hidden
                                           name = "reviewID"
                                           value = "<?php echo $review->getOneReview()['reviewID'] ?>"
                                    >
                                <?php endif; ?>
                                <div class="form-group col-12 mt-2">
                                    <input type="submit" class="btn <?php echo !$review->getUpdate() ? 'btn-primary' :
                                    'btn-info' ?>"
                                           name="<?php echo !$review->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                           value="<?php echo !$review->getUpdate() ? 'Create new' : 'update' ?>"
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


