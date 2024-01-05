<?php

if ($_SESSION["profile"] == "seller") {

    echo '<script>

            window.location = "home";

         </script>';

    return;
}

?>

<nav class="navbar navbar-expand-lg bg-light mb-2 p-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

    <div class="container">

        <h2>Supplier Management</h2>

        <ol class="breadcrumb navbar ms-auto mb-2 mb-lg-0 list-unstyled ">
            <li class="breadcrumb-item"><a href="home" class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Suppliers</li>
        </ol>

    </div>

</nav>

<div class="container">

    <div class="mb-2">

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSupplier"> <i class="fa fa-plus"></i> Add Supplier</button>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table border table border table-bordered table-hover table-striped dt-responsive tables" style="width: 100%;">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Supplier</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th style="width: 30%">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $item = null;
                    $value = null;

                    $suppliers = ControllerSupplier::ctrShowSupplier($item, $value);

                    /* echo '<pre>';
                                var_dump($suppliers);
                                echo '</pre>'; */

                    foreach ($suppliers as $key => $value) {

                        echo '<tr>
                   
                                <td>' . ($key + 1) . '</td>
                                
                                <td class="text-uppercase">' . $value['Supplier'] . '</td>

                                <td class="text-uppercase">' . $value['address'] . '</td>

                                <td class="text-uppercase">' . $value['contact'] . '</td>

                                <td>

                                    <div class="btn-group" style="width:30%">
                                        
                                        <button class="btn btn-primary btneditSupplier" idSupplier="' . $value["id"] . '" data-bs-toggle="modal" data-bs-target="#editSuppliers"><i class="fa fa-pencil"></i></button>

                                        <button class="btn btn-danger btnDeleteSupplier" idSupplier="' . $value["id"] . '"><i class="fa fa-trash"></i></button>

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


<!--=====================================
=            module add Supplier          =
======================================-->

<!-- Modal -->

<div id="addSupplier" class="modal" tabindex="-1" aria-labelledby="..." aria-hidden="true">

    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">

            <form role="form" method="POST">

                <div class="modal-header bg-danger text-white">

                    <h4 class="modal-title">Add Supplier</h4>

                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!--Input name -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
                                <input class="form-control input-lg" type="text" name="newSupplier" placeholder="Add Supplier" required>

                            </div>

                        </div>

                        <!--Input address -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                <input class="form-control input-lg" type="text" name="newAddress" placeholder="Add Address" required>

                            </div>

                        </div>

                        <!--Input contact -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                                <input class="form-control input-lg" type="text" name="newContact" placeholder="Add Contact" required>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger d-block d-lg-none" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Supplier</button>

                </div>
            </form>
        </div>

    </div>
</div>

<?php

$createSupplier = new ControllerSupplier();
$createSupplier->ctrCreateSupplier();

?>

<!--=====================================
=     module edit Supplier            =
======================================-->

<!-- Modal -->
<div id="editSuppliers" class="modal" tabindex="-1" aria-labelledby="..." aria-hidden="true">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="POST">
                <div class="modal-header" style="background: #DD4B39; color: #fff">

                    <h4 class="modal-title">Edit Supplier</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <!--Input name -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
                                <input class="form-control input-lg" type="text" id="editSupplier" name="editSupplier" required>
                                <input type="hidden" name="idSupplier" id="idSupplier" required>
                            </div>
                        </div>

                        <!--Input address -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                <input class="form-control input-lg" type="text" id="editAddress" name="editAddress" required>
                            </div>
                        </div>

                        <!--Input contact -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                                <input class="form-control input-lg" type="text" id="editContact" name="editContact" required>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>

                <?php

                $editSupplier = new ControllerSupplier();
                $editSupplier->ctrEditSupplier();

                ?>
            </form>
        </div>

    </div>
</div>

<?php

$deleteSupplier = new ControllerSupplier();
$deleteSupplier->ctrDeleteSupplier();
?>