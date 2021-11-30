<?php

namespace Hr\WpFRB\Models;

class FeatureListModel
{
    protected $_wpdb;
    protected $table;
    public function __construct()
    {
        global $wpdb;
        $this->_wpdb = $wpdb;
        $this->table= $wpdb->prefix.WPFRB_frb_request_list;
    }
    public function wpfrb_add_feature_req($data)
    {
        $result =  $this->_wpdb->insert($this->table,$data);
        if($result){
            return  $this->_wpdb->insert_id;
        }else{
            return false;
        }
    }
    public function wpfrb_get_feature_req_by_id($id){
        return $this->_wpdb->get_row("SELECT * FROM $this->table WHERE id=$id");
    }

    public function wpfrb_get_feature_req_by_board_id($id){
        return $this->_wpdb->get_results("SELECT * FROM $this->table WHERE board_id=$id", ARRAY_A);
    }
    public function wpfrb_get_all_feature_req(){
        return $this->_wpdb->get_results("SELECT * FROM $this->table", ARRAY_A);
    }
}