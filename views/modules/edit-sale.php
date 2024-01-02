<nav class="navbar navbar-expand-lg bg-light mb-3 p-2">

  <h2>Edit Sale</h2>

  <ul class="navbar ms-auto mb-2 mb-lg-0 list-unstyled ">

    <li><a href="home" class="text-dark text-decoration-none"><i class="fa fa-home "></i> Home<i class="fas fa-angle-left"></i> </a></li>

    <li class="active">Dashboard</li>

  </ul>

</nav>

<div class="container">

  <div class="row">

    <!--=============================================
      THE FORM
      =============================================-->
    <div class="card col mx-1">

      <div class="card-body">

        <div class="box-header with-border"></div>

        <form role="form" method="post" class="saleForm">

          <div class="box-body">

            <div class="box">

              <?php

              $item = "id";
              $value = $_GET["idSale"];

              $sale = ControllerSales::ctrShowSales($item, $value);

              $itemUser = "id";
              $valueUser = $sale["idSeller"];

              $seller = ControllerUsers::ctrShowUsers($itemUser, $valueUser);

              $itemCustomers = "id";
              $valueCustomers = $sale["idCustomer"];

              $customers = ControllerCustomers::ctrShowCustomers($itemCustomers, $valueCustomers);

              $taxPercentage = round($sale["tax"] * 100 / $sale["netPrice"]);
              ?>

              <!--=====================================
                    =            SELLER INPUT           =
                    ======================================-->


              <div class="form-group">

                <div class="input-group mb-3">

                  <span class="input-group-text" id="basic-addon"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $seller["name"]; ?>" readonly>

                  <input type="hidden" name="idSeller" value="<?php echo $seller["id"]; ?>">

                </div>

              </div>


              <!--=====================================
                    CODE INPUT
                    ======================================-->


              <div class="form-group">

                <div class="input-group mb-3">

                  <span class="input-group-text" id="basic-addon"><i class="fa fa-key"></i></span>

                  <input type="text" class="form-control" id="newSale" name="editSale" value="<?php echo $sale["code"]; ?>" readonly>

                </div>


              </div>

              <!--=====================================
                    =            CUSTOMER INPUT           =
                    ======================================-->

              <div class="form-group">

                <div class="input-group mb-3">

                  <span class="input-group-text" id="basic-addon"><i class="fa fa-users"></i></span>

                  <select class="form-select" name="selectCustomer" id="selectCustomer" required>

                    <option value="<?php echo $customers["id"]; ?>"><?php echo $customers["name"]; ?></option>

                    <?php

                    $item = null;
                    $value = null;

                    $customers = ControllerCustomers::ctrShowCustomers($item, $value);

                    foreach ($customers as $key => $value) {
                      echo '<option value="' . $value["id"] . '">' . $value["name"]  . '</option>';
                    }
                    ?>

                  </select>

                 <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#modalAddCustomer" data-bs-dismiss="modal">Add Customer</button>

                </div>

              </div>

              <!--=====================================
                    =            PRODUCT INPUT           =
                    ======================================-->


              <div class="form-group row newProduct">
                <?php

                $productList = json_decode($sale["products"], true);

                foreach ($productList as $key => $value) {

                  $item = "id";
                  $valueProduct = $value["id"];
                  $order = "id";

                  $answer = ControllerProducts::ctrShowproducts($item, $valueProduct, $order);

                  $lastStock = $answer["stock"] + $value["quantity"];

                  echo '<div class="row" style="padding:5px 15px">
                    
                                <div class="col-xs-6" style="padding-right:0px">
                    
                                  <div class="input-group mb-2">
                        
                                    <span class="bg-danger"><button type="button" class="btn btn-default btn-xs removeProduct" idProduct="' . $value["id"] . '"><i class="fa fa-close"></i></button></span>

                                    <input type="text" class="form-control newProductDescription" idProduct="' . $value["id"] . '" name="addProduct" value="' . $value["description"] . '" readonly required>

                                  </div>

                                </div>

                                <div class="col">

                                <small>Product Quantity</small>
                      
                                  <input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="' . $value["quantity"] . '" stock="' . $lastStock . '" newStock="' . $value["stock"] . '" required>

                                </div>

                                <div class="col enterPrice" style="padding-left:0px">

                                <small>Total</small>

                                  <div class="input-group">

                                    <span class="input-group-text" id="basic-addon"><i class="fa-solid fa-dollar-sign"></i></span>
                           
                                    <input type="text" class="form-control newProductPrice" realPrice="' . $answer["sellingPrice"] . '" name="newProductPrice" value="' . $value["totalPrice"] . '" readonly required>
           
                                  </div>
                       
                                </div>

                              </div>';
                }


                ?>

              </div>

              <input type="hidden" name="productsList" id="productsList">

              <!--=====================================
                    =            ADD PRODUCT BUTTON          =
                    ======================================-->

              <button type="button" class="btn btn-success d-lg-none btnAddProduct">Add Product</button>

              <hr>

              <div class="row">

                <!--=====================================
                        TAXES AND TOTAL INPUT
                      ======================================-->

                <div class="col-xs-8 pull-right">

                  <table class="table">

                    <thead>

                      <th>Taxes</th>
                      <th>Total</th>

                    </thead>


                    <tbody>

                      <tr>

                        <td style="width: 50%">

                          <div class="input-group">

                            <input type="number" class="form-control" name="newTaxSale" id="newTaxSale" value="<?php echo $taxPercentage; ?>" min="0" required>

                            <input type="hidden" name="newTaxPrice" id="newTaxPrice" value="<?php echo $sale["tax"]; ?>" required>

                            <input type="hidden" name="newNetPrice" id="newNetPrice" value="<?php echo $sale["netPrice"]; ?>" required>

                            <span class="input-group-text" id="basic-addon"><i class="fa fa-percent"></i></span>

                          </div>
                        </td>

                        <td style="width: 50%">

                          <div class="input-group">

                            <span class="input-group-text" id="basic-addon"><i class="fa-solid fa-dollar-sign"></i></span>

                            <input type="number" class="form-control" name="newSaleTotal" id="newSaleTotal" placeholder="00000" totalSale="<?php echo $sale["netPrice"]; ?>" value="<?php echo $sale["totalPrice"]; ?>" readonly required>

                            <input type="hidden" name="saleTotal" id="saleTotal" value="<?php echo $sale["totalPrice"]; ?>" required>

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

              <div class="form-group row">

                <div class="col-xs-6" style="padding-right: 0">

                  <div class="input-group">

                    <select class="form-select" name="newPaymentMethod" id="newPaymentMethod" required>

                      <option selected>-Select Payment Method-</option>
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

          <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right">Save Changes</button>
          </div>
        </form>

        <?php

        $editSale = new ControllerSales();
        $editSale->ctrEditSale();

        ?>

      </div>

    </div>


    <!--=============================================
      =            PRODUCTS TABLE                   =
      =============================================-->


    <div class="col-lg-7 d-none d-sm-block">

      <div class="box box-default">

        <div class="box-header with-border"></div>

        <div class="card">

          <div class="card-body">

            <table class="table table-bordered table-hover table-striped dt-responsive salesTable" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>Image</th>
                  <th style="width:30px">Code</th>
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
            <div class="form-group mb-3">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon"><i class="fa fa-user"></i></span>
                <input class="form-control input-lg" type="text" name="newCustomer" placeholder="Write name" required>
              </div>
            </div>

            <!--Input id document -->
            <div class="form-group mb-3">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="newIdDocument" placeholder="Write your ID" required>
              </div>
            </div>

            <!--Input email -->
            <div class="form-group mb-3">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon"><i class="fa fa-envelope"></i></span>
                <input class="form-control input-lg" type="text" name="newEmail" placeholder="Email" required>
              </div>
            </div>

            <!--Input phone -->
            <div class="form-group mb-3">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon"><i class="fa fa-phone"></i></span>
                <input class="form-control input-lg" type="text" name="newPhone" placeholder="phone" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
              </div>
            </div>

            <!--Input address -->
            <div class="form-group mb-3">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon"><i class="fa fa-map-marker"></i></span>
                <input class="form-control input-lg" type="text" name="newAddress" placeholder="Address" required>
              </div>
            </div>


            <!--Input phone -->
            <div class="form-group mb-3">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon"><i class="fa fa-calendar"></i></span>
                <input class="form-control input-lg" type="text" name="newBirthdate" placeholder="Birth Date" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save Customer</button>
        </div>
      </form><!-- Log on to codeastro.com for more projects! -->

      <?php

      $createCustomer = new ControllerCustomers();
      $createCustomer->ctrCreateCustomer();

      ?>
    </div>

  </div>
</div>

<!--====  End of module add Customer  ====-->