<?php

require __DIR__ . '/inc/bootstrap.php';

$urn = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urn = explode('/', $urn);

if(count($urn) !== 3 && !isset($urn['users'])){
    
    header("HTTP/1.1 404 Not Found");
    exit();
}

require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
$UserController = new UserController();

if (($urn[1] == 'users') && ($urn[2] == 'login')){
    $UserController->loginAction();

} else if (($urn[1] == 'users') && ($urn[2] == 'create')) {
    $UserController->createAction();

} else if (($urn[1] == 'users') && ($urn[2] == 'about')) {
    $UserController->aboutAction();

} else if (($urn[1] == 'users') && ($urn[2] == 'edit')) {
    $UserController->editAction();

} else if (($urn[1] == 'users') && ($urn[2] == 'delete')) {
    $UserController->deleteAction();

}
