
<?php
require_once 'controllers/template.controller.php';

require_once "controllers/users.controller.php";
require_once "controllers/categories.controller.php";
require_once "controllers/products.controller.php";
require_once "controllers/customers.controller.php";
require_once "controllers/sales.controller.php";
require_once "controllers/suppliers.controller.php";
require_once "controllers/purchases.controller.php";
require_once "controllers/transactions.controller.php";

require_once "models/users.model.php";
require_once "models/categories.model.php";
require_once "models/products.model.php";
require_once "models/customers.model.php";
require_once "models/sales.model.php";
require_once "models/suppliers.model.php";
require_once "models/purchases.model.php";
require_once "models/transactions.model.php";

require_once 'extensions/vendor/autoload.php';

$template = new TemplateController();
$template::ctrTemplate();

?>



                                                       
