<div class="d-flex justify-content-center align-items-center" style="height: 550px;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <div class="card m-5">
                    <div class="card-header">
                        <h4 class="text-center">POS SYSTEM</h4>
                    </div>
                    <div class="card-body">

                        <form action="" method="post">

                            <div class="form-group mb-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="loginUser" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group mb-3">

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" id="showPassword" name="loginPass" placeholder="Password" value="" aria-label="Text input with checkbox">

                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <input class="form-check-input mt-1" type="checkbox" onclick="password_Reveal()" value="" aria-label="Checkbox for following text input">
                                Show Password
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>

                            <?php

                            $login = new ControllerUsers();
                            $login::ctrUserLogin();

                            ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>