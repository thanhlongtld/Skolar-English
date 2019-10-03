<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/11/2019
 * Time: 5:09 PM
 */
require_once "configs/database.php";
class Model
{
    //khai báo các tham số dùng trong phân trang
    //tham số phân trang, dùng trong phân trang
    public $page;
    //số item trên mỗi page, dùng trong phân trang
    public $per_page = 10;
    public $startpoint;
    //param search từ form search
    public $querySearch;

    public function __construct()
    {
        //khởi tạo mặc định các biến của lớp cha Model, để các lớp con sử dụng khi kế thừa
        $this->page = (int)!isset($_GET['page']) ? 1 : $_GET['page'];
        if ($this->page < 0) $this->page = 1;
        $this->startpoint = ($this->page * $this->per_page) - $this->per_page;
        //set giá trị cho query_search, trong trường hợp có form search
        $this->querySearch = $this->getQuerySearch();
    }
    public function getQuerySearch()
    {
        //xử lý trường hợp nếu có tham số truyền lên từ form search
        $querySearch = ' WHERE TRUE';
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $querySearch .= " AND news.title LIKE '%{$_GET['title']}%'";
        }
        if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
            $querySearch .= " AND news.category_id = {$_GET['category_id']}";
        }
        if (isset($_GET['comment_total']) && !empty($_GET['comment_total'])) {
            $querySearch .= " AND news.comment_total = {$_GET['comment_total']}";
        }
        if (isset($_GET['like_total']) && !empty($_GET['like_total'])) {
            $querySearch .= " AND news.like_total = {$_GET['like_total']}";
        }

        return $querySearch;
    }

    public function openConnection(){
        $connection=mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME,DB_PORT);
        if (!$connection){
            die("Không thể kết nối! Lỗi: ".mysqli_connect_error());
        }
        mysqli_query($connection,"SET NAMES 'utf8'");
        return $connection;
    }
    public function closeConnection($connection){
        mysqli_close($connection);
    }
    public function getPagination($table)
    {
        $url = $_SERVER['REQUEST_URI'];
        if (!empty($_SERVER['QUERY_STRING'])) {
            $url .= '&';
        }

        $querySearch = self::getQuerySearch($_GET);
        //thực hiện truy vấn lấy ra toàn bộ tổng số bản ghi đang có trong tham số $table truyền vào
        $connection = $this->openConnection();
        //gắn thêm param search này vào câu truy vấn lấy tổng số bản ghi để phân trang
        $querySelect = "SELECT COUNT(*) as `num` FROM {$table} {$this->querySearch}";
        $results = mysqli_query($connection, $querySelect);
        $rowArr = mysqli_fetch_all($results, MYSQLI_ASSOC);
        $total = $rowArr[0]['num'];
        //sau khi có được tổng số bản ghi là $total, thực hiện tính toán logic đễ xử lý hiển thị phân trang
        $adjacents = "2";

        $prevlabel = "&lsaquo; Prev";
        $nextlabel = "Next &rsaquo;";
        $lastlabel = "Last &rsaquo;&rsaquo;";

        $this->page = ($this->page == 0 ? 1 : $this->page);
        $start = ($this->page - 1) * $this->per_page;

        $prev = $this->page - 1;
        $next = $this->page + 1;

        $lastpage = ceil($total / $this->per_page);

        $lpm1 = $lastpage - 1; // //last page minus 1

        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<ul class='pagination'>";
            $pagination .= "<li class='page_info'>Page {$this->page} of {$lastpage}</li>";

            if ($this->page > 1) $pagination .= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";

            if ($lastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $this->page)
                        $pagination .= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                }

            } elseif ($lastpage > 5 + ($adjacents * 2)) {

                if ($this->page < 1 + ($adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $this->page)
                            $pagination .= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                    $pagination .= "<li class='dot'>...</li>";
                    $pagination .= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination .= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";

                } elseif ($lastpage - ($adjacents * 2) > $this->page && $this->page > ($adjacents * 2)) {

                    $pagination .= "<li><a href='{$url}page=1'>1</a></li>";
                    $pagination .= "<li><a href='{$url}page=2'>2</a></li>";
                    $pagination .= "<li class='dot'>...</li>";
                    for ($counter = $this->page - $adjacents; $counter <= $this->page + $adjacents; $counter++) {
                        if ($counter == $this->page)
                            $pagination .= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                    $pagination .= "<li class='dot'>..</li>";
                    $pagination .= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination .= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";

                } else {

                    $pagination .= "<li><a href='{$url}page=1'>1</a></li>";
                    $pagination .= "<li><a href='{$url}page=2'>2</a></li>";
                    $pagination .= "<li class='dot'>..</li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $this->page)
                            $pagination .= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                }
            }

            if ($this->page < $counter - 1) {
                $pagination .= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
                $pagination .= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
            }

            $pagination .= "</ul>";
        }

        return $pagination;
    }
}