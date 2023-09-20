<?php

class BookController extends Controller
{
    public function index()
    {
        header("Location: " . URL . "product/all");
    }

    public function detail($book_id)
    {
        $categories = $this->load_model("CategoryModel")->get_all();
        $book = $this->load_model("BookModel")->get($book_id);
        $relateds = $this->load_model("BookModel")->get_related($book->category_id);
        

        require_once VIEW . "layout/header.php";
        require_once VIEW . 'books/detail.php';
        require_once VIEW . "layout/footer.php";
    }

    public function all($page = 1)
    {
        $categories = $this->load_model("CategoryModel")->get_all();
        $books = $this->load_model("BookModel")->get_per_page($page, 12);
        $all_books = $this->load_model("BookModel")->count_all();
        if ($this->is_logged_in()) {
            $likes = $this->load_model("FavoriteModel")->get_own();
        }

        require_once VIEW . "layout/header.php";
        require_once VIEW . 'books/all.php';
        require_once VIEW . "layout/footer.php";
    }

    public function category($category_id, $page = 1)
    {
        $categories = $this->load_model("CategoryModel")->get_all();
        $books = $this->load_model("BookModel")->get_by_category($category_id, $page, 12);
        $all_books = $this->load_model("BookModel")->count_all_by_category($category_id);
        if ($this->is_logged_in()) {
            $likes = $this->load_model("FavoriteModel")->get_own();
        }

        require_once VIEW . "layout/header.php";
        require_once VIEW . 'books/category.php';
        require_once VIEW . "layout/footer.php";
    }

    public function buy($book_id)
    {
        if ($this->is_logged_in()) {
            if ($_POST) {
                $book = $this->load_model("BookModel")->get($book_id);
                $categories = $this->load_model("CategoryModel")->get_all();

                $response = $this->load_model("OrderModel")->buy($book_id, $book->stock);
                if (empty($response["error"])) {
                    $_SESSION["login_success"] = $response["msg"];
                } else {
                    $_SESSION["login_error"] = $response["error"];
                }

                $this->send_mail($this->user->email, $book->title, $_POST["amount"], $book->price);

                header("Location: " . URL . "book/detail/" . $book_id);
            } else {
                header("Location: " . URL . "book/detail/" . $book_id);
            }
        } else {
            $_SESSION["login_error"] = "Hãy đăng nhập để tiếp tục mua sản phẩm.";
            header("Location: " . URL . "book/detail/" . $book_id);
        }
    }
    public function like($book_id)
    {
        if ($this->is_logged_in()) {
            $response = $this->load_model("FavoriteModel")->like($book_id);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
            $_SESSION["login_error"] = "Hãy đăng nhập để thích sản phẩm này.";
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function unlike($book_id)
    {
        if ($this->is_logged_in()) {
            $response = $this->load_model("FavoriteModel")->unlike($book_id);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
            $_SESSION["login_error"] = "Hãy đăng nhập để thích sản phẩm này.";
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
}
