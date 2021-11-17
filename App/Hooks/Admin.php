<?php

namespace Hr\WpFRB\Hooks;

class Admin
{
    protected $admin_view;

    public function __construct()
    {
        $this->admin_view = new \Hr\WpFRB\Views\Admin\Admin();
        $this->wpfrb_register_admin_menu();
    }

    public function wpfrb_register_admin_menu()
    {
        add_action('admin_menu', [$this, 'wpfrb_add_admin_menu']);
    }

    public function wpfrb_add_admin_menu()
    {
        add_menu_page(
            __('Feature Request Board', 'feature-request-board'),
            'Request Feature',
            'manage_options',
            'feature-request',
            [$this, 'load_view'],
            'dashicons-text',
            65
        );
    }

    public function load_view()
    {
        $this->admin_view->wpfrb_admin_view_render();
    }
}