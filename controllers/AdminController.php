<?php

class AdminController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->header = ADMIN_VIEW . "header.php";
        $this->footer = ADMIN_VIEW . "footer.php";
    }

    public function index()
    {
        if ($this->is_admin_logged_in()) {
            header("Location: " . URL . "admin/dashboard");
        } else {
            $this->goto_admin_login();
        }
    }

    public function dashboard()
    {
        if ($this->is_admin_logged_in()) {
            require_once $this->get_header();
            require_once ADMIN_VIEW . 'dashboard.php';
            require_once $this->get_footer();
        } else {
            $this->goto_admin_login();
        }
    }

    public function login()
    {
        $error = "";
        $message = "";

        if ($_POST) {
            $token = $_POST["token"];

            if (Security::is_valid_token($token)) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $model_response = $this->load_model("AdminModel")->login($email, $password);
                $error = $model_response["error"];

                if (empty($error)) {
                    $admin_data = $model_response["msg"];
                    $_SESSION["admin"] = $admin_data->id;
                    header("Location: " . URL . "admin");
                }
            } else {
                $error = "Token mismatch";
            }

            require_once ADMIN_VIEW . 'login.php';
        } else {
            require_once ADMIN_VIEW . 'login.php';
        }
    }

    public function logout()
    {
        unset($_SESSION["admin"]);
        header("Location: " . URL . "admin");
    }

    public function category($page_type, $page = 1, $category_id = 0)
    {
        $error = "";
        $message = "";

        if ($this->is_admin_logged_in()) {

            if ($page_type == "add") {
                if ($_POST) {
                    $token = $_POST["token"];

                    if (Security::is_valid_token($token)) {
                        $response = $this->load_model("CategoryModel")->add();
                        if ($response["status"] == "success") {
                            $message = $response["message"];
                        } else {
                            $error = $response["message"];
                        }
                    } else {
                        $error = "Token mismatch";
                    }
                }
            }

            if ($page_type == "delete") {
                $response = $this->load_model("CategoryModel")->do_delete($category_id);
                if ($response["status"] == "success") {
                    $error = $response["message"];
                } else {
                    $error = $response["message"];
                }
            }

            if ($page_type == "edit") {
                if ($_POST) {
                    $token = $_POST["token"];

                    if (Security::is_valid_token($token)) {
                        $response = $this->load_model("CategoryModel")->edit($category_id);
                        if ($response["status"] == "success") {
                            $message = $response["message"];
                        } else {
                            $error = $response["message"];
                        }
                    } else {
                        $error = "Token mismatch";
                    }
                }

                $category = $this->load_model("CategoryModel")->get($category_id);

                require_once ADMIN_VIEW . "header.php";
                if ($category == null) {
                    require_once ADMIN_VIEW . '404.php';
                } else {
                    require_once ADMIN_VIEW . 'categories/edit.php';
                }
                require_once ADMIN_VIEW . "footer.php";
            } else {
                $categories = $this->load_model("CategoryModel")->get_per_page($page);
                $count = $this->load_model("CategoryModel")->count_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'categories/add.php';
                require_once ADMIN_VIEW . "footer.php";
            }
        } else {
            $this->goto_admin_login();
        }
    }

    public function book($page_type, $page = 1, $book_id = 0)
    {
        $error = "";
        $message = "";

        if ($this->is_admin_logged_in()) {

            if ($page_type == "add") {
                $input = array();

                if ($_POST) {
                    $token = $_POST["token"];

                    if (Security::is_valid_token($token)) {
                        $response = $this->load_model("BookModel")->add();

                        if ($response["status"] == "success") {

                            $message = $response["message"];
                        } else {
                            $input = $response["input"];
                            $error = $response["message"];
                        }
                    } else {
                        $error = "Token mismatch";
                    }
                }

                $categories = $this->load_model("CategoryModel")->get_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'books/add.php';
                require_once ADMIN_VIEW . "footer.php";
            }

            if ($page_type == "delete") {
                $this->load_model("BookModel")->do_delete($book_id);

                $error = "Đã xóa một cuốn sách.";
            }

            if ($page_type == "edit") {
                if ($_POST) {
                    $token = $_POST["token"];

                    if (Security::is_valid_token($token)) {
                        $response = $this->load_model("BookModel")->edit($book_id);
                        if ($response["status"] == "success") {
                            $message = $response["message"];
                        } else {
                            $error = $response["message"];
                        }
                    } else {
                        $error = "Token mismatch";
                    }
                }

                $data = $this->load_model("BookModel")->get($book_id);
                $categories = $this->load_model("CategoryModel")->get_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'books/edit.php';
                require_once ADMIN_VIEW . "footer.php";
            }

            if ($page_type == "all" || $page_type == "delete" || $page_type == "") {
                $books = $this->load_model("BookModel")->get_per_page($page, 5);
                $all_book = $this->load_model("BookModel")->count_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'books/all.php';
                require_once ADMIN_VIEW . "footer.php";
            }
        } else {
            $this->goto_admin_login();
        }
    }

    public function user($page_type, $page = 1, $user_id = 0)
    {
        $error = "";
        $message = "";

        if ($this->is_admin_logged_in()) {

            if ($page_type == "delete") {
                $this->load_model("UserModel")->do_delete($user_id);

                $error = "User has been deleted.";
            }

            if ($page_type == "add") {
                $input = array();

                if ($_POST) {
                    $token = $_POST["token"];

                    if (Security::is_valid_token($token)) {
                        if ($this->load_model("UserModel")->is_exists($_POST["email"])) {
                            $message = "Email đã tồn tại";
                        } else {
                            $response = $this->load_model("UserModel")->add();
                            if ($response["status"] == "success") {

                                $message = $response["message"];
                            } else {
                                $input = $response["input"];
                                $error = $response["message"];
                            }
                        }

                        
                    } else {
                        $error = "Token mismatch";
                    }
                }


                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'users/add.php';
                require_once ADMIN_VIEW . "footer.php";
            }

            if ($page_type == "edit") {
                $data = $this->load_model("UserModel")->get($user_id);
                if ($_POST) {
                    $token = $_POST["token"];

                    if (Security::is_valid_token($token)) {
                        if ($this->load_model("UserModel")->is_exists($_POST["email"]) && $_POST["email"] != $data->email) {
                            $message = "Email đã tồn tại";
                        } else {
                            $response = $this->load_model("UserModel")->edit($user_id);
                            if ($response["status"] == "success") {
                                $message = $response["message"];
                            } else {
                                $error = $response["message"];
                            }
                        }
                        
                    } else {
                        $error = "Token mismatch";
                    }
                }

                

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'users/edit.php';
                require_once ADMIN_VIEW . "footer.php";
            }


            if ($page_type == "all" || $page_type == "delete" || $page_type == "") {
                $users = $this->load_model("UserModel")->get_per_page($page);
                $all_users = $this->load_model("UserModel")->count_all();
                $admin = $this->get_logged_in_admin();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'users/all.php';
                require_once ADMIN_VIEW . "footer.php";
            }
        } else {
            $this->goto_admin_login();
        }
    }

    public function order($page_type, $page = 1, $order_id = 0)
    {
        $error = "";
        $message = "";

        if ($this->is_admin_logged_in()) {
            if ($page_type == "decline") {
                $this->load_model("OrderModel")->decline($order_id);

                $message = "Đã từ chối đơn hàng.";
            }

            if ($page_type == "receive") {
                $this->load_model("OrderModel")->receive($order_id);

                $message = "Đã nhận đơn hàng.";
            }

            if ($page_type == "all" || $page_type == "decline" || $page_type == "receive" || $page_type == "") {
                $orders = $this->load_model("OrderModel")->get_per_page($page);
                $all_orders = $this->load_model("OrderModel")->count_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'orders/all.php';
                require_once ADMIN_VIEW . "footer.php";
            }
        } else {
            $this->goto_admin_login();
        }
    }

    public function change_password()
    {
        if ($this->is_admin_logged_in()) {
            $input = array();
            if ($_POST) {
                $token = $_POST["token"];

                if (Security::is_valid_token($token)) {
                    $response = $this->load_model("AdminModel")->change_password();
                    if ($response["status"] == "success") {
                        $message = $response["message"];
                    } else {
                        $error = $response["message"];
                        $input = $_POST;
                    }
                } else {
                    $error = "Token mismatch";
                }
            }

            require_once ADMIN_VIEW . "header.php";
            require_once ADMIN_VIEW . 'change_password.php';
            require_once ADMIN_VIEW . "footer.php";
        } else {
            $this->goto_admin_login();
        }
    }
}
