
<?php
$address = new AddressController();
$address->setAddress();

?>
<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Address
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
                        <th scope="col">street_name</th>
                        <th scope="col">nr</th>
                        <th scope="col">postalCodeID</th>
                        <th scope="col">phone_number</th>
                        <th scope="col">address_type</th>
                        <th scope="col">userID</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($address->fetchAllAddresses() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res["addressID"] ?></th>
                            <td><?php echo $res['street_name'] ?></td>
                            <td><?php echo $res['address_content']?></td>
                            <td><?php echo $res['postalCodeID']?></td>
                            <td><?php echo $res['phone_number']?></td>
                            <td><?php echo $res['address_type']?></td>
                            <td><?php echo $res['userID']?></td>
<!--                            <td>--><?php //$address->getRoleConvert()->userRole($res['role']); ?><!--</td>-->
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden"  name="addressID" value="<?php echo $res['addressID']
                                    ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" name="addressID" value="<?php echo $res['addressID']
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
            <?php echo $address->getMessage() ?>
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
                            <?php echo !$address->getUpdate() ? "Create new" : "Update: "?>
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
                                <label for="postalCodeID">Zip Code</label>
                                <select  class="form-control" id="postalCodeID" name="postalCodeID" >
                                    <?php if ($address->fetchAllZipCodes() !== null): ?>
                                        <?php foreach ($address->fetchAllZipCodes() as $zipCode) : ?>
                                            <option value = "<?php echo $zipCode['postal_code']?>"
                                                <?php if(($address->getOneAddress()!==null) && $address->fetchAllZipCodes()
                                                    !== null && isset($zipCode) &&
                                                    ($address->getOneAddress()['postalCodeID'] == $zipCode['postal_code'])
                                                ):?>
                                                    selected
                                                <?php endif; ?>
                                            > <?php
                                                if( $address->fetchAllZipCodes() !== null && isset($zipCode) ) {
                                                    echo $zipCode['postal_code'] . ", " . $zipCode['place_name'];
                                                }?>
                                            </option>

                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="street_name">Street</label>
                                <input type="text" class="form-control" id="street_name" name="street_name"
                                       placeholder="Storegade"
                                       value=" <?php echo $address->getOneAddress()['street_name'] ?? '' ?>"
                                >
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="address_content">nr</label>
                                <input type="text" class="form-control" id="address_content" name="address_content"
                                       placeholder="39, 4th"
                                       value=" <?php echo $address->getOneAddress()['address_content'] ?? '' ?>"
                                >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="phone_number">phone_number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                       placeholder="phone"
                                       value=" <?php echo $address->getOneAddress()['phone_number'] ?? '' ?>"
                                >
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="address_type">address type</label>
                                <select  class="form-control" id="address_type" name="address_type" >
                                    <?php if ($address->getAddressTypes() !== null): ?>
                                        <?php foreach ($address->getAddressTypes() as $type) : ?>
                                            <option value = "<?php echo $type ?>"
                                                <?php if(($address->getOneAddress()!==null) && $address->getAddressTypes()
                                                    !==
                                                    null &&
                                                    ($address->getOneAddress()['address_type'] == $type)):?>
                                                    selected
                                                <?php endif; ?>
                                            > <?php $address->getAddressTypeConverter()->addressType($type); ?>
                                            </option>

                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </select>
                            </div>
                                <input type="hidden" hidden
                                       name ="userID"
                                       value = "1"
                                >

                            <?php if(isset($address->getOneAddress()['addressID'] )) : ?>
                                <input type="hidden" hidden
                                       name ="addressID"
                                       value = <?php echo $address->getOneAddress()['addressID'] ?>
                                >
                            <?php endif; ?>


                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn <?php echo !$address->getUpdate() ? 'btn-primary' :
                                    'btn-info' ?>"
                                       name="<?php echo !$address->getUpdate() ? 'submit-new' : 'submit-update'
                                       ?>"
                                       value="<?php echo !$address->getUpdate() ? 'Create new' : 'update' ?>"
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
