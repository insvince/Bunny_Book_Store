<?php
class CategoryModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        $name = $_POST["name"];

        $sql = "INSERT INTO `categories`(`name`) VALUES ('" . $name . "')";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "success",
            "message" => "Danh mục đã được thêm"
        );
    }

    public function get_all()
    {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function get_per_page($page)
    {
        $per_page = 5;

        if ($page == "" || $page == 1 || $page == 0) {
            $page_1 = 0;
        } else {
            $page_1 = ($page * $per_page) - $per_page;
        }

        $sql = "SELECT * FROM categories";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        $count = ceil($count / $per_page);

        $sql = "SELECT * FROM categories ORDER BY name ASC LIMIT $page_1, $per_page";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function do_delete($category_id)
    {
        $sql = "DELETE FROM `categories` WHERE id = '" . $category_id . "'";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "error",
            "message" => "Danh mục đã được xóa"
        );
    }

    public function get($category_id)
    {
        $sql = "SELECT * FROM categories WHERE id = '" . $category_id . "'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_object($result);
        return $row;
    }

    public function edit($category_id)
    {
        $name = $_POST["name"];

        $sql = "UPDATE `categories` SET `name` = '" . $name . "' WHERE id = '" . $category_id . "'";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "success",
            "message" => "Thông tin danh mục đã được cập nhật"
        );
    }

    public function count_all()
    {
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        return $count;
    }
}
