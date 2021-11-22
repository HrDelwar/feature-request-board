<?php

namespace Hr\WpFRB\Router;

use Hr\WpFRB\Controllers\FeatureBoard;

class Admin
{
    protected $featureBoard;
    public function __construct()
    {
        $this->featureBoard = new FeatureBoard();
        $this->wpfrb_admin_routes();
    }

    public function wpfrb_admin_routes(){
        add_action('wp_ajax_wpfrb_create_feature_board',[$this->featureBoard,'wpfrb_create_feature_board']);
        add_action('wp_ajax_wpfrb_get_all_feature_board',[$this->featureBoard,'wpfrb_get_all_feature_board']);
    }
}