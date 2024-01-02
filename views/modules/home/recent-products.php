<?php

$item = null;
$value = null;
$order = "id";

$products = ControllerProducts::ctrShowProducts($item, $value, $order);

?>

<div class="card">

  <div class="card-header">
  
      <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample">
         <small>Recently Added Product</small>
      </button>
  
  </div>

  <div class="collapse show" id="collapseExample">

    <div class="card-body">

      <ul class="list-unstyled">

        <?php

        for ($i = 0; $i < count($products); $i++) {

        echo '<li>

                <div class="row">

                  <div class="list-group list-group-flush">

                    <a class="list-group-item list-group-item-action">

                      <div class="col">

                        <img src="' . $products[$i]["image"] . '" alt="Product Image" class="" width="40px">

                          ' . $products[$i]["description"] . '

                        <span class="bg-success text-white p-1" style="float:right;">$' . $products[$i]["sellingPrice"] . '</span>

                      </div>

                    </a>

                  </div>

                </div>

              </li>';
        }

        ?>

      </ul>
    </div>
  </div>
</div>


