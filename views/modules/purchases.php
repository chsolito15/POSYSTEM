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

        <h2>Purchase Management</h2>

        <ol class="breadcrumb navbar ms-auto mb-2 mb-lg-0 list-unstyled ">
            <li class="breadcrumb-item"><a href="home" class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Purchase</li>
        </ol>

    </div>

</nav>

<div class="container">

    <div class="content-wrapper">

        <section class="content">

            <div class="box-header mb-3">

                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProduct">

                    <i class="fa fa-plus"></i>

                    Add Product

                </button>

            </div>

            <div class="card mb-3">

                <div class="card-body">

                    <table class="table table-bordered table-hover table-striped dt-responsive purchaseTable" style="width: 100%;">

                        <thead>

                            <tr>

                                <th style="width:10px">#</th>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Supplier</th>
                                <th>New Stock</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Date added</th>
                                <th>Actions</th>

                            </tr>

                        </thead>

                    </table>

                    <input type="text" value="<?php echo $_SESSION['profile']; ?>" id="Profile">

                </div>

        </section>

    </div>
</div>

<!--=====================================
=            module add Product            =
======================================-->

<!-- Modal -->
<div id="addProduct" class="modal" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="POST" enctype="multipart/form-data">

                <!--=====================================
                                 HEADER
                ======================================-->

                <div class="modal-header" style="background: #DD4B39; color: #fff">

                    <h4 class="modal-title">Add Product</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!--=====================================
                                 BODY
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- input Supplier -->

                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" id="newSupplier" name="newSupplier" required>

                                    <option value="">Select Supplier</option>

                                    <?php

                                    $item = null;
                                    $value1 = null;

                                    $suppliers = ControllerSupplier::ctrShowSupplier($item, $value1);

                                    foreach ($suppliers as $key => $value) {

                                        echo '<option value="' . $value["id"] . '">' . $value["Supplier"] . '</option>';
                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <!--Input Code -->
                        <div class="form-group">

                            <div class="input-group mb-3">

                                <span class="input-group-text"><i class="fa fa-code"></i></span>

                                <input class="form-control input-lg" type="text" id="newPurchaseCode" name="newPurchaseCode" placeholder="Add Product Code" required readonly>

                            </div>

                        </div>

                        <!--Input description -->

                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" id="newProductDescription" name="newProductDescription">

                                    <option value="">Select Product</option>

                                    <?php

                                    $item2 = null;
                                    $value2 = null;
                                    $order = "id";

                                    $products = controllerProducts::ctrShowProducts($item2, $value2, $order);

                                    foreach ($products as $key => $value3) {

                                        echo '<option value="' . $value3["id"] . '">' . $value3["description"] . '</option>';
                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <!-- input Stock -->

                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon4"><i class="fa fa-check"></i></span>

                                <input class="form-control input-lg" type="number" id="newPurchaseStock" name="newPurchaseStock" placeholder="Add Stock" min="0" required>

                            </div>

                        </div>

                        <!-- INPUT BUYING PRICE -->

                        <div class="form-group row">

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon5"><i class="fa fa-arrow-up"></i></span>

                                    <input type="number" class="form-control input-lg" id="newBuyingPurchasePrice" name="newBuyingPurchasePrice" step="any" min="0" placeholder="Buying Price" required>

                                </div>

                            </div>

                            <!-- INPUT SELLING PRICE -->

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon6"><i class="fa fa-arrow-down"></i></span>

                                    <input type="number" class="form-control input-lg" id="newSellingPurchasePrice" name="newSellingPurchasePrice" step="any" min="0" placeholder="Selling Price" required>

                                </div>

                                <br>

                                <!-- CHECKBOX PERCENTAGE -->

                                <div class="col-xs-6">

                                    <div class="form-group">

                                        <label>

                                            <input type="checkbox" class="minimal percentage" checked>

                                            Use Percentage

                                        </label>

                                    </div>

                                </div>

                                <!-- INPUT PERCENTAGE -->
                                <div class="col-xs-6" style="padding:0">

                                    <div class="input-group">

                                        <input type="number" class="form-control input-lg newPercentage" min="0" value="12" required>

                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- input image -->

                        <div class="form-group">

                            <div class="panel">Upload image</div>

                            <input type="file" class="newImage" id="newProdPhoto" name="newProdPhoto">

                            <p class="help-block">Maximum size 2Mb</p>

                            <img src="views/img/products/default/anonymous.png" class="img-thumbnail preview" alt="" width="50px">

                        </div>

                    </div>

                </div>

                <!--=====================================
                           FOOTER
        ======================================-->

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">Save Product</button>

                </div>

            </form>

            <?php

            $createProduct = new controllerPurchases();
            $createProduct->ctrCreatePurchases();

            ?>
        </div>

    </div>

</div>


<!--=====================================
              EDIT PRODUCT
======================================-->

<div id="modalEditPurchase" class="modal" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                                 HEADER
                ======================================-->

                <div class="modal-header" style="background:#DD4B39; color:white">

                    <h4 class="modal-title">Edit product</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!--=====================================
                                  BODY
                 ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- Select Supplier -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" name="editSupplier" readonly required>

                                    <option id="editSupplier"></option>

                                </select>

                            </div>

                        </div>

                        <!--Input Code -->      
                        <div class="form-group">

                            <div class="input-group mb-3">

                                <span class="input-group-text"><i class="fa fa-code"></i></span>

                                <input class="form-control input-lg" type="text" id="editPurchaseCode" name="editPurchaseCode" placeholder="Add Product Code" required readonly>

                            </div>

                        </div>

                        <!-- INPUT FOR THE DESCRIPTION -->

                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" name="editDescription" readonly required>

                                    <option id="editDescription"></option>

                                </select>

                            </div>

                        </div>

                        <!-- INPUT FOR THE STOCK -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon"><i class="fa fa-check"></i></span>

                                <input type="number" class="form-control input-lg" id="editPurchaseStock" name="editPurchaseStock" min="0" required>

                            </div>

                        </div>

                        <!-- INPUT FOR BUYING PRICE -->
                        <div class="form-group row">

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-arrow-up"></i></span>

                                    <input type="number" class="form-control input-lg" id="editBuyingPurchasePrice" name="editBuyingPurchasePrice" step="any" min="0" required>

                                </div>

                            </div>

                            <!-- INPUT FOR SELLING PRICE -->
                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-arrow-down"></i></span>

                                    <input type="number" class="form-control input-lg" id="editSellingPurchasePrice" name="editSellingPurchasePrice" step="any" min="0" readonly required>

                                </div>

                                <br>

                                <!-- PERCENTAGE CHECKBOX -->
                                <div class="col-xs-6">

                                    <div class="form-group">

                                        <label>

                                            <input type="checkbox" class="minimal percentage" checked>

                                            Use Percentage

                                        </label>

                                    </div>

                                </div>

                                <!-- INPUT FOR PORCENTAGE -->
                                <div class="col-xs-6" style="padding:0">

                                    <div class="input-group">

                                        <input type="number" class="form-control input-lg newPercentage" min="0" value="12" required>

                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- INPUT TO UPLOAD IMAGE -->
                        <div class="form-group">

                            <div class="panel">Product Image</div>

                            <!-- <input type="file" class="newImage" name="editImage" readonly> -->

                            <!-- <p class="help-block">2MB max</p> -->

                            <img src="views/img/products/default/anonymous.png" class="img-thumbnail preview" width="100px">

                            <input type="hidden" name="currentImage" id="currentImage" >

                        </div>

                    </div>

                </div>

                <!--=====================================
                                 FOOTER
                ======================================-->

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">Save Changes</button>

                </div>

            </form>

            <?php

            $editProduct = new controllerPurchases();
            $editProduct->ctrEditPurchases();

            ?>

        </div>

    </div>

</div>

<?php

$deleteProduct = new controllerPurchases();
$deleteProduct->ctrDeletePurchases();

?>