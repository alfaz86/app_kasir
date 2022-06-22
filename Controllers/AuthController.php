<?php

class AuthController 
{
    public $connection;

    public function __construct()
    {
        $this->connection = (new Connection())->connection;
    }
    
    public function index($request)
    {
        session_start();
        if (!in_array($request, ["/auth", "/login"])) {
            if (!isset($_SESSION['USER'])) {
                header("Location: $_ENV[APP_URL]/login");
                die;
            }
        }
    }

    public function dashboard()
    {
        $date = date("Y-m-d");
        $total_order = mysqli_num_rows(mysqli_query(
            $this->connection, 
            "SELECT * FROM orders"
        ));
        $total_order_today = mysqli_num_rows(mysqli_query(
            $this->connection, 
            "SELECT * FROM orders WHERE `date` = '$date'"
        ));
        $total_product = mysqli_num_rows(mysqli_query(
            $this->connection, 
            "SELECT * FROM products"
        ));
        $most_products = [];
        $total_user = mysqli_num_rows(mysqli_query(
            $this->connection, 
            "SELECT * FROM users"
        ));

        $query = mysqli_query(
            $this->connection, 
            "SELECT products.id, products.name, SUM(order_items.qty) AS qty FROM products 
            JOIN order_items ON products.id = order_items.product_id
            GROUP BY id ORDER BY qty DESC LIMIT 3"
        );
        while($product = mysqli_fetch_object($query)){
            array_push($most_products , $product);
        };

        $dashboard = new View('index');
        $dashboard->assign('total_order', $total_order);
        $dashboard->assign('total_order_today', $total_order_today);
        $dashboard->assign('total_product', $total_product);
        $dashboard->assign('most_products', $most_products);
        $dashboard->assign('total_user', $total_user);
    }

    public function auth($data)
    {
        if ($data != null) {
            $user = mysqli_query(
                $this->connection, 
                "SELECT * FROM users 
                WHERE
                username    = '$data[username]'
                AND
                password    = '$data[password]'"
            );

            if (mysqli_num_rows($user) > 0) {
                $_SESSION['ID']     = mysqli_fetch_assoc($user)['id'];
                $_SESSION['USER']   = $data['username'];
                echo "success";
            } else {
                echo "failed";
            }
        }

        if ($data == null) {
            session_unset();
            session_destroy();
        }
    }
}