<?php

namespace Hr\WpFRB\Hooks;

use \Hr\WpFRB\Views\Frontend\Frontend;

class Shortcode
{
    protected $frontend;

    public function __construct()
    {
        add_shortcode('wpfrb-board', [$this, 'wpfrb_feature_request_board']);
        $this->frontend = new Frontend();
    }

    public function wpfrb_feature_request_board($atts = [], $c = '', $tag = ''): string
    {
        global $wpdb;
        $atts = array_change_key_case((array) $atts, CASE_LOWER);
        $wpfrb_atts = shortcode_atts( 
            array(
                'id'    => ''
            ), $atts
        );

        if(!empty($wpfrb_atts['id'])){
            $board = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix.WPFRB_frb_board." WHERE id=".$wpfrb_atts['id']);
            global $current_user;
            global $wp;
            $c .= '<div class="wpfrb">';
                // header section
                $c .= '<header class="flex justify-between items-center">';
                    $c .= '<div class="header-left">';
                        if(!empty($board->logo)) {
                            $c .= '<img src="'.$board->logo.'" alt="">';
                        }
                        $c .= '<div class="header-left-content">';
                            if(!empty($board->title)) {
                                $c .= '<h1 ><a href="" class="text-2xl text-gray-700">'.esc_html($board->title).'</a></h1>';
                            }else{
                                $c .= '<h1 class="text-2xl text-gray-700"><a href="" class="text-2xl text-gray-700">'.esc_html('Feature Board').'</a></h1>';
                            }
                        $c .= '</div>';
                    $c .= '</div>';
                    $c.='<div>';
                        $c .= '<div class="header-right">';
                            $c .= '<ul>';
                                if(!is_user_logged_in(  )) {
                                    $c.='<div>';
                                        $c.='<button class="btn simple login menu">'.esc_html('Login', 'wpfrb').'</button>';
                                        $c.='<span>'.esc_html('/', 'wpfrb').'</span>';
                                        $c.='<button class="btn simple register menu">'.esc_html('Register', 'wpfrb').'</button>';
                                    $c.='</div>';
                                } else {
                                    $c .= '<li class="user-logout user-out">';
                                        $c .= '<a>';
                                            $c .= '<img width="32" height="32" src="'.get_avatar_url($current_user->ID).'"/> '.esc_html__('Hi, ', 'fluent-features-board').esc_html($current_user->display_name).' <span class="downicon"></span>';
                                        $c .= '</a>';
                                        $c .= '<div class="user-logout-dropdown">';
                                            $c .= '<a href="'.site_url( ).'/wp-admin/profile.php"><span class="user-icon"></span>'.esc_html__('Profile ', 'fluent-features-board').'</a>';
                                            $c .= '<a class="user-logout" href="'.wp_logout_url( add_query_arg( $wp->query_vars, home_url( $wp->request ) ) ).'">';
                                                $c .= '<span class="logout-power-icon"></span> '.esc_html__('Logout', 'fluent-features-board');
                                            $c .= '</a>';
                                        $c .= '</div>';
                                    $c .= '</li>';
                                }
                            $c .= '</ul>';
                        $c .= '</div>';
                    $c.="</div>";
                $c .= "</header>";
                
                // request feature section
                $c.='<section class="wpfrb-feature-section">';
                    $c.='<div class="frb-req-header">';
                        $c.='<button class="frb-req-add-button">'.esc_html__('New Feature Request','wpfrb').'</button>';
                        $c.='<input type="text"  name="frb_req_search_input" placeholder="'.esc_attr__('Search feature..','wpfrb').'" class="frb-req-search-input">';
                    $c.='</div>';
                    
                    // form section
                    $c.='<div id="frb-req-form-area" class="frb-req-form-area" style="display:none;">';
                        if(!is_user_logged_in()){
                            $c.='<div class="frb-req-not-login-section">';
                                $c.='<span>'.esc_html__('First Login to request feature.','wpfrb').'</span>';
                                $c.='<button class="btn simple login menu">'.esc_html('Login', 'wpfrb').'</button>';
                            $c.='</div>';
                        }else{
                            $c.=$this->frontend->wpfrb_request_form_view($board);
                        }
                    $c.='</div>';
                $c.="</section>";

                // login register form
                $c .= $this->frontend->wpfrb_register_form_view();
            $c .= "</div>";
        }
        return $c;
    }
}