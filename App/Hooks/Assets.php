<?php

namespace Hr\WpFRB\Hooks;

class Assets
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'register']);
        add_action('wp_enqueue_scripts', [$this, 'register'], 999);
    }

    public function register()
    {
        if (is_admin()) {
            $this->register_scripts($this->get_admin_scripts());
            wp_localize_script('wpfrb_admin_script','ajax_obj',array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce(WPFRB_NONCE)
            ));
        } else {
            $this->register_scripts($this->get_frontend_scripts());
            $this->register_styles($this->get_frontend_styles());
            wp_localize_script('wpfrb_frontend_script','ajax_obj',array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce(WPFRB_NONCE)
            ));
        }
    }

    public function register_scripts($scripts)
    {
        foreach ($scripts as $handle => $script) {
            $deps = $script['deps'] ?? false;
            $in_footer = $script['in_footer'] ?? false;
            $version = $script['version'] ?? WPFRB_VERSION;
            wp_enqueue_script($handle, $script['src'], $deps, $version, $in_footer);
        }
    }


    // register styles
    public function register_styles($styles)
    {
        foreach ($styles as $handle => $style) {
            $deps = $style['deps'] ?? false;
            $version = $style['version'] ?? WPFRB_VERSION;

            wp_enqueue_style($handle, $style['src'], $deps, $version);
        }
    }

    public function get_frontend_scripts():array
    {
        return [
            'wpfrb_frontend_script' => [
                'src' => WPFRB_ASSETS . '/frontend/js/wpfrb-frontend.js',
                'deps' => ['jquery'],
                'version' => time(),
                'in_footer' => true
            ]
        ];
    }

    public function get_admin_scripts(): array
    {
        return [
            'wpfrb_admin_script' => [
                'src' => WPFRB_ASSETS . '/admin/js/main.js',
                'deps' => ['jquery'],
                'version' => time(),
                'in_footer' => true
            ]
        ];
    }

    public function get_frontend_styles(): array
    {
        return [
            'wpfrb_frontend_style' => [
                'src' => WPFRB_ASSETS . '/frontend/css/wpfrb-frontend.css',
                'version' => time(),
            ]
        ];
    }
}