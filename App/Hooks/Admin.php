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
        global $wpdb;
        $capability = 'manage_options';
        $slug       = 'feature-request';

        $boards = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.WPFRB_frb_board);
        $requestLists = $wpdb->get_results(
            "SELECT * FROM ".$wpdb->prefix.WPFRB_frb_request_list
        );
        add_menu_page(
            __( 'Feature Request Boards <span class="items-number">'.count($boards).'</span>', 'feature-request-board' ), 
            __( 'Feature Request Boards <span class="items-number">'.count($boards).'</span>', 'feature-request-board' ), 
            $capability,
            $slug,
            [$this, 'load_view'],
            'dashicons-text',
            65
        );
        add_submenu_page( 
            $slug, 
            __('Features Request Lists <span class="items-number">'.count($requestLists).'</span>', 'fluent-features-board'), 
            __('Features Request Lists <span class="items-number">'.count($requestLists).'</span>', 'fluent-features-board'),
            $capability, 
            $slug.'#/feature-request-list',
            [$this, 'load_view']
        );
    }

    public function load_view()
    {
        $this->admin_view->wpfrb_admin_view_render();
    }
}