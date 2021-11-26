<?php

namespace Hr\WpFRB\Router;

use Hr\WpFRB\Controllers\FeatureBoard;
use Hr\WpFRB\Controllers\FeatureList;
use Hr\WpFRB\Controllers\User;

class Frontend
{
    protected $user;
    protected $feature_board;
    protected $feature_list;
    public function __construct()
    {
        $this->user = new User();
        $this->feature_board = new FeatureBoard();
        $this->feature_list = new FeatureList();
        $this->wpfrb_routes();
    }

    public function wpfrb_routes(){
        add_action('wp_ajax_nopriv_wpfrb_user_register', [$this->user, 'wpfrb_user_register']);
        add_action('wp_ajax_nopriv_wpfrb_user_login', [$this->user, 'wpfrb_user_login']);
        add_action('wp_ajax_wpfrb_add_feature', [$this->feature_list, 'wpfrb_add_feature']);
    }
}