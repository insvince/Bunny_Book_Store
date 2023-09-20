<?php

class AdminModel extends Model
{
    public function login($email, $password)
    {
        $response = array();
        $response["error"] = "";
        $response["msg"] = "";

        $sql = "SELECT * FROM `Users` WHERE `email` = '$email'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_object($result);
            if ($row->role == "Admin") {
                if (password_verify($password, $row->password)) {
                    $response["msg"] = $row;
                } else { 
                    $response["error"] = "Mật khẩu không đúng";
                }
            } else {
                $response["error"] = "Bạn không có đủ quyền hạn.";
            }
        } else {
            $response["error"] = "Tài khoản không tồn tại";
        }

        return $response;
    }

    public function get_admin($admin_id)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = '" . $admin_id . "'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0)
            return mysqli_fetch_object($result);
        else
            return null;
    }

    public function update_profile()
    {
        $email = $_POST["email"];
        $fullname = $_POST["name"];
        $bod = date("Y-m-d", strtotime($_POST["bod"]));
        $gender = $_POST["gender"];
        $tel = $_POST["tel"];
        $address = $_POST["address"];
        
        $admin = $this->get_admin($_SESSION["admin"]);

        $sql = "UPDATE `users` SET email='" . $email . "', fullname='" . $fullname . "', bod='" . $bod . "', gender='" . $gender . "', phone_number='" . $tel . "', address='" . $address . "' WHERE id = '" . $admin->id . "'";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "success",
            "message" => "Thông tin cá nhân đã được cập nhật"
        );
    }
    
    public function change_password()
    {
        $current_password = $_POST["current_password"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        $admin = $this->get_admin($_SESSION["admin"]);

        if (password_verify($current_password, $admin->password)) {
            if ($new_password == $confirm_password) {
                if ($new_password != $current_password) {
                    $sql = "UPDATE `users` SET password = '" . password_hash($new_password, PASSWORD_DEFAULT) . "' WHERE `id` = '" . $admin->id . "'";
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

}
