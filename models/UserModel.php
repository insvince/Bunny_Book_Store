<?php
class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $fullname = $_POST["fullname"];
        $tel = $_POST["tel"];
        $address = $_POST["address"];
        $role = $_POST["role"];


        $sql = "INSERT INTO users(`email`, `password`, `fullname`, `address`, `tel`, `role`) VALUES ('$email', '$password', '$fullname', '$address', $tel, '$role')";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "success",
            "message" => "Người dùng đã được thêm"
        );
    }

    public function edit($user_id)
    {
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $fullname = $_POST["fullname"];
        $tel = $_POST["tel"];
        $address = $_POST["address"];
        $role = $_POST["role"];

        $sql = "UPDATE users SET email = '$email', password = '$password', fullname = '$fullname', address = '$address', tel = $tel, role='$role' WHERE id = $user_id";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "success",
            "message" => "Người dùng đã được sửa"
        );
    }

    public function is_exists($email)
    {
        $sql = "SELECT * FROM users WHERE `email` = '$email'";
        $result = mysqli_query($this->connection, $sql);

        return mysqli_num_rows($result) > 0;
    }

    public function register()
    {
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $fullname = $_POST["fullname"];
        $tel = $_POST["tel"];
        $address = $_POST["address"];

        $sql = "INSERT INTO users(`email`, `password`, `fullname`, `address`, `tel`, `role`) VALUES ('$email', '$password', '$fullname', '$address', $tel, 'User')";
        mysqli_query($this->connection, $sql);
    }

    public function login()
    {
        $response = array();
        $response["error"] = "";
        $response["msg"] = "";

        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE `email` = '$email'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_object($result);
            if ($row->role == "User") {
                if (password_verify($password, $row->password)) {
                    $response["message"] = $row;
                    $response["msg"] = "Đăng nhập thành công!";
                } else {
                    $response["error"] = "Mật khẩu không đúng";
                }
            } else {
                $response["error"] = "Bạn không thể đăng nhập vào trang này!";
            }
        } else {
            $response["error"] = "Tài khoản không tồn tại";
        }

        return $response;
    }

    public function get_all()
    {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function do_delete($user_id)
    {
        $sql = "DELETE FROM `users` WHERE id = '" . $user_id . "'";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "error",
            "message" => "Tài khoản đã được xóa"
        );
    }

    public function get($user_id)
    {
        $sql = "SELECT * FROM users WHERE id = '" . $user_id . "'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_object($result);
        return $row;
    }
    
    public function change_password()
    {
        $current_password = $_POST["current_password"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        $user = $this->get($_SESSION["user"]->id);

        if (password_verify($current_password, $user->password)) {
            if ($new_password == $confirm_password) {
                if ($new_password != $current_password) {
                    $sql = "UPDATE `users` SET password = '" . password_hash($new_password, PASSWORD_DEFAULT) . "' WHERE `id` = '" . $_SESSION["user"]->id . "'";
                    mysqli_query($this->connection, $sql);

                    return array(
                        "status" => "success",
                        "message" => "Mật khẩu đã được thay đổi."
                    );
                } else {
                    return array(
                        "status" => "error",
                        "message" => "Mật khẩu mới phải khác mật khẩu hiện tại."
                    );
                }
            } else {
                return array(
                    "status" => "error",
                    "message" => "Xác nhận mật khẩu không đúng."
                );
            }
        } else {
            return array(
                "status" => "error",
                "message" => "Mật khẩu hiện tại không đúng."
            );
        }
    }

    public function get_per_page($page)
    {
        $per_page = 5;

        if ($page == "" || $page == 1 || $page == 0) {
            $page_1 = 0;
        } else {
            $page_1 = ($page * $per_page) - $per_page;
        }

        $sql = "SELECT * FROM users";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        $count = ceil($count / $per_page);

        $sql = "SELECT * FROM users LIMIT $page_1, $per_page";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function count_all()
    {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($result);
        return $count;
    }
}
