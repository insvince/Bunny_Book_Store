<?php
class FavoriteModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function like($book_id)
    {
        $user_id = $_SESSION["user"]->id;
        $sql = "INSERT INTO `favorites`(`user_id`,`book_id`) VALUES ('" . $user_id . "','" . $book_id . "')";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "success",
            "message" => "Đã thích sách này."
        );
    }

    public function unlike($book_id)
    {
        $user_id = $_SESSION["user"]->id;
        $sql = "DELETE FROM `favorites` WHERE user_id = $user_id AND book_id = $book_id";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "error",
            "message" => "Đã bỏ thích sách này."
        );
    }

    public function get_own()
    {
        $user_id = $_SESSION["user"]->id;
        $sql = "SELECT * FROM favorites WHERE user_id = $user_id";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }
}