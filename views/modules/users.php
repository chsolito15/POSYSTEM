<nav class="navbar navbar-expand-lg bg-light mb-2 p-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

    <div class="container">

        <h2>Users Account</h2>

        <ol class="breadcrumb navbar ms-auto mb-2 mb-lg-0 list-unstyled ">
            <li class="breadcrumb-item"><a href="home" class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>

    </div>

</nav>

<div class="container">

    <div class="content-wrapper">

        <section class="content">

            <div class="box">

                <div class="box-header with-border mb-3">

                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUser">

                        <i class="fa fa-plus"></i> Add User

                    </button>

                </div>

                <div class="card">

                    <div class="card-body">

                        <table class="table border table-bordered table-hover table-striped dt-responsive tables" width="100%">

                            <thead>

                                <tr>

                                    <th style="width:10px">#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Photo</th>
                                    <th>Profile</th>
                                    <th>Permission</th>
                                    <th>Status</th>
                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $item = null;
                                $value = null;

                                $users = ControllerUsers::ctrShowUsers($item, $value);

                                // var_dump($users);

                                foreach ($users as $key => $value) {

                                    echo
                                    '<tr>

                                        <td>' . ($key + 1) . '</td>
                                        <td>' . $value["name"] . '</td>
                                        <td>' . $value["username"] . '</td>';

                                    if ($value["photo"] != "") {

                                        echo '<td>
                                                <img src="' . $value["photo"] . '" class="img-thumbnail" width="40px">
                                            </td>';
                                    } else {

                                        echo '<td>
                                                <img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px">
                                            </td>';
                                    }

                                    echo '<td>' . $value["profile"] . '</td>';

                                    if ($value["status"] != 0) {

                                        echo '<td>
                                            <button class="btn btn-success btnActivate btn-xs" userId="' . $value["id"] . '" userStatus="0">Activated</button>
                                            </td>';
                                    } else {

                                        echo '<td>
                                            <button class="btn btn-danger btnActivate btn-xs" userId="' . $value["id"] . '" userStatus="1">Deactivated</button>
                                            </td>';
                                    }

                                    echo '<td>';

                                    echo '<div class="bs-field-status">';

                                    if ($value['lastLogin'] == 1) {
                                        echo '<svg height="25" width="25" xmlns="http://www.w3.org/2000/svg">
                                                    
                                                        <circle cx="12" cy="12" r="9" fill="#008000" />
                                                    
                                                        </sv> <span>Online</span>';
                                    } else {
                                        echo '<svg height="25" width="25" xmlns="http://www.w3.org/2000/svg">
                                                    
                                                    <circle cx="12" cy="12" r="9" fill="#808080" />
                                            
                                                        </sv> <span>Offline</span>';
                                    }

                                    echo '</div>';

                                    '</td>';

                                    echo  '<td>

                                            <div class="btn-group">
                                            
                                                <button class="btn btn-primary btnEditUser" idUser="' . $value["id"] . '" data-bs-toggle="modal" data-bs-target="#editUser"><i class="fa fa-pencil"></i></button>

                                                <button class="btn btn-danger btnDeleteUser" userId="' . $value["id"] . '" username="' . $value["username"] . '" userPhoto="' . $value["photo"] . '"><i class="fa fa-trash"></i></button>

                                            </div>  

                                        </td>
                                   
                            </tr>';
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </section>
    </div>

    <!--=====================================
=            module add user            =
======================================-->

    <!-- Modal -->

    <div id="addUser" class="modal" role="dialog">

        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <form role="form" method="POST" enctype="multipart/form-data">

                    <!--=====================================
                                     HEADER
                    ======================================-->

                    <div class="modal-header" style="background: #DD4B39; color: #fff">

                        <h4 class="modal-title">Add User</h4>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <!--=====================================
                                     BODY
                    ======================================-->

                    <div class="modal-body">

                        <div class="box-body">

                            <!--Input name -->
                            <div class="form-group mb-3">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-user"></i></span>

                                    <input class="form-control input-lg" type="text" name="newName" placeholder="Enter fullname" required>

                                </div>

                            </div>

                            <!-- input username -->
                            <div class="form-group mb-3">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-user"></i></span>

                                    <input class="form-control input-lg" type="text" id="newUser" name="newUser" placeholder="Enter username" required>

                                </div>

                            </div>

                            <!-- input password -->
                            <div class="form-group mb-3">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-lock"></i></span>

                                    <input class="form-control input-lg" type="password" name="newPasswd" placeholder="Enter password" required>

                                </div>

                            </div>

                            <!-- input profile -->
                            <div class="form-group mb-3">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-level-up"></i></span>

                                    <select class="form-select input-lg" name="newProfile">

                                        <option value="">Select Level</option>
                                        <option value="administrator">administrator</option>
                                        <option value="special">special</option>
                                        <option value="seller">seller</option>

                                    </select>

                                </div>

                            </div>

                            <!-- Uploading image -->
                            <div class="form-group mb-3">

                                <div class="panel">Upload image</div>

                                <input class="newPics" type="file" name="newPhoto">

                                <p class="help-block">Maximum size 2Mb</p>

                                <img class="thumbnail preview" src="views/img/users/default/anonymous.png" width="100px">

                            </div>

                        </div>

                    </div>

                    <!--=====================================
                                     FOOTER
                    ======================================-->

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">Save</button>

                    </div>

                    <?php
                    $createUser = new ControllerUsers();
                    $createUser->ctrCreateUser();
                    ?>

                </form>

            </div>

        </div>

    </div>
    <!--====  End of module add user  ====-->


    <!--=====================================
    =            module edit user            =
    ======================================-->

    <!-- Modal -->
    <div id="editUser" class="modal" role="dialog">

        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <form role="form" method="POST" enctype="multipart/form-data">

                    <!--=====================================
                                     HEADER
                    ======================================-->

                    <div class="modal-header" style="background: #DD4B39; color: #fff">

                        <h4 class="modal-title">Edit User</h4>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <!--=====================================
                                        BODY
                    ======================================-->

                    <div class="modal-body">

                        <div class="box-body">

                            <!-- Edit name -->
                            <div class="form-group mb-3">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>

                                    <input class="form-control input-lg" type="text" id="EditName" name="EditName" placeholder="Edit name" required>

                                </div>

                            </div>

                            <!-- Edit username -->
                            <div class="form-group mb-3">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>

                                    <input class="form-control input-lg" type="text" id="EditUser" name="EditUser" placeholder="Edit username" readonly>

                                </div>

                            </div>

                            <!-- Edit password -->
                            <div class="form-group mb-3">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>

                                    <input class="form-control input-lg" type="password" name="EditPasswd" placeholder="Enter new password">

                                    <input type="hidden" name="currentPasswd" id="currentPasswd">

                                </div>

                            </div>

                            <!-- Edit profile -->
                            <div class="form-group mb-3">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-level-up"></i></span>

                                    <select class="form-select input-lg" name="EditProfile">

                                        <option value="" id="EditProfile"></option>
                                        <option value="administrator">administrator</option>
                                        <option value="special">special</option>
                                        <option value="seller">seller</option>

                                    </select>

                                </div>

                            </div>

                            <!--Edit Uploading image -->
                            <div class="form-group mb-3">

                                <div class="panel">Upload image</div>

                                <input class="newPics" type="file" name="editPhoto">

                                <p class="help-block">Maximum size 2Mb</p>

                                <img class="thumbnail preview" src="views/img/users/default/anonymous.png" alt="" width="100px">

                                <input type="hidden" name="currentPicture" id="currentPicture">

                            </div>

                        </div>

                    </div>

                    <!--=====================================
                                    FOOTER
                    ======================================-->

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">Edit User</button>

                    </div>

                    <?php
                    $editUser = new ControllerUsers();
                    $editUser->ctrEditUser();
                    ?>

                </form>

            </div>

        </div>

    </div>

    <?php

    $deleteUser = new ControllerUsers();
    $deleteUser->ctrDeleteUser();

    ?>
</div>