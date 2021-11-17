<?php

namespace Hr\WpFRB\Hooks;

use \Hr\WpFRB\Views\Frontend\RegisterForm;

class Shortcode
{
    protected $register_form;

    public function __construct()
    {
        add_shortcode('wpfrb-feature-request-board', [$this, 'wpfrb_feature_request_board']);
        $this->register_form = new RegisterForm();
    }

    public function wpfrb_feature_request_board($attr = [], $c = '', $tag = ''): string
    {
        $c .= '<p>abc</p>';
        $c .= $this->register_form->wpfrb_register_form_view();
        return $c;
    }
}