<?php

namespace Hr\WpFRB\Views\Frontend;

class Frontend
{
    public function wpfrb_register_form_view(): string
    {
        $c = null;
        $c .= '<div class="wpfrb-popup-overlay wpfrb-login-register">';
            $c.='<div class="wpfrb-popup-content">';
                $c.='<button class="overlay-close">'.esc_html__('X','wpfrb').'</button>';
                $c.='<div class="wpfrb-login-register-inner">';
                    $c.='<div class="nav">';
                        $c.='<button class="tab btn login active">'.esc_html__('Login', 'wpfrb').'</button>';
                        $c.='<button class="tab btn  register">'.
                            esc_html__('Register', 'wpfrb')
                        .'</button>';
                    $c.='</div>';
                    $c.='<div class="wpfrb-login-register-body">';

                    //login form
                        $c.='<form class="active-form" id="wpfrb-login-form">';
                            $c.='<h2>'.esc_html__('Login', 'wpfrb').'</h2>';
                            $c.='<p class="wpfrb-from-msg-status login"></p>';
                            $c.='<div class="input-group">';
                                $c.='<label class="label-text" for="username">'.
                                   esc_html__('Username', 'wpfrb').
                                '</label>';
                                $c.='<input
                                    class="form-control"
                                    id="username"
                                    type="text"
                                    name="username"
                                    placeholder="'.esc_attr__('username', 'wpfrb').'">';
                            $c.='</div>';
                            $c.='<div class="input-group">';
                                $c.='<label class="label-text" for="username">'.
                                   esc_html__('Password', 'wpfrb').
                                '</label>';
                                $c.='<input
                                    class="form-control"
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder="'.esc_attr__('password', 'wpfrb').'">';

                            $c.='</div>';
                            $c.='<div class="input-group btn-box">';
                                $c.='<button id="wpfrb-login-submit" type="submit" class="btn login submit">'.
                                   esc_html__('Login', 'wpfrb').'</button>';
                            $c.='</div>';
                        $c.='</form>';

                        // register form
                        $c.='<form class="" id="wpfrb-register-form">';
                            $c.='<h2>'.esc_html__('Register', 'wpfrb').'</h2>';
                            $c.='<p class="wpfrb-from-msg-status register"></p>';
                            $c.='<div class="input-group">';
                            $c.='<label class="label-text" for="display_name">'.
                                esc_html__('Display Name', 'wpfrb').
                                '</label>';
                            $c.='<input      class="form-control"
                                                                                id="display_name"
                                                                                type="text"
                                                                                name="display_name"
                                                                                    placeholder="'.esc_attr__('Display name', 'wpfrb').'">';
                            $c.='</div>';
                            $c.='<div class="input-group">';
                                $c.='<label class="label-text" for="username">'.
                                    esc_html__('Username', 'wpfrb').
                                    '</label>';
                                $c.='<input      class="form-control"
                                                            id="username"
                                                            type="text"
                                                            name="username"
                                                                placeholder="'.esc_attr__('username', 'wpfrb').'">';
                            $c.='</div>';
                            $c.='<div class="input-group">';
                            $c.='<label class="label-text" for="email">'.
                                esc_html__('Email', 'wpfrb').
                                '</label>';
                            $c.='<input      class="form-control"
                                                                                id="email"
                                                                                type="text"
                                                                                name="email"
                                                                                    placeholder="'.esc_attr__('Enter email', 'wpfrb').'">';
                            $c.='</div>';
                            $c.='<div class="input-group">';
                                $c.='<label class="label-text" for="username">'.
                                    esc_html__('Password', 'wpfrb').
                                    '</label>';
                                $c.='<input
                                                            class="form-control"
                                                            id="password"
                                                            type="password"
                                                            name="password"
                                                            placeholder="'.esc_attr__('password', 'wpfrb').'">';

                            $c.='</div>';
                            $c.='<div class="input-group btn-box">';
                                $c.='<button id="wpfrb-register-submit" type="submit" class="btn register submit">'.
                                    esc_html__('Register', 'wpfrb').'</button>';
                            $c.='</div>';
                        $c.='</form>';

                    $c.='</div>';
                $c.='</div>';
            $c.='</div>';
        $c .= '</div>';
        return $c;
    }

