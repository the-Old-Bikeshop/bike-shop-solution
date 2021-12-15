<?php
$user = new UserController();
$user->setUser();

?>
<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                User
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
                        <th scope="col">email</th>
                        <th scope="col">role</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($user->getAllUsers() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res["userID"] ?></th>
                            <td><?php echo $res['first_name'] . " " .  $res['last_name'] ?></td>
                            <td><?php echo $res['email']?></td>
                            <td><?php $user->getRoleConvert()->userRole($res['role']); ?></td>
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden"  name="userID" value="<?php echo $res['userID']
                                    ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
<!--                                <form action="" method="post" class="d-inline-block p-0 m-0">-->
<!--                                    <input type="hidden" name="userID" value="--><?php //echo $res['userID']
//                                    ?><!--">-->
<!--                                    <input type="submit" name="delete" value="delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete! are you sure?')" >-->
<!--                                </form>-->
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--    display message-->

        <h3>
            <?php echo $user->getMessage()  ?>
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
                            <?php echo !$user->getUpdate() ? "Create new" : "Update: " .
                                $user->getUserInfo()['first_name'] . " " . $user->getUserInfo()['last_name'];
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
                                <label for="first_name">first name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="John"
                                    value=" <?php echo $user->getUserInfo()['first_name'] ?? '' ?>"
                                >
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="last_name">last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       placeholder="Smith"
                                       value=" <?php echo $user->getUserInfo()['last_name'] ?? '' ?>"
                                >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="nick_name">nick name</label>
                                <input type="text" class="form-control" id="nick_name" name="nick_name"
                                       placeholder="username"
                                       value=" <?php echo $user->getUserInfo()['nick_name'] ?? '' ?>"
                                >
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="email">email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="email@email.com"
                                       value=" <?php echo $user->getUserInfo()['email'] ?? '' ?>"
                                >
                            </div>

                            <div class="form-group col-12 mt-2">
                                <label for="role">Role</label>
                                <select  class="form-control" id="role" name="role" >
                                         <?php if ($user->getAllRoles() !== null): ?>
                                         <?php foreach ($user->getAllRoles() as $role) : ?>
                                             <option value = "<?php echo $role ?>"
                                                     <?php if(($user->getUserInfo()!==null) && $user->getAllRoles() !== null &&
                                                     ($user->getUserInfo()['role'] == $role)):?>
                                                     selected
                                                 <?php endif; ?>
                                             > <?php $user->getRoleConvert()->userRole($role); ?>
                                             </option>

                                        <?php endforeach; ?>

                                        <?php endif; ?>
                                </select>
                            </div>


                            <?php if(isset($user->getUserInfo()['userID'])): ?>
                                <input type="hidden" hidden
                                    name = "userID"
                                    value = "<?php echo $user->getUserInfo()['userID'] ?>"
                                >
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn <?php echo !$user->getUpdate() ? 'btn-primary' :
                                 'btn-info' ?>"
                                    name="<?php echo !$user->getUpdate() ? 'submit-new-admin' : 'submit-update' ?>"
                                    value="<?php echo !$user->getUpdate() ? 'Create new' : 'update' ?>"
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