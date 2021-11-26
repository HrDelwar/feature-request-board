<?php

namespace Hr\WpFRB\Hooks;

class Tables
{
  
  public function wpfrb_create_tables(){
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $wpfrb_users_table = $wpdb->prefix. 'users';

    // request board tabel
    $wpfrb_frb_board_table = $wpdb->prefix. WPFRB_frb_board;
    $sql_frb_board = "CREATE TABLE IF NOT EXISTS $wpfrb_frb_board_table (
      id int NOT NULL AUTO_INCREMENT,
      title text NOT NULL,
      logo text NOT NULL,
      sort_by text NOT NULL,
      creatorId bigint(20) unsigned,
      visibility text NOT NULL,
      FOREIGN KEY (creatorId) REFERENCES $wpfrb_users_table(id),
      PRIMARY KEY (id)
    ) $charset_collate;";

    // feature requests table 
    $wpfrb_request_list_table = $wpdb->prefix. WPFRB_frb_request_list;
    $sql_wpfrb_request_list ="CREATE TABLE IF NOT EXISTS $wpfrb_request_list_table (
      id INT NOT NULL AUTO_INCREMENT,
      author BIGINT(20) unsigned,
      board_id INT NOT NULL,
      title TEXT NOT NULL,
      description TEXT NOT NULL,
      logo TEXT NOT NULL,
      status TEXT NOT NULL,
      FOREIGN KEY (author) REFERENCES $wpfrb_users_table(id),
      FOREIGN KEY (board_id) REFERENCES $wpfrb_frb_board_table(id),
      PRIMARY KEY (id)
    ) $charset_collate";

    // request comment table
    $wpfrb_request_comment_table = $wpdb->prefix. WPFRB_request_comments;
    $sql_request_comment ="CREATE TABLE IF NOT EXISTS $wpfrb_request_comment_table (
      id INT NOT NULL AUTO_INCREMENT,
      user BIGINT(20) unsigned,
      request_id INT NOT NULL,
      text TEXT NOT NULL,
      FOREIGN KEY (user) REFERENCES $wpfrb_users_table(id),
      FOREIGN KEY (request_id) REFERENCES $wpfrb_request_list_table(id),
      PRIMARY KEY (id)
    ) $charset_collate";

    // request votes table
    $wpfrb_request_votes_table = $wpdb->prefix. WPFRB_request_votes;
    $sql_request_votes ="CREATE TABLE IF NOT EXISTS $wpfrb_request_votes_table (
      id INT NOT NULL AUTO_INCREMENT,
      user BIGINT(20) unsigned,
      request_id INT NOT NULL,
      FOREIGN KEY (user) REFERENCES $wpfrb_users_table(id),
      FOREIGN KEY (request_id) REFERENCES $wpfrb_request_list_table(id),
      PRIMARY KEY (id)
    ) $charset_collate";

     // comments reply  table
     $wpfrb_request_commetn_reply_table = $wpdb->prefix. WPFRB_request_comment_reply;
     $sql_request_comment_reply ="CREATE TABLE IF NOT EXISTS $wpfrb_request_commetn_reply_table (
       id INT NOT NULL AUTO_INCREMENT,
       user BIGINT(20) unsigned,
       comment_id INT NOT NULL,
       text TEXT NOT NULL,
       FOREIGN KEY (user) REFERENCES $wpfrb_users_table(id),
       FOREIGN KEY (comment_id) REFERENCES $wpfrb_request_comment_table(id),
       PRIMARY KEY (id)
     ) $charset_collate";

    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql_frb_board );
    dbDelta( $sql_wpfrb_request_list );
    dbDelta( $sql_request_comment );
    dbDelta( $sql_request_votes );
    dbDelta( $sql_request_comment_reply );
  }

}