    public function wpfrb_request_form_view($board):string
    {
        $c=null;
        $c.='<form id="wpfrb-add-feature-req-form" enctype="multipart/form-data">';
            $c.= '<h2>'.esc_html__('Suggest new feature', 'wpfrb').'</h2>';
            $c.='<p class="wpfrb-from-msg-status feature-req"></p>';
            $c.= '<div class="input-group">';
                $c.= '<input type="text" name="title" placeholder="'.esc_attr__('Title', 'wpfrb').'" >';
            $c.= '</div>';
            $c.= '<div class="input-group">';
                $c.= '<textarea rows="9" name="description" id="description" placeholder="'.esc_html__('Why do you want this', 'wpfrb').'" ></textarea>';
            $c.= '</div>';
            $c.='<div class="input-group">';
                $c.='<label for="logourl">'.esc_html__('Logo','wpfrb').'
                </label>';
                $c.='<div class="logowrap">';
                    $c.='<div class="logo-preview-wraper"></div>';
                    $c.='<span >'.esc_html__('Select Logo','wpfrb').'</span>';
                    $c.='<input class="frb-req-selcet-logo" name="logo" class="logourlinput" type="file">';
                $c.='</div>';
            $c.='</div>';
            $c.= '<input type="hidden" name="board" value="'.esc_attr($board->id).'" id="parent_board_id" />';
            $c.= '<div class="input-group">';
                $c.= '<button type="submit" class="btn">';
                    $c.= '<span class="loader"></span>'.esc_html__('Suggest Feature', 'wpfrb');
                $c.= '</button>';
            $c.= '</div>';
        $c.='</form>';

        return $c;
    }

    public function wpfrb_item_view($board, $item) : string
    {
        global $wpdb;
        global $current_user;
        $votes_table = $wpdb->prefix.WPFRB_request_votes;

        if(is_user_logged_in() && $current_user->roles[0] == 'administrator') {

            $is_administrator = 'administrator';
        } else {
            $is_administrator = '';
        }

        $c=null;

        $user_info = get_userdata($item->author);
        $status = strtolower(str_replace(' ', '-', $item->status));
        if($item->status == 'inprogress') {
            $status_text = __("In Progress", "wpfrb");
        } elseif($item->status == 'planned') {
            $status_text = __("Planned", "wpfrb");
        } elseif($item->status == 'closed') {
            $status_text = __("Closed", "wpfrb");
        } else {
            $status_text = __("Shipped", "wpfrb");
        }
        if($item->author == $current_user->ID) {
            $is_current_user_loggedin = __(' active', 'wpfrb');
        } else {
            $is_current_user_loggedin = '';
        }

        $checkUserVoted = $wpdb->get_results("SELECT * FROM $votes_table WHERE request_id=$item->id AND user=$current_user->ID");
        $c .= '<div class="wpfrb-request-item'.esc_attr($is_current_user_loggedin). ' '.esc_attr($is_administrator).'" data-name="'.esc_attr($item->title).'">';

            if($item->author == $current_user->ID ) {
                if($current_user->roles[0] == 'subscriber') {
                    $c .= '<span class="user-action"><a class="edit-feature-request" href="#" data-id="'.esc_attr($item->id).'">'.esc_html__('Edit', 'wpfrb').'</a>|<a id="delete-feature-request" href="#" data-id="'.esc_attr($item->id).'">'.esc_html__('Delete', 'wpfrb').'</a></span>';
                }
            }

            if(is_user_logged_in()) {
                $notLoggedin = ' ';
                if($checkUserVoted) {
                    $disabled = __(' removeVote ', 'wpfrb');
                } else {
                    $disabled = __(' addVote ', 'wpfrb');
                }
            } else {
                $notLoggedin = ' id="wpfrb-login-register-popup" ';
                $disabled = '';
            }
                $c .= '<div '.$notLoggedin.' class="wpfrb-request-vote '.esc_attr($disabled).'" data-postid="'.esc_attr($item->id).'">';
                    $c .= '<span class="wpfrb-request-vote-btn"></span>';
                    
                    $c .= '<input type="text" value="'.esc_attr('0').'" class="wpfrb-request-vote-count" readonly/>';
                $c .= '</div>';
            $c .= '<div class="wpfrb-request-content">';
                $c .= '<h3>';
                    $c .= esc_html($item->title);
                $c .= '</h3>';
                if($item->status) {
                    $c .= '<p class="status"><span class="'.esc_attr($status).'">'.esc_html($status_text).'</span></p>';
                }
                $c .= '<p class="description">'.esc_html($item->description).'</p>';

            $c .= '</div>';
            $c .= '<div class="wpfrb-request-comment-count">';
                $c .= '<span class="comment-icon"></span>';
                $c .= '<span class="comment-number" data-comments="'.esc_attr('0').'">'.esc_html('0').'</span>';
            $c .= '</div>';
        $c .= '</div>';

        return $c;
    }
}
