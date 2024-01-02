<?php

session_destroy();

$table = "users";

$item1 = "lastLogin";
$value1 = 0;

$item2 = "id";
$value2 = $_SESSION["id"];

$lastLogin = UsersModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);

if ($lastLogin == "ok") {
     echo '<script>

        window.location = "login";

     </script>';
}

