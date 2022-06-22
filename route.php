<?php

include "config/Connection.php";
include "config/Environment.php";
include "config/View.php";
include "Controllers/AuthController.php";
include "Controllers/OrderController.php";
include "Controllers/ProductController.php";
include "Controllers/UserController.php";

$request    = explode("?",$_SERVER['REQUEST_URI']);
$data       = isset($_POST) ? $_POST : null;

(new AuthController())->index($request[0]);
if (count($request) == 1 && !in_array($request[0], ["/", "/login"])) {
    http_response_code(404);
    echo "404";
    die;
}

switch ($request[0]) {
    case "/" :
        (new AuthController())->dashboard();
        break;
    case "/login" :
        new View('login');
        break;
    case "/auth" :
        (new AuthController())->auth($data);
        break;

    // User
    case "/user" :
        (new UserController())->index();
        break;
    case "/user/read" :
        (new UserController())->read();
        break;
    case "/user/createView" :
        new View('user/create');
        break;
    case "/user/create" :
        (new UserController())->create($data);
        break;
    case "/user/updateView" :
        new View('user/edit');
        break;
    case "/user/update" :
        (new UserController())->update($data);
        break;
    case "/user/deleteView" :
        new View('user/delete');
        break;
    case "/user/delete" :
        (new UserController())->delete($data);
        break;

    // Product
    case "/product" :
        (new ProductController())->index();
        break;
    case "/product/read" :
        (new ProductController())->read();
        break;
    case "/product/createView" :
        new View('product/create');
        break;
    case "/product/create" :
        (new ProductController())->create($data);
        break;
    case "/product/updateView" :
        new View('product/edit');
        break;
    case "/product/update" :
        (new ProductController())->update($data);
        break;
    case "/product/deleteView" :
        new View('product/delete');
        break;
    case "/product/delete" :
        (new ProductController())->delete($data);
        break;

    //Order
    case "/order":
        (new OrderController())->index();
        break;
    case "/order/read":
        (new OrderController())->read();
        break;
    case "/order/createView" :
        (new OrderController())->createView();
        break;
    case "/order/create" :
        (new OrderController())->create($data);
        break;
    case "/order/print" :
        (new OrderController())->print($request[1]);
        break;
    case "/order/deleteView" :
        new View('order/delete');
        break;
    case "/order/delete" :
        (new OrderController())->delete($data);
        break;

    default:
        http_response_code(404);
        echo "404";
        break;
}