<?php

namespace Hr\WpFRB\Router;

use Hr\WpFRB\Controllers\User;

class Frontend
{
    protected $user;
    public function __construct()
    {
        $this->user = new User();
        $this->wpfrb_routes();
    }

    public function wpfrb_routes(){
        add_action('wp_ajax_nopriv_wpfrb_user_register', [$this->user, 'wpfrb_user_register']);
        add_action('wp_ajax_nopriv_wpfrb_user_login', [$this->user, 'wpfrb_user_login']);
    }
}