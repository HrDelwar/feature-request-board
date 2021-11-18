<?php

namespace Hr\WpFRB\Hooks;

use \Hr\WpFRB\Views\Frontend\LoginRegister;

class Shortcode
{
    protected $register_form;

    public function __construct()
    {
        add_shortcode('wpfrb-feature-request-board', [$this, 'wpfrb_feature_request_board']);
        $this->register_form = new LoginRegister();
    }

    public function wpfrb_feature_request_board($attr = [], $c = '', $tag = ''): string
    {
        // header section
        $c .= '<div class="wpfrb">';
            $c .= '<div class="flex justify-between items-center">';
                $c.='<h1 class="text-2xl text-gray-700">'.esc_html__('Feature Request Board', 'wpfrb').'</h1>';
                $c.='<div>';
                    if(is_user_logged_in()){
                        $c.='<button class="btn">'.esc_html('Profile', 'wpfrb').'</button>';
                    }else{
                        $c.='<div>';
                            $c.='<button class="btn simple login menu">'.esc_html('Login', 'wpfrb').'</button>';
                            $c.='<span>'.esc_html('/', 'wpfrb').'</span>';
                            $c.='<button class="btn simple register menu">'.esc_html('Register', 'wpfrb').'</button>';
                        $c.='</div>';
                    }
                $c.="</div>";
            $c .= "</div>";
        $c .= $this->register_form->wpfrb_register_form_view();
        $c .= "</div>";

        return $c;
    }
}