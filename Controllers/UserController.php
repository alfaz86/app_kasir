<?php

class UserController
{
    public $connection;

    public function __construct()
    {
        $this->connection = (new Connection())->connection;
    }

    public function index()
    {
        new View('user/index');
    }

    public function read()
    {
        $no     = 1;
        $query  = mysqli_query($this->connection, "SELECT * FROM users");

        $elements   = "";
        if (mysqli_num_rows($query) > 0) {
            while($row  = mysqli_fetch_array($query)){
                $elements .= "
                    <tr data-user=".json_encode($row)." data-id=".json_encode($row["id"])." onclick='setdataUser(this, ".json_encode($row).")'>
                        <td>".$no++."</td>
                        <td>".$row["username"]."</td>
                        <td>".$row["password"]."</td>
                    </tr>
                ";
            }
        } else {
            $elements .= "
                    <tr>
                        <td colspan='3' class='text-center'>data kosong.</td>
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
                    "INSERT INTO users SET
                    username    = '$data[username]',
                    password    = '$data[password]'"
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
                    "UPDATE users SET
                    username    = '$data[username]',
                    password    = '$data[password]'
                    WHERE 
                    id      = '$data[id]'"
                );
                $user = mysqli_query(
                    $this->connection, 
                    "SELECT * FROM users WHERE id = '$data[id]'"
                );
                if ($query) {
                    if (isset($_SESSION['USER'])) {
                        if ($_SESSION['ID'] == mysqli_fetch_assoc($user)['id']) {
                            $_SESSION['ID']     = $data["id"];
                            $_SESSION['USER']   = $data["username"];
                            echo "session_update";
                        }
                    }
                }
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
                $query = mysqli_query(
                    $this->connection, 
                    "DELETE FROM users WHERE id = '$data[id]'"
                );
                if ($query) {
                    if (isset($_SESSION['ID'])) {
                        if ($_SESSION['ID'] == $data["id"]) {
                            session_unset();
                            session_destroy();
                            echo "logout";
                        }
                    }
                }
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->errorMessage());
        }
    }
}