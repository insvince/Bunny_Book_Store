<?php
class OrderModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_per_page($page)
    {
        $per_page = 5;

        if ($page == "" || $page == 1 || $page == 0) {
            $page_1 = 0;
        } else {
            $page_1 = ($page * $per_page) - $per_page;
        }

        $sql = "SELECT * FROM orders";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        $count = ceil($count / $per_page);

        $sql = "SELECT *, orders.id AS order_id FROM orders 
                JOIN books ON orders.book_id = books.id JOIN users ON orders.user_id = users.id 
                ORDER BY orders.id ASC LIMIT $page_1, $per_page";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function count_all()
    {
        $sql = "SELECT * FROM orders";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        return $count;
    }

    public function buy($book_id, $stock)
    {
        $response = array();
        $response["error"] = "";
        $response["msg"] = "";
        $payment = $_POST["payment"];
        $amount = $_POST["amount"];
        $new_stock = $stock - $amount;

        if ($new_stock >= 0) {
            $user_id = $_SESSION["user"]->id;
            $order_at = date("Y-m-d H:i:s");

            $sql = "UPDATE books SET `stock` = '$new_stock' WHERE id = $book_id";
            mysqli_query($this->connection, $sql);

            $sql = "INSERT INTO `orders`(`user_id`, `book_id`, `amount`, `order_at`, `payment`) 
            VALUES ('" . $user_id . "', '" . $book_id . "', '" . $amount . "', '" . $order_at . "', '$payment')";
            mysqli_query($this->connection, $sql);

            $response["msg"] = "Mua thành công, hãy kiểm tra hòm thư của bạn!";
        } else {
            $response["error"] = "Không đủ số lượng, hãy chọn số lượng ít hơn";
        }
        return $response;
    }
}