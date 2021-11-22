<?php

namespace Hr\WpFRB\Controllers;

use Hr\WpFRB\Models\FeatureBoardModel;

class FeatureBoard
{
    protected $model;
    public function __construct()
    {
        $this->model= new FeatureBoardModel();
    }
    public function wpfrb_create_feature_board()
    {
        //check nonce, if it fails return
        if (!wp_verify_nonce($_POST['nonce'], WPFRB_NONCE)) {
            wp_send_json([
                'success' => false,
                'status' => 403,
                'message' => 'Something wrong! Not a valid request.'
            ]);
            wp_die();
        }
        //error data
        $error = false;
        $errors = array();

        // get board data
        $data = array();
        $data['title'] = sanitize_text_field($_POST['title']);
        $data['sort_by'] = sanitize_text_field($_POST['sort_by']) ?? '';
        $data['visibility'] = sanitize_text_field($_POST['visibility']);
        $data['logo'] = sanitize_text_field($_POST['logo'])??'';


        // board data validation
        if (empty($data['title'])) {
            //title is empty
            $error = true;
            $errors['title'] = 'Board Title is required.';
        }

        // board data validation
        if (empty($data['visibility'])) {
            //visibility is empty
            $error = true;
            $errors['visibility'] = 'Visibility is required.';
        }

        // board data validation
        if (!empty($data['visibility']) && ($data['visibility'] !== 'public' && $data['visibility'] !== 'private')) {
            //not public or private
            $error = true;
            $errors['visibility'] = 'Visibility value should be ("public" or "private").';
        }
        
        // check error and send response
        if ($error) {
            wp_send_json_error($errors, 403);
            wp_die();
        }

        $data['creatorId'] = get_current_user_id();

        $result = $this->model->wpfrb_insert_feature_board($data);
        if($result){
            $data = $this->model->wpfrb_get_feature_board_by_id($result);
            wp_send_json_success($data, 200);
            wp_die();
        };
        wp_die();
    }
    public function wpfrb_get_all_feature_board(){
        //check nonce, if it fails return
        if (!wp_verify_nonce($_POST['nonce'], WPFRB_NONCE)) {
            wp_send_json([
                'success' => false,
                'status' => 403,
                'message' => 'Something wrong! Not a valid request.'
            ]);
            wp_die();
        }

        $result = $this->model->wpfrb_get_all_board();
        if(is_wp_error($result)){
            wp_send_json([
                'success' => false,
                'status' => 404,
                'message' => $result->get_error_message()
            ]);
            wp_die();
        }
        wp_send_json_success( $result, 200 ); 
        wp_die();
    }
}