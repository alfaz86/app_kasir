<?php

class ProductController
{
    public $connection;

    public function __construct()
    {
        $this->connection = (new Connection())->connection;
    }

    public function index()
    {
        new View("product/index");
    }

    public function read()
    {
        $no     = 1;
        $query  = mysqli_query($this->connection, "SELECT * FROM products");

        $elements   = "";
        if (mysqli_num_rows($query) > 0) {
            while($row  = mysqli_fetch_array($query)){
                $elements .= "
                    <tr data-product=".json_encode($row)." data-id=".json_encode($row["id"])." onclick='setdataProduct(this, ".json_encode($row).")'>
                        <td>".$no++."</td>
                        <td>".$row["code"]."</td>
                        <td>".$row["name"]."</td>
                        <td>".$row["stock"]."</td>
                        <td>".$row["price"]."</td>
                    </tr>
                ";
            }
        } else {
            $elements .= "
                    <tr>
                        <td colspan='5' class='text-center'>data kosong.</td>
                    </tr>
                ";
        }

        echo $elements;
    }

    public function create($data)
    {
        try {
            if ($data != null) {
                $query = mysqli_query(
                    $this->connection, 
                    "INSERT INTO products SET
                    code     = '$data[code]',
                    name     = '$data[name]',
                    stock    = '$data[stock]',
                    price    = '$data[price]'"
                );
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->errorMessage());
        }
    }

    public function update($data)
    {
        try {
            if ($data != null) {
                $query = mysqli_query(
                    $this->connection, 
                    "UPDATE products SET
                    code     = '$data[code]',
                    name     = '$data[name]',
                    stock    = '$data[stock]',
                    price    = '$data[price]'
                    WHERE 
                    id      = '$data[id]'"
                );
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->errorMessage());
        }
    }

    public function delete($data)
    {
        try {
            if ($data != null) {
                $product = mysqli_query(
                    $this->connection, 
                    "SELECT * FROM order_items WHERE product_id = '$data[id]'"
                );
                if (mysqli_num_rows($product) == 0) {
                    $query = mysqli_query(
                        $this->connection, 
                        "DELETE FROM products WHERE id = '$data[id]'"
                    );
                } else {
                    http_response_code(500);
                    echo "Barang tidak dapat dihapus karena memiliki relasi!";
                }
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->errorMessage());
        }
    }

}