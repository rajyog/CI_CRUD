<?php
class Crud_model extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get_student_total() {
        $sql = "select * from tbl_student";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_student($limit, $start_from) {
        $sql = "select * from tbl_student limit $start_from, $limit ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
?>