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
<section  class="row row col-12 row mt-5 col-md-8 offset-md-2 pb-5">
    <h1>Company details</h1>

    <?php
    echo $cd->message;
    ?>

    <table class="table table-sm col-12 col-md-8 offset-md-2 pb-5 border-bottom border-secondary">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">opening_hours</th>
            <th scope="col">phone</th>
            <th scope="col">address</th>
            <th scope="col">email</th>
            <th scope="col">instagram</th>
            <th scope="col">company_description</th>
            <th scope="col">mission</th>
            <th scope="col">vision</th>
            <th scope="col">statement</th>
            <th scope="col">Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cd->getCompanyDetails()->fetchAllCompanyDetails() as $res): ?>



    <section  class="row row col-12 row mt-5 col-md-8 offset-md-2 pb-5">
        <h1>Company details</h1>

        <?php
        echo $cd->message;
        ?>

        <table class="table table-sm col-12 col-md-8 offset-md-2 pb-5 border-bottom border-secondary">
            <thead class="thead-light">
            <tr>
                <th scope="row"> <?php echo $res['company_detailsID']?></th>
                <td><?php echo $res['opening_hours']?></td>
                <td><?php echo $res['phone']?></td>
                <td><?php echo $res['address']?></td>
                <td><?php echo $res['email']?></td>
                <td><?php echo $res['instagram']?></td>
                <td><?php echo $res['company_description']?></td>
                <td><?php echo $res['mission']?></td>
                <td><?php echo $res['vision']?></td>
                <td><?php echo $res['statement']?></td>
                <td>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="company_detailsID" value="<?php echo $res['company_detailsID'] ?>">
                        <input type="submit" name="update" value="update" class="btn btn-info" >
                    </form>
                    <form action="" method="post" class="d-inline-block">
                        <input type="text" hidden name="company_detailsID" value="<?php echo $res['company_detailsID'] ?>">
                        <input type="submit" name="delete" value="delete" class="btn btn-danger" onclick="return confirm('Delete! are you sure?')" >
                    </form>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>

    <form class="col-12 row mt-5 col-12 col-md-8 offset-md-2 pb-5" action="" method="post" id="form">
        <p class="text-secondary  col-12"><?php echo !$cd->getUpdate() ? "Create new company details" : "Update details "
                . $cd->getOneDetails()['email'] ?> </p>
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

            <input type="text" hidden
                    name = "company_detailsID"
                    value = "<?php echo $cd->getOneDetails()['company_detailsID'] ?>">

        <?php endif; ?>
        <div class="form-group col-12 mt-2">
            <input type="submit" class="btn <?php echo !$cd->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                    name="<?php echo !$cd->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                    value="<?php echo !$cd->getUpdate() ? 'Create new' : 'update' ?>">
        </div>

    </form>

</section>




