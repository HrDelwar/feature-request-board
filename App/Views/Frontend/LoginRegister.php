<?php

namespace Hr\WpFRB\Views\Frontend;

class LoginRegister
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
                            $c.='<p class="wpfrb-msg-status"></p>';
                            $c.='<div class="input-group">';
                                $c.='<label class="label-text" for="username">'.
                                   esc_html__('Username', 'wpfrb').
                                '</label>';
                                $c.='<input
                                    class="form-control"
                                    id="username"
                                    type="text"
                                    name="name"
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
                            $c.='<p class="wpfrb-msg-status"></p>';
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
                                                            name="name"
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
}
