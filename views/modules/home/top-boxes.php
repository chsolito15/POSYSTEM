<?php

$item = null;
$value = null;
$order = "id";

$sales = ControllerSales::ctrAddingTotalSales();

$categories = ControllerCategories::ctrShowCategories($item, $value);
$totalCategories = count($categories);

$customers = ControllerCustomers::ctrShowCustomers($item, $value);
$totalCustomers = count($customers);

$products = ControllerProducts::ctrShowProducts($item, $value, $order);
$totalProducts = count($products);

?>

<div class="col-xl-3 col-md-5">

    <div class="card bg-primary text-white mb-2">

        <div class="card-body d-flex align-items-center justify-content-between">

            <div class="inner">

                <h3>$<?php echo number_format($sales["total"], 2); ?></h3>

                <small>Sales</small>

            </div>

            <ion-icon name="logo-usd" size="large"></ion-icon>

        </div>

        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="#">View Details</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-5">
    <div class="card bg-secondary text-white mb-2">

        <div class="card-body d-flex align-items-center justify-content-between">

            <div class="inner">

                <h3><?php echo number_format($totalCategories); ?></h3>

                <small>Categories</small>

            </div>

            <ion-icon name="clipboard-outline" size="large"></ion-icon>

        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="#">View Details</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-5">
    <div class="card bg-success text-white mb-2">

        <div class="card-body d-flex align-items-center justify-content-between">

            <div class="inner">

                <h3><?php echo number_format($totalCustomers); ?></h3>

                <small>Customers</small>

            </div>

            <ion-icon name="person-add-outline" size="large"></ion-icon>

        </div>

        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="#">View Details</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>

    </div>
</div>

<div class="col-xl-3 col-md-5">
    <div class="card bg-danger text-white mb-2">
        <div class="card-body d-flex align-items-center justify-content-between">

            <div class="inner">

                <h3><?php echo number_format($totalProducts); ?></h3>

                <small>Products</small>

            </div>

            <ion-icon name="cart-outline" size="large"></ion-icon>

        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="#">View Details</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>


<!--     <div class="container-fluid px-4">
        <h1 class="mt-4">Seller Panel for Dashboard</h1>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div> -->