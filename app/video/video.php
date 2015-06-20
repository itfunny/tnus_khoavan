<?php

class VideoApp extends AppObject {

// <editor-fold defaultstate="collapsed" desc="Properties & construct">
    public $app_name = "video";
    public $dir_layout = "frontend"; // thư mục chứa các layout

    public function __construct() {
        parent::__construct();
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Code app">
    public function display() {
        $view = isset($_REQUEST['view']) ? $_REQUEST['view'] : "default";
        switch ($view) {
            case "default":
                $this->hienthi_default();
                break;
            case "chitiet":
                if (isset($_REQUEST['id'])) {
                    $this->hienthi_chitiet($_REQUEST['id']);
                } else {
                    $this->hienthi_default();
                }
                break;
            default:
                $this->hienthi_default();
                break;
        }
        $this->view = null;
        parent::display();
    }

    public function hienthi_chitiet($id) {
        $this->page_title = "MEDIA";
        $this->dir_layout = "frontend";
        $this->layout = "news";
        $this->view = "chitiet";
        $this->video = $this->get_video($id);
        $this->most_view_video = $this->get_most_views_video(array(62), 4);
        $this->arr_event = $this->get_content_by_cat_id(59, 5);
        parent::display();
    }

    public function hienthi_default() {
        $this->page_title = "MEDIA";
        $this->dir_layout = "frontend";
        $this->layout = "news";
        $this->view = "default";
        $this->lastest_video = $this->get_lastest_video(1);
        $this->most_view_video = $this->get_most_views_video(array(62), 4);
        $this->arr_event = $this->get_content_by_cat_id(59, 5);
        parent::display();
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Code xử lý chung">
    
    /**
     * Hàm trả lại số lượng view
     * @param string $table tên bảng. Ex: content
     * @param int $id id record
     * @param string $column tên cột views
     * @return int
     */
    public function get_views($table,$id,$column="views") {
        $db = new Database();
        $rs = $db->getValue($table, $column,array("id"=>$id));
        return $rs["views"];
    }
    /**
     * Hàm lấy mảng videos có số lượt xem (views) giảm dần
     * @param array $arr_cat_id Danh sách cat_id
     * @param int $num Số lượng video cần lấy
     * @return array Mảng video
     */
    public static function get_most_views_video($arr_cat_id, $num) {
        $db = new Database();
        $str_cat_id = implode(",", $arr_cat_id);
        $table = DB_TABLE_PREFIX . 'video';
        $sql = "  SELECT * FROM $table ";
        $sql .= " WHERE cat_id IN ($str_cat_id) ";
        $sql .= " ORDER BY `views` DESC ";
        $sql .= " LIMIT $num ";
        $arr_rs = $db->queryAll($sql);
        return $arr_rs;
    }

    /**
     * Hàm lấy mảng- content có số lượt xem (hits) giảm dần
     * @param array $arr_cat_id Danh sách cat_id
     * @param int $num Số lượng content cần lấy
     * @return array Mảng content
     */
    public static function get_content_by_cat_id($cat_id, $num) {
        $db = new Database();
        $table = DB_TABLE_PREFIX . 'content';
        $sql = "  SELECT *,`introtext` FROM $table ";
        $sql .= " WHERE cat_id = $cat_id ";
        $sql .= " ORDER BY id DESC ";
        $sql .= " LIMIT $num ";
        $arr_news = $db->queryAll($sql);
        return $arr_news;
    }

    /**
     * Hàm cắt văn bản ko mất từ, nối thêm dấu
     * @param string $input text to trim
     * @param int $length in characters to trim to
     * @param bool $ellipses if ellipses (...) are to be added
     * @param bool $strip_html if html tags are to be stripped
     * @return string 
     */
    public static function trim_text($input, $length, $ellipses = true, $strip_html = true) {
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }

        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }

        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...';
        }

        return $trimmed_text;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Code view default">
    /**
     * Hàm lấy danh sách video mới nhất
     * @param int $num số lượng video cần lấy ra
     * @return array
     */
    public function get_lastest_video($num) {
        $db = new Database();
        $table = DB_TABLE_PREFIX . "video";
        $sql = "   SELECT * FROM $table"
                . " ORDER BY id DESC LIMIT $num ";
        $arr_videos = $db->queryAll($sql);
        return $arr_videos[0];
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Code xử lý view chitiet">
    /**
     * Hàm lấy chi tiết video theo id
     * @param int $id
     * @return obj
     */
    public function get_video($id) {
        $db = new Database();
        $table = DB_TABLE_PREFIX . 'video';
        $sql = "  SELECT * FROM $table ";
        $sql .= " WHERE id = $id ";
        $arr_rs = $db->queryAll($sql);
        $this->update_views($id);
        return $arr_rs[0];
    }
    
    /**
     * Hàm cập nhật lượt xem (hits) của content
     * @param int $id
     * @return bôlean
     */
    public static function update_views($id) {
        $db = new Database();
        $table = DB_TABLE_PREFIX . 'video';
        $sql = "SELECT  `views` FROM $table WHERE id=$id";
        $rs = $db->query($sql);
        $views = $rs["views"] + 1;
        $sql = "  UPDATE $table SET `views`=$views";
        $sql .= " WHERE id = $id ";
        return $db->query($sql);
    }
// </editor-fold>

}

?>