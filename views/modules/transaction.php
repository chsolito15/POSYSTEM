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

        <h2>Transactions Management</h2>

        <ol class="breadcrumb navbar ms-auto mb-2 mb-lg-0 list-unstyled ">
            <li class="breadcrumb-item"><a href="home" class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transactions</li>
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

                    <table class="table table-bordered table-hover table-striped dt-responsive productsTable" style="width: 100%;">

                        <thead>

                            <tr>

                                <th style="width:10px">#</th>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>New Stock</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Date added</th>
                                <th>Actions</th>

                            </tr>

                        </thead>

                    </table>

                    <input type="hidden" value="<?php echo $_SESSION['profile']; ?>" id="hiddenProfile">

                </div>

        </section>

    </div>
</div>

<!--=====================================
=            module add Product            =
======================================-->

<!-- Modal -->
<div id="addProduct" class="modal fade" role="dialog">

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

                        <!-- input category -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" id="newCategory" name="newCategory">

                                    <option value="">Select Category</option>

                                    <?php

                                    $item = null;
                                    $value1 = null;

                                    $categories = controllerCategories::ctrShowCategories($item, $value1);

                                    foreach ($categories as $key => $value) {

                                        echo '<option value="' . $value["id"] . '">' . $value["Category"] . '</option>';
                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <!--Input Code -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-code"></i></span>

                                <input class="form-control input-lg" type="text" id="newCode" name="newCode" placeholder="Add Product Code" required>

                            </div>

                        </div>

                        <!-- input description -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon3"><i class="fa-brands fa-product-hunt"></i></span>

                                <input class="form-control input-lg" type="text" id="newDescription" name="newDescription" placeholder="Add Description/Product Name" required>

                            </div>

                        </div>

                        <!-- input Stock -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon4"><i class="fa fa-check"></i></span>

                                <input class="form-control input-lg" type="number" id="newStock" name="newStock" placeholder="Add Stock" min="0" required>

                            </div>

                        </div>

                        <!-- INPUT BUYING PRICE -->
                        <div class="form-group row">

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon5"><i class="fa fa-arrow-up"></i></span>

                                    <input type="number" class="form-control input-lg" id="newBuyingPrice" name="newBuyingPrice" step="any" min="0" placeholder="Buying Price" required>

                                </div>

                            </div>

                            <!-- INPUT SELLING PRICE -->
                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon6"><i class="fa fa-arrow-down"></i></span>

                                    <input type="number" class="form-control input-lg" id="newSellingPrice" name="newSellingPrice" step="any" min="0" placeholder="Selling Price" required>

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

                                        <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- input image -->
                        <div class="form-group">

                            <div class="panel">Upload image</div>

                            <input id="newProdPhoto" type="file" class="newImage" name="newProdPhoto">

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
            <!-- Log on to codeastro.com for more projects! -->

            <?php

            $createProduct = new ControllerProducts();
            $createProduct->ctrCreateProducts();

            ?>
        </div>

    </div>

</div>

<!--=====================================
              EDIT PRODUCT
======================================-->

<div id="modalEditProduct" class="modal" role="dialog">

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

                        <!-- Select Category -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" name="editCategory" readonly required>

                                    <option id="editCategory"></option>

                                </select>

                            </div>

                        </div>

                        <!-- INPUT FOR THE CODE -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon"><i class="fa fa-code"></i></span>

                                <input type="text" class="form-control input-lg" id="editCode" name="editCode" readonly required>

                            </div>

                        </div>

                        <!-- INPUT FOR THE DESCRIPTION -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon"><i class="fa-brands fa-product-hunt"></i></span>

                                <input type="text" class="form-control input-lg" id="editDescription" name="editDescription" required>

                            </div>

                        </div>

                        <!-- INPUT FOR THE STOCK -->
                        <div class="form-group mb-3">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon"><i class="fa fa-check"></i></span>

                                <input type="number" class="form-control input-lg" id="editStock" name="editStock" min="0" required>

                            </div>

                        </div>

                        <!-- INPUT FOR BUYING PRICE -->
                        <div class="form-group row">

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-arrow-up"></i></span>

                                    <input type="number" class="form-control input-lg" id="editBuyingPrice" name="editBuyingPrice" step="any" min="0" required>

                                </div>

                            </div>

                            <!-- INPUT FOR SELLING PRICE -->
                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-arrow-down"></i></span>

                                    <input type="number" class="form-control input-lg" id="editSellingPrice" name="editSellingPrice" step="any" min="0" readonly required>

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

                                <!-- INPUT FOR PORCENTAJE -->
                                <div class="col-xs-6" style="padding:0">

                                    <div class="input-group">

                                        <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- INPUT TO UPLOAD IMAGE -->
                        <div class="form-group">

                            <div class="panel">Upload Image</div>

                            <input type="file" class="newImage" name="editImage">

                            <p class="help-block">2MB max</p>

                            <img src="views/img/products/default/anonymous.png" class="img-thumbnail preview" width="50px">

                            <input type="hidden" name="currentImage" id="currentImage">

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

            $editProduct = new controllerProducts();
            $editProduct->ctrEditProduct();

            ?>

        </div>

    </div>

</div>

<?php

$deleteProduct = new controllerProducts();
$deleteProduct->ctrDeleteProduct();

?>