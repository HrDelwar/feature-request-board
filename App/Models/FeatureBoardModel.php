<?php

namespace Hr\WpFRB\Models;

class FeatureBoardModel
{
    protected $_wpdb;
    protected $table;
    public function __construct()
    {
        global $wpdb;
        $this->_wpdb = $wpdb;
        $this->table= $wpdb->prefix.WPFRB_frb_board;
    }
    public function wpfrb_insert_feature_board($data)
    {
        return $this->_wpdb->insert($this->table,$data);
    }
    public function wpfrb_get_feature_board_by_id($id){
        return $this->_wpdb->get_row("SELECT * FROM $this->table WHERE id=$id");
    }
    public function wpfrb_get_all_board(){
        return $this->_wpdb->get_results("SELECT * FROM $this->table",ARRAY_A);
    }
}