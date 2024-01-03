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

        <h2>Create Sales</h2>

        <ol class="breadcrumb navbar ms-auto mb-2 mb-lg-0 list-unstyled ">
            <li class="breadcrumb-item"><a href="home" class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create sale</li>
        </ol>

    </div>

</nav>

<div class="container">

    <div class="row">

        <!--=============================================
                            THE FORM
        =============================================-->

        <div class="card col mx-2 border border-success">

            <div class="card-body">

                <div class="col">

                    <div class="box box-default">

                        <div class="box-header with-border"></div>

                        <form role="form" method="post" class="saleForm">

                            <div class="box-body">

                                <div class="box">

                                    <!--=====================================
                                        =          SELLER INPUT           =
                                     ======================================-->


                                    <div class="form-group mb-3">

                                        <div class="input-group">

                                            <span class="input-group-text" id="basic-addon"><i class="fa fa-user"></i></span>
                                         
                                            <input type="text" class="form-control"  name="newSeller" id="newSeller" value="<?php echo $_SESSION["name"]; ?>" readonly>

                                            <input type="hidden" name="idSeller" value="<?php echo $_SESSION["id"]; ?>">

                                        </div>

                                    </div>

                                    <!--=====================================
                                                    CODE INPUT
                                    ======================================-->

                                    <div class="form-group mb-3">

                                        <div class="input-group ">

                                            <span class="input-group-text" id="basic-addon"><i class="fa fa-key"></i></span>


                                            <?php
                                            $item = null;
                                            $value = null;

                                            $sales = ControllerSales::ctrShowSales($item, $value);

                                            if (!$sales) {

                                                echo '<input type="text" class="form-control" name="newSale" id="newSale" value="10001" readonly>';
                                            } else {

                                                foreach ($sales as $key => $value) {
                                                }

                                                $code = $value["code"] + 1;

                                                echo '<input type="text" class="form-control" name="newSale" id="newSale" value="' . $code . '" readonly>';
                                            }

                                            ?>

                                        </div>


                                    </div>


                                    <!--=====================================
                                    =            CUSTOMER INPUT           =
                                    ======================================-->

                                    <div class="form-group mb-3">

                                        <div class="input-group">

                                            <span class="input-group-text" id="basic-addon"><i class="fa fa-users"></i></span>
                                            <select class="form-select" name="selectCustomer" id="selectCustomer" required>

                                                <option value="">Select Customer</option>

                                                <?php

                                                $item = null;
                                                $value = null;

                                                $customers = ControllerCustomers::ctrShowCustomers($item, $value);

                                                foreach ($customers as $key => $value) {
                                                    echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                                                }


                                                ?>

                                            </select>

                                            <button type="button" class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#modalAddCustomer" data-bs-dismiss="modal">Add Customer</button>

                                        </div>

                                    </div>

                                    <!--=====================================
                                    =            PRODUCT INPUT           =
                                    ======================================-->

                                    <div class="form-group row newProduct"></div>
                                    

                                    <input type="hidden" name="productsList" id="productsList">

                                    <!--=====================================
                                    =            ADD PRODUCT BUTTON          =
                                    ======================================-->

                                    <button type="button" class="btn btn-success d-lg-none btnAddProduct">Add Product</button>

                                    <div class="row">

                                        <!--=====================================
                                                 TAXES AND TOTAL INPUT
                                        ======================================-->

                                        <div class="col">

                                            <table class="table-borderless ">

                                                <thead>

                                                    <th>Taxes</th>
                                                    <th>Total</th>

                                                </thead>

                                                <tbody>

                                                    <tr>

                                                        <td>

                                                            <div class="input-group">

                                                                <input type="number" class="form-control" name="newTaxSale" id="newTaxSale" placeholder="0" min="0" required>

                                                                <input type="hidden" name="newTaxPrice" id="newTaxPrice" required>

                                                                <input type="hidden" name="newNetPrice" id="newNetPrice" required>

                                                                <span class="input-group-text" id="basic-addon"><i class="fa fa-percent"></i></span>

                                                            </div>
                                                            
                                                        </td>

                                                        <td>

                                                            <div class="input-group">

                                                                <span class="input-group-text" id="basic-addon"><i class="fa-solid fa-dollar-sign"></i></span>

                                                                <input type="number" class="form-control" name="newSaleTotal" id="newSaleTotal" placeholder="00000" totalSale="" readonly required>

                                                                <input type="hidden" name="saleTotal" id="saleTotal" required>

                                                            </div>

                                                        </td>

                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                            
                                    <!--=====================================
                                                PAYMENT METHOD
                                    ======================================-->

                                    <div class="form-group row mt-4">

                                        <div class="col-xs-6" style="padding-right: 0">

                                            <div class="input-group">

                                                <select class="form-select" name="newPaymentMethod" id="newPaymentMethod" required>

                                                    <option value="">-Select Payment Method-</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="CC">Credit Card</option>
                                                    <option value="DC">Debit Card</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="paymentMethodBoxes"></div>

                                        <input type="hidden" name="listPaymentMethod" id="listPaymentMethod" required>

                                    </div>

                                    <br>

                                </div>

                            </div>
                 
                                <button type="submit" class="btn btn-success">Save Sale</button>                   

                        </form>

                        <?php

                        $saveSale = new ControllerSales();
                        $saveSale::ctrCreateSale();

                        ?>

                    </div>

                </div>
            </div>
        </div>

        <!--=============================================
      =            PRODUCTS TABLE                   =
      =============================================-->

        <div class="col-lg-7 d-none d-sm-block">

            <div class="card">

                <div class="card-body">

                    <table class="table table-bordered table-hover table-striped dt-responsive salesTable">

                        <thead>

                            <tr>

                                <th style="width:10px">#</th>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Stock</th>
                                <th>Actions</th>

                            </tr>

                        </thead>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>

<!--=====================================
=            module add Customer            =
======================================-->

<!-- Modal -->
<div id="modalAddCustomer" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="POST">
                <div class="modal-header" style="background: #DD4B39; color: #fff">

                    <h4 class="modal-title">Add Customer</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <!--Input name -->
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control input-lg" type="text" name="newCustomer" placeholder="Write name" required>
                            </div>
                        </div>

                        <!--Input id document -->
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control input-lg" type="number" min="0" name="newIdDocument" placeholder="Write your ID" required>
                            </div>
                        </div>

                        <!--Input email -->
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon"><i class="fa fa-envelope"></i></span>
                                <input class="form-control input-lg" type="text" name="newEmail" placeholder="Email" required>
                            </div>
                        </div>

                        <!--Input phone -->
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon"><i class="fa fa-phone"></i></span>
                                <input class="form-control input-lg" type="text" name="newPhone" placeholder="phone" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                            </div>
                        </div>

                        <!--Input address -->
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon"><i class="fa fa-map-marker"></i></span>
                                <input class="form-control input-lg" type="text" name="newAddress" placeholder="Address" required>
                            </div>
                        </div>

                        <!--Input phone -->
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control input-lg" type="text" name="newBirthdate" placeholder="Birth Date" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer mb-4">
                    <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Close</button>
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

<!--====  End of module add Customer  ====-->