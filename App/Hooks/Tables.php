<?php

namespace Hr\WpFRB\Hooks;

class Tables
{
  
  public function wpfrb_create_tables(){
    global $wpdb;
    $wpfrb_frb_board_table = $wpdb->prefix. WPFRB_frb_board;
    $wpfrb_users = $wpdb->prefix. 'users';
    $charset_collate = $wpdb->get_charset_collate();

    $sql_frb_board = "CREATE TABLE IF NOT EXISTS $wpfrb_frb_board_table (
    id int NOT NULL AUTO_INCREMENT,
    title text NOT NULL,
    logo text NOT NULL,
    sort_by text NOT NULL,
    creatorId bigint(20) unsigned,
    visibility text NOT NULL,
    FOREIGN KEY (creatorId) REFERENCES $wpfrb_users(id),
    PRIMARY KEY (id)
        ) $charset_collate;";


    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql_frb_board );
  }

}