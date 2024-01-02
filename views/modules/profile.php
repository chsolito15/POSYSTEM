<section class="vh-100" style="background-color: #f4f5f7;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-50">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">

                            <?php

                            $item = null;
                            $value = null;

                            $users = ControllerUsers::ctrShowUsers($item, $value);

                            foreach ($users as $value) {

                                echo '<div class="container mb-4">';

                                if ($value["photo"] != "") {

                                    echo '<div>
                                        <img src="' . $value["photo"] . '" class="img-thumbnail" width="150px" style="margin: 30px">
                                     </div>';
                                } else {

                                    echo '<div>
                                        <img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="150px">
                                     </div>';
                                }

                                echo '<button class="btn btn-primary btnEditUser" idUser="' . $value["id"] . '" data-bs-toggle="modal" data-bs-target="#editUsers">Edit Profile</button>';

                                //var_dump($_SESSION['id']);



                                echo '<br></br>' . $value['name'];

                                echo ' </div>';
                                break;
                            }
                            ?>
                        </div>


                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Information</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Username</h6>
                                        <p class="text-muted"><?= $_SESSION['username'] ?></p>
                                    </div>

                                </div>
                                <h6>Change password </h6>

                                <hr class="mt-0 mb-4">

                                <div class="row pt-1">

                                    <div class="container">

                                        <form action="" method="post" enctype="multipart/form-data">

                                            <div class="form-group mb-3">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                                    <input type="password" class="form-control" name="currentPasswd" placeholder="Current password">
                                                    <input type="hidden" name="currentPasswd" id="currentPasswd">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">

                                                <div class="input-group mb-3">

                                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                    <input type="password" class="form-control" name="EditPasswd" placeholder="New Password" value="">

                                                </div>

                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                    <input type="password" class="form-control" id="showPassword" name="confirmPasswd" placeholder="Confirm Password" value="">
                                                </div>

                                            </div>

                                            <div class="form-group mb-3">
                                                <input class="form-check-input mt-1" type="checkbox" onclick="password_Reveal()" value="">
                                                Show Password
                                            </div>

                                            <div class="form-group mb-3">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
                                            </div>

                                            <?php

                                            $login = new ControllerUsers();
                                            $login::crtChangePassword();

                                            ?>

                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div id="editUsers" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" enctype="multipart/form-data">

                <div class="modal-header" style="background: #DD4B39; color: #fff">

                    <h4 class="modal-title">Edit User</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- Uploading image -->
                        <div class="form-group mb-3">

                            <img class="thumbnail preview" src="views/img/users/default/anonymous.png" alt="" width="100px">

                            <div class="panel">Upload image</div>

                            <input class="newPics" type="file" name="editPhoto">

                            <p>Maximum size 2Mb</p>

                            <input type="hidden" name="currentPicture" id="currentPicture">

                        </div>

                        <!--Input name -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>

                                <input class="form-control input-lg" type="text" id="EditName" name="EditName" placeholder="Edit name" required>

                            </div>

                        </div>

                        <!-- input username -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>

                                <input class="form-control input-lg" type="text" id="EditUser" name="EditUser" placeholder="Edit username" readonly>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">Edit User</button>

                </div>

                <?php

                $editUser = new ControllerUsers();
                $editUser::ctrEditProfile();

                ?>

            </form>

        </div>

    </div>

</div>