<?php

namespace Hr\WpFRB\Models;

class VotesModel
{
    protected $_wpdb;
    protected $table;
    public function __construct()
    {
        global $wpdb;
        $this->_wpdb = $wpdb;
        $this->table= $wpdb->prefix.WPFRB_request_votes;
    }

    public function wpfrb_insert_votes($data)
    {
        $result =  $this->_wpdb->insert($this->table,$data);
        if($result){
            return  $this->_wpdb->insert_id;
        }else{
            return false;
        }
    }

    public function wpfrb_delete_votes($where){
        return $this->_wpdb->delete($this->table, $where);
    }
}