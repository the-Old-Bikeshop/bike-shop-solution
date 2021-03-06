<?php
    //CREATE TABLE `company_details` (
    //company_detailsID INT NOT NULL Primary Key AUTO_INCREMENT,
    //    company_description TEXT,
    //    opening_hours VARCHAR(100),
    //    mission TEXT,
    //    vision TEXT,
    //    statement TEXT,
    //    phone VARCHAR(20),
    //    address VARCHAR(255),
    //    email VARCHAR(150),
    //    instagram VARCHAR(100)
    //);
    //ALTER TABLE `company_details` CHANGE `STATEMENT` `statement` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
    $cd = new CompanyDetailsController();

    $cd->setCompanyDetails();
?>

<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Company Details
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
                            <th scope="col">opening_hours</th>
                            <th scope="col">phone</th>
                            <th scope="col">address</th>
                            <th scope="col">email</th>
                            <th scope="col">instagram</th>
                            <th scope="col">Controls</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cd->getAllCompanyDetails() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res['company_detailsID']?></th>
                            <td><?php echo $res['opening_hours']?></td>
                            <td><?php echo $res['phone']?></td>
                            <td><?php echo $res['address']?></td>
                            <td><?php echo $res['email']?></td>
                            <td><?php echo $res['instagram']?></td>
                            <td>
                                <form action="" method="post" class="d-inline-block">
                                    <input type="hidden" hidden name="company_detailsID" value="<?php echo $res['company_detailsID'] ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-secondary" >
                                </form>
                                <form action="" method="post" class="d-inline-block">
                                    <input type="hidden" hidden name="company_detailsID" value="<?php echo $res['company_detailsID'] ?>">
                                    <input type="submit" name="delete" value="delete" class="btn btn-danger" onclick="return confirm('Delete! are you sure?')" >
                                </form>
                            </td>
                        </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--display message-->
        <?php if(isset($cd->message)): ?>
            <div class="col-12 col-md-8 offset-md-2">
                <h3><?php echo $cd->message ?></h3>
                <h3><?php echo $cd->getCompanyDetails()->message ?></h3>
            </div>
        <?php endif?>

        <div class="modal fade <?php echo isset($_POST["update"]) ? 'show' : ' ' ?>" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["update"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo !$cd->getUpdate() ? "Create Information" : "Update details ". $cd->getOneDetails()['email'] ?>
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
                                <label for="opening_hours">Opening Hours</label>
                                <input type="text" class="form-control" id="opening_hours" name="opening_hours"
                                    placeholder="08:00-17:00 mon-fri"
                                    value=" <?php echo $cd->getOneDetails()['opening_hours'] ?? '' ?>" >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="phone">phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="+45 xxxxxxxxx"
                                    value=" <?php echo $cd->getOneDetails()['phone'] ?? '' ?>" >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="instagram">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram"
                                    placeholder="intagram link"
                                    value=" <?php echo $cd->getOneDetails()['instagram'] ?? '' ?>" >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="address">address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="address"
                                    value=" <?php echo $cd->getOneDetails()['address'] ?? '' ?>" >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="email">email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="email"
                                    value=" <?php echo $cd->getOneDetails()['email'] ?? '' ?>" >
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="company_description">Company description</label>
                                <textarea class="form-control"
                                        id="company_description" rows="5"
                                        name="company_description"><?php echo $cd->getOneDetails()['company_description'] ?? ''?></textarea>
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="mission">Company mission</label>
                                <textarea class="form-control"
                                        id="mission" rows="5"
                                        name="mission"><?php echo $cd->getOneDetails()['mission'] ?? ''?></textarea>
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="vision">Company vision</label>
                                <textarea class="form-control"
                                        id="vision" rows="5"
                                        name="vision"><?php echo $cd->getOneDetails()['vision'] ?? ''?></textarea>
                            </div>
                            <div class="form-group col-12  mt-2">
                                <label for="statement">Company statement</label>
                                <textarea class="form-control"
                                        id="statement" rows="5"
                                        name="statement"><?php echo $cd->getOneDetails()['statement'] ?? ''?></textarea>
                            </div>
                            <?php if(isset($cd->getOneDetails()['company_detailsID'])): ?>

                                <input type="hidden" hidden
                                    name = "company_detailsID"
                                    value = "<?php echo $cd->getOneDetails()['company_detailsID'] ?>">

                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn <?php echo !$cd->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                    name="<?php echo !$cd->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                    value="<?php echo !$cd->getUpdate() ? 'Create new' : 'update' ?>">
                                <input type="submit" class="btn btn-secondary" value = "Cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



