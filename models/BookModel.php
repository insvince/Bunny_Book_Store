<?php
class BookModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $stock = $_POST["stock"];
        $price = $_POST["price"];
        $author = $_POST["author"];
        $image = $_FILES["image"];


        if ($image["error"] != 0) {
            return array(
                "status" => "error",
                "message" => "Hãy chọn một ảnh.",
                "input" => $_POST
            );
        }

        $image_info = getimagesize($image['tmp_name']);
        if ($image_info == false) {
            return array(
                "status" => "error",
                "message" => "Hãy chọn đúng định dạng của ảnh.",
                "input" => $_POST
            );
        }

        $image_name = time() . "-" . $image["name"];


        $sql = "INSERT INTO `books`(`category_id`,`title`,`description`,`stock`,`price`,`author`,`image`) 
                VALUES ('" . $category . "','" . $title . "','" . $description . "','" . $stock . "','" . $price . "','" . $author . "','" . $image_name . "')";
        mysqli_query($this->connection, $sql);

        $file_path = "uploads/" . $image_name;
        move_uploaded_file($image["tmp_name"], $file_path);

        return array(
            "status" => "success",
            "message" => "Sách đã được thêm"
        );
    }

    public function get_all()
    {
        $sql = "SELECT * FROM books ORDER BY id ASC";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function get_per_page($page, $per_page)
    {
        if ($page == "" || $page == 1 || $page == 0) {
            $page_1 = 0;
        } else {
            $page_1 = ($page * $per_page) - $per_page;
        }

        $sql = "SELECT * FROM books";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        $count = ceil($count / $per_page);

        $sql = "SELECT *,books.id as book_id FROM books JOIN categories WHERE books.category_id = categories.id LIMIT $page_1, $per_page";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function do_delete($book_id)
    {
        $sql = "DELETE FROM `books` WHERE id = '" . $book_id . "'";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "error",
            "message" => "Sách đã được xóa"
        );
    }

    public function get($book_id)
    {
        $sql = "SELECT * FROM books WHERE id = '" . $book_id . "'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_object($result);
        return $row;
    }

    public function edit($book_id)
    {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $stock = $_POST["stock"];
        $price = $_POST["price"];
        $author = $_POST["author"];
        $image = $_FILES["image"];


        if ($image["error"] != 0) {
            return array(
                "status" => "error",
                "message" => "Hãy chọn một ảnh.",
                "input" => $_POST
            );
        }

        $image_info = getimagesize($image['tmp_name']);
        if ($image_info == false) {
            return array(
                "status" => "error",
                "message" => "Hãy chọn đúng định dạng của ảnh.",
                "input" => $_POST
            );
        }

        $image_name = time() . "-" . $image["name"];

        $sql = "UPDATE `books` SET category_id = '$category', title = '$title', description  = '$description', stock = '$stock', price = '$price', author = '$author', image = '$image_name'
                WHERE id = '" . $book_id . "'";
        mysqli_query($this->connection, $sql);

        $file_path = "uploads/" . $image_name;
        move_uploaded_file($image["tmp_name"], $file_path);

        return array(
            "status" => "success",
            "message" => "Thông tin Sách đã được cập nhật"
        );
    }

    public function count_all()
    {
        $sql = "SELECT * FROM books";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        return $count;
    }

    public function get_all_for_home()
    {
        $sql = "SELECT * FROM books ORDER BY id DESC LIMIT 8";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function get_random()
    {
        $sql = "SELECT *,books.id as book_id
                FROM books ORDER BY RAND() DESC LIMIT 5";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }
    
    public function get_related($category_id)
    {
        $sql = "SELECT * FROM books WHERE category_id = $category_id ORDER BY RAND() DESC LIMIT 4";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function get_by_category($category_id, $page, $per_page)
    {
        if ($page == "" || $page == 1 || $page == 0) {
            $page_1 = 0;
        } else {
            $page_1 = ($page * $per_page) - $per_page;
        }

        $sql = "SELECT * FROM books";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        $count = ceil($count / $per_page);

        $sql = "SELECT *,books.id as book_id FROM books JOIN categories WHERE books.category_id = categories.id AND books.category_id = $category_id LIMIT $page_1, $per_page";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function count_all_by_category($category_id)
    {
        $sql = "SELECT * FROM books WHERE books.category_id = $category_id";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        return $count;
    }
}
