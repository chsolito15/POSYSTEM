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

        <h2>Catergory Management</h2>

        <ol class="breadcrumb navbar ms-auto mb-2 mb-lg-0 list-unstyled ">
            <li class="breadcrumb-item"><a href="home" class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>

    </div>

</nav>

<div class="container">

    <div class="mb-2">

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategories"> <i class="fa fa-plus"></i> Add Categories</button>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table border table border table-bordered table-hover table-striped dt-responsive tables" style="width: 100%;">

                <thead>

                    <tr>
                    
                        <th>#</th>
                        <th>Category</th>
                        <th>Date Created</th>
                        <th style="width: 30%">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $item = null;
                    $value = null;

                    $categories = ControllerCategories::ctrShowCategories($item, $value);

                              /*echo '<pre>';
                                var_dump($categories);
                                echo '</pre>';*/

                    foreach ($categories as $key => $value) {

                        echo '<tr>
                   
                                <td>' . ($key + 1) . '</td>
                                
                                <td class="text-uppercase">' . $value['Category'] . '</td>

                                <td class="text-uppercase">' . $value['created_at'] . '</td>

                                <td>

                                    <div class="btn-group" style="width:30%">
                                        
                                        <button class="btn btn-primary btnEditCategory" idCategory="' . $value["id"] . '" data-bs-toggle="modal" data-bs-target="#editCategories"><i class="fa fa-pencil"></i></button>

                                        <button class="btn btn-danger btnDeleteCategory" idCategory="' . $value["id"] . '"><i class="fa fa-trash"></i></button>

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
=            module add Categories            =
======================================-->

<!-- Modal -->

<div id="addCategories" class="modal" tabindex="-1" aria-labelledby="..." aria-hidden="true">

    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">

            <form role="form" method="POST">

                <div class="modal-header bg-danger text-white">

                    <h4 class="modal-title">Add Categories</h4>

                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!--Input name -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
                                <input class="form-control input-lg" type="text" name="newCategory" placeholder="Add Category" required>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger d-block d-lg-none" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Category</button>

                </div>
            </form>
        </div>

    </div>
</div>

<?php

$createCategory = new ControllerCategories();
$createCategory->ctrCreateCategory();

?>


<!--=====================================
=     module edit Categories            =
======================================-->


<!-- Modal -->
<div id="editCategories" class="modal" tabindex="-1" aria-labelledby="..." aria-hidden="true">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="POST">
                <div class="modal-header" style="background: #DD4B39; color: #fff">

                    <h4 class="modal-title">Edit Categories</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <!--Input name -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
                                <input class="form-control input-lg" type="text" id="editCategory" name="editCategory" required>
                                <input type="hidden" name="idCategory" id="idCategory" required>
                            </div>
                        </div>
                        <!-- Log on to codeastro.com for more projects! -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>

                <?php

                $editCategory = new ControllerCategories();
                $editCategory->ctrEditCategory();
                ?>
            </form>
        </div>

    </div>
</div>
<!-- Log on to codeastro.com for more projects! -->
<?php

$deleteCategory = new ControllerCategories();
$deleteCategory->ctrDeleteCategory();
?>