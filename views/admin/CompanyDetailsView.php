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

<section  class="row col-12 ">
    <div style="align-items:center; justify-content:space-between; border-bottom:2px dashed rgba(0,0,0,0.15); padding:1rem; width:100%; display: flex;">
        <h1>
            Company Details
        </h1>
        <button data-toggle="modal" data-target="#exampleModalCenter" style="height: 3rem;" type="button" class="btn btn-dark">
            Create New
        </button>
    </div>
    <div style="padding-left:1rem; padding:1rem; width:100%;">
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
                    <th scope="col">company_description</th>
                    <th scope="col">mission</th>
                    <th scope="col">vision</th>
                    <th scope="col">statement</th>
                    <th scope="col">Controls</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cd->getCompanyDetails()->fetchAllCompanyDetails() as $res): ?>
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
        <?php echo isset($_POST["update"]) ? 'style = "display : block"' : 'style = "display : none"'?>>
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
         sdasadsa
                </div>
            </div>
        </div>
    </div>
</section>




