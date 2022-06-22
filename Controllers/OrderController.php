<?php

class OrderController
{
    public $connection;

    public function __construct()
    {
        $this->connection = (new Connection())->connection;
    }

    public function index()
    {
        new view("order/index");
    }
    
    public function read()
    {
        $no     = 1;
        $query  = mysqli_query(
            $this->connection, 
            "SELECT * FROM orders"
        );
        
        $elements = "";
        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_array($query)){
                $order_items = mysqli_query(
                    $this->connection, 
                    "SELECT * FROM order_items
                    JOIN products ON products.id = order_items.product_id
                    WHERE order_items.order_id = $row[id]"
                );

                $item_names     = "";
                $item_qtys      = "";
                $item_prices    = "";
                $item_subtotals = "";
                while($item = mysqli_fetch_array($order_items)){
                    $item_names     .= "$item[name] <br>";
                    $item_qtys      .= "$item[qty] <br>";
                    $item_prices    .= "$item[price] <br>";
                    $item_subtotals .= "$item[subtotal] <br>";
                }
                
                $elements .= "
                    <tr data-order=".json_encode($row)." data-id=".json_encode($row["id"])." onclick='setdataOrder(this, ".json_encode($row["id"]).")'>
                        <td>".$no++."</td>
                        <td>".$row["no_transaction"]."</td>
                        <td>".$item_names."</td>
                        <td>".$item_prices."</td>
                        <td>".$item_qtys."</td>
                        <td>".$item_subtotals."</td>
                        <td>".$row["total_item"]."</td>
                        <td>".$row["total_price"]."</td>
                        <td>".$row["paid"]."</td>
                        <td>".$row["change"]."</td>
                    </tr>
                ";
            }
        } else {
            $elements .= "
                    <tr>
                        <td colspan='6' class='text-center'>data kosong.</td>
                    </tr>
                ";
        }

        echo $elements;
    }

    public function createView()
    {
        $products   = mysqli_query($this->connection, "select * from products");
        $order      = new View('order/create');
        $order->assign('products', $products);
    }

    public function create($data)
    {
        try {
            if ($data != null) {
                $date           = date("Y-m-d");
                $total_item     = count($data["product_id"]);
                $getOrders  = mysqli_query(
                    $this->connection, 
                    "SELECT * FROM orders WHERE `date` = $date"
                );
        
                $totalOrder     = mysqli_num_rows($getOrders);
                $no_transaction = "AK/".preg_replace('/\//i', '', date("y/m/d")).sprintf("/%'.02d", $totalOrder+1);
                
                $order = mysqli_query(
                    $this->connection, 
                    "INSERT INTO orders SET
                    `date`          = '$date',
                    no_transaction  = '$no_transaction',
                    total_price     = '$data[total]',
                    total_item      = '$total_item',
                    paid            = '$data[paid]',
                    `change`        = '$data[change]'"
                );
                
                $order_id = mysqli_insert_id($this->connection);
                foreach ($data["product_id"] as $i => $value) {
                    $product_id = $data["product_id"][$i];
                    $qty        = $data["qty"][$i];
                    $subtotal   = $data["subtotal"][$i];
                    mysqli_query(
                        $this->connection, 
                        "INSERT INTO order_items SET
                        order_id    = '$order_id',
                        product_id  = '$product_id',
                        qty         = '$qty',
                        subtotal    = '$subtotal'"
                    );
                    mysqli_query(
                        $this->connection, 
                        "UPDATE products SET stock = stock - $qty WHERE id = '$product_id'"
                    );
                }
                echo $order_id;
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->errorMessage());
        }
    }

    public function print($request){
        $query_order = mysqli_query(
            $this->connection, 
            "SELECT * FROM orders WHERE $request"
        );
        $order = mysqli_fetch_object($query_order);
        $order->items = [];
        $query_order_items = mysqli_query(
            $this->connection, 
            "SELECT * FROM order_items
            JOIN products ON products.id = order_items.product_id
            WHERE order_items.order_id = $order->id"
        );
        while($item = mysqli_fetch_object($query_order_items)){
            array_push($order->items , $item);
        };

        $print = new View('order/print');
        $print->assign('order', $order);
    }

    public function delete($data){
        try {
            if ($data != null) {
                $order = mysqli_query(
                    $this->connection, 
                    "DELETE FROM orders WHERE id = '$data[id]'"
                );
                $order_items = mysqli_query(
                    $this->connection, 
                    "DELETE FROM order_items WHERE order_id = '$data[id]'"
                );
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->errorMessage());
        }
    }
}