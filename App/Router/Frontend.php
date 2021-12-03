<?php

namespace Hr\WpFRB\Router;

use Hr\WpFRB\Controllers\FeatureBoard;
use Hr\WpFRB\Controllers\FeatureList;
use Hr\WpFRB\Controllers\User;
use Hr\WpFRB\Controllers\Votes;

class Frontend
{
    protected $user;
    protected $feature_board;
    protected $feature_list;
    protected $votes_controller;
    public function __construct()
    {
        $this->user = new User();
        $this->feature_board = new FeatureBoard();
        $this->feature_list = new FeatureList();
        $this->votes_controller = new Votes();
        $this->wpfrb_routes();
    }

    public function wpfrb_routes(){
        add_action('wp_ajax_nopriv_wpfrb_user_register', [$this->user, 'wpfrb_user_register']);
        add_action('wp_ajax_nopriv_wpfrb_update_board_sort_by', [$this->feature_board, 'wpfrb_update_board_sort_by']);
        add_action('wp_ajax_wpfrb_update_board_sort_by', [$this->feature_board, 'wpfrb_update_board_sort_by']);
        add_action('wp_ajax_wpfrb_req_vote_handle', [$this->votes_controller, 'wpfrb_req_vote_handle']);
        add_action('wp_ajax_nopriv_wpfrb_user_login', [$this->user, 'wpfrb_user_login']);
        add_action('wp_ajax_wpfrb_add_feature', [$this->feature_list, 'wpfrb_add_feature']);
        add_action('wp_ajax_wpfrb_get_all_feature_list', [$this->feature_list, 'wpfrb_get_all_feature_list']);
        add_action('wp_ajax_wpfrb_all_request_by_board_id', [$this->feature_list, 'wpfrb_all_request_by_board_id']);
    }
}