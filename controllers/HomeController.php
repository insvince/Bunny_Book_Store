<?php

class HomeController extends Controller
{
    public function index()
    {
        $categories = $this->load_model("CategoryModel")->get_all();
        $books = $this->load_model("BookModel")->get_all_for_home();
        $randoms = $this->load_model("BookModel")->get_random();
        
        if ($this->is_logged_in()) {
            $likes = $this->load_model("FavoriteModel")->get_own();
        }

        require_once VIEW . "layout/header.php";
        require_once VIEW . 'home.php';
        require_once VIEW . "layout/footer.php";
    }

    public function login()
    {
        if ($this->is_logged_in()) {
            header("Location: " . URL);
        } else {
            if ($_POST) {
                $token = $_POST["token"];
                if (Security::is_valid_token($token)) {
                    $model_response = $this->load_model("UserModel")->login();

                    $response["error"] = $model_response["error"];

                    if (empty($response["error"])) {
                        $_SESSION["user"] = $model_response["message"];
                        $_SESSION["login_success"] = $model_response["msg"];
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                    } else {
                        $_SESSION["login_error"] = $response["error"];
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                    }
                } else {
                    $_SESSION["login_error"] = "Token mismatch";
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                }
            }
        }
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    public function register()
    {
        if ($this->is_logged_in()) {
            header("Location: " . URL);
        } else {
            if ($_POST) {
                $token = $_POST["token"];

                if (Security::is_valid_token($token)) {
                    if ($this->load_model("UserModel")->is_exists($_POST["email"])) {
                        $_SESSION["login_error"] = "Tài khoản đã tồn tại";
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                    } elseif ($_POST["re-password"] != $_POST["password"]) {
                        $_SESSION["login_error"] = "Nhập lại mật khẩu không khớp.";
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                    } else {
                        $this->load_model("UserModel")->register();
                        $_SESSION["login_success"] = "Tài khoản đã được tạo.";
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                    }
                } else {
                    $_SESSION["login_error"] = "Token mismatch";
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                }
            }
        }
    }

    public function change_password()
    {
        if ($this->is_logged_in()) {
            $input = array();
            if ($_POST) {
                $token = $_POST["token"];

                if (Security::is_valid_token($token)) {
                    $response = $this->load_model("UserModel")->change_password();
                    if ($response["status"] == "success") {
                        $_SESSION["login_success"] = $response["message"];
                    } else {
                        $_SESSION["login_error"] = $response["message"];
                        $input = $_POST;
                    }
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                } else {
                    $_SESSION["login_error"] = "Token mismatch";
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                }
            }
        } else {
            header("Location: " . URL . "user/login");
        }
    }
}
