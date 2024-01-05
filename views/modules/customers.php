<?php

if ($_SESSION["profile"] == "special") {

    echo '<script>

    window.location = "home";

  </script>';

    return;
}

?>

<nav class="navbar navbar-expand-lg bg-light mb-2 p-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

    <div class="container">

        <h2>Customer Management</h2>

        <ol class="breadcrumb navbar ms-auto mb-2 mb-lg-0 list-unstyled ">
            <li class="breadcrumb-item"><a href="home" class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>

    </div>

</nav>

<!--=====================================
            DISPLAY CUSTOMER
======================================-->

<div class="container">

    <div class="content-wrapper">

        <section class="content">

            <div class="box">

                <div class="box-header with-border mb-3">

                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCustomer">

                        <i class="fa fa-plus"></i>

                        Add Customer

                    </button>

                </div>

                <div class="card">

                    <div class="card-body">            

                        <table class="table dt-responsive border table-bordered table-hover table-striped text-nowrap tables">
                        
                            <thead>

                                <tr>

                                    <th>#</th>
                                    <th>Name</th>
                                    <th>I.D Doc</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Birthday</th>
                                    <th>Total purchases</th>
                                    <th>Last purchase</th>
                                    <th>Last login</th>
                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $item = null;
                                $value = null;

                                $Customers = controllerCustomers::ctrShowCustomers($item, $value);

                                foreach ($Customers as $key => $value) {

                                    echo '<tr>

                                            <td>' . ($key + 1) . '</td>

                                            <td>' . $value["name"] . '</td>

                                            <td>' . $value["idDocument"] . '</td>

                                            <td>' . $value["email"] . '</td>

                                            <td>' . $value["phone"] . '</td>

                                            <td>' . $value["address"] . '</td>

                                            <td>' . $value["birthdate"] . '</td>             

                                            <td>' . $value["purchases"] . '</td>

                                            <td>' . $value["lastPurchase"] . '</td>

                                            <td>' . $value["registerDate"] . '</td>

                                            <td>

                                            <div class="btn-group">

                                                <button class="btn btn-primary btnEditCustomer" data-bs-toggle="modal" data-bs-target="#modalEditCustomer" idCustomer="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>

                                                <button class="btn btn-danger btnDeleteCustomer" idCustomer="' . $value["id"] . '"><i class="fa fa-trash"></i></button>

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
            MODAL ADD CUSTOMER
======================================-->

    <div id="addCustomer" class="modal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <form role="form" method="POST">

                    <!--=====================================
                        MODAL HEADER
        ======================================-->

                    <div class="modal-header" style="background: #DD4B39; color: #fff">

                        <h4 class="modal-title">Add Customer</h4>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <!--=====================================
                         MODAL BODY
        ======================================-->

                    <div class="modal-body">

                        <div class="box-body">

                            <!-- NAME INPUT -->

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control input-lg" type="text" name="newCustomer" placeholder="Write name" required>
                                </div>
                            </div>

                            <!-- I.D DOCUMENT INPUT -->

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-key"></i></span>
                                    <input class="form-control input-lg" type="number" min="0" name="newIdDocument" placeholder="Write your ID" required>
                                </div>
                            </div>

                            <!-- EMAIL INPUT -->

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-envelope"></i></span>
                                    <input class="form-control input-lg" type="text" name="newEmail" placeholder="Email" required>
                                </div>
                            </div>

                            <!-- PHONE INPUT -->

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-phone"></i></span>
                                    <input class="form-control input-lg" type="text" name="newPhone" placeholder="phone" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                                </div>
                            </div>

                            <!-- ADDRESS INPUT -->

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-map-marker"></i></span>
                                    <input class="form-control input-lg" type="text" name="newAddress" placeholder="Address" required>
                                </div>
                            </div>


                            <!-- BIRTH DATE INPUT -->

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control input-lg" type="text" name="newBirthdate" placeholder="Birth Date" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!--=====================================
                        MODAL FOOTER
        ======================================-->

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Customer</button>
                    </div>
                </form>

                <?php

                $createCustomer = new ControllerCustomers();
                $createCustomer->ctrCreateCustomer();

                ?>
            </div>

        </div>

    </div>

    <!--=====================================
        MODAL EDIT CUSTOMER
======================================-->

    <div id="modalEditCustomer" class="modal" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <form role="form" method="post">

                    <!--=====================================
                        MODAL HEADER
        ======================================-->

                    <div class="modal-header" style="background:#DD4B39; color:white">

                        <h4 class="modal-title">Edit Customer</h4>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <!--=====================================
                          MODAL BODY
        ======================================-->

                    <div class="modal-body">

                        <div class="box-body">

                            <!-- NAME INPUT -->

                            <div class="form-group mb-4">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>

                                    <input type="text" class="form-control input-lg" name="editCustomer" id="editCustomer" required>
                                    <input type="hidden" id="idCustomer" name="idCustomer">
                                </div>

                            </div>

                            <!-- I.D DOCUMENT INPUT -->

                            <div class="form-group mb-4">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>

                                    <input type="number" min="0" class="form-control input-lg" name="editIdDocument" id="editIdDocument" required>

                                </div>

                            </div>

                            <!-- EMAIL INPUT -->

                            <div class="form-group mb-4">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>

                                    <input type="email" class="form-control input-lg" name="editEmail" id="editEmail" required>

                                </div>

                            </div>

                            <!-- PHONE INPUT -->

                            <div class="form-group mb-4">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>

                                    <input type="text" class="form-control input-lg" name="editPhone" id="editPhone" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                                </div>

                            </div>

                            <!-- ADDRESS INPUT -->

                            <div class="form-group mb-4">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>

                                    <input type="text" class="form-control input-lg" name="editAddress" id="editAddress" required>

                                </div>

                            </div>

                            <!-- BIRTH DATE INPUT -->

                            <div class="form-group mb-4">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>

                                    <input type="text" class="form-control input-lg" name="editBirthdate" id="editBirthdate" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!--=====================================
                          MODAL FOOTER
        ======================================-->

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">Save Changes</button>

                    </div>

                </form>

                <?php

                $EditCustomer = new ControllerCustomers();
                $EditCustomer->ctrEditCustomer();

                ?>



            </div>

        </div>

    </div>

    <?php

    $deleteCustomer = new ControllerCustomers();
    $deleteCustomer->ctrDeleteCustomer();

    ?>