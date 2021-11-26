<?php
namespace Hr\WpFRB\Controllers;

use Hr\WpFRB\Models\FeatureListModel;

class FeatureList{

    protected $model;
    public function __construct()
    {
        $this->model= new FeatureListModel();
    }

     // feature add 
     public function wpfrb_add_feature(){
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
       $data["author"] = get_current_user_id();
       $data["board_id"] = (int)sanitize_text_field($_POST['board']);
       $data["title"] = sanitize_text_field($_POST['title']) ?? '';
       $data["description"] = sanitize_text_field($_POST['description']) ?? '';
       $data["status"] = "public";

       $fileInfo = wp_check_filetype(basename($_FILES['logo']['name']));
       $data["logo"] = !empty($fileInfo['ext']) ? $_FILES['logo'] :'';
     
        // board data validation
        if (empty($data['title'])) {
           //title is empty
           $error = true;
           $errors['title'] = 'Request title is required.';
       }

       // board data validation
       if (empty($data['description'])) {
           //description is empty
           $error = true;
           $errors['description'] = 'Description is required.';
       }

       //logo upload handle
       if(!empty($data['logo'])){
           if ( ! function_exists( 'wp_handle_upload' ) ) {
               require_once( ABSPATH . 'wp-admin/includes/file.php' );
           }
           $uploadedfile = $data['logo'];

           $upload_overrides = array(
               'test_form' => false
           );
           $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
           
           if ( $movefile && ! isset( $movefile['error'] ) ) {
              $data["logo"] = $movefile['url'];
           } else {
               $error= true;
               $errors['logo'] = $movefile['error'];
           }
       }

       // check error and send response
       if ($error) {
           $error = false;
           wp_send_json_error($errors, 403);
           wp_die();
       }

       // handle add databese
       $result = $this->model->wpfrb_add_feature_req($data);
        if($result){
            $data = $this->model->wpfrb_get_feature_req_by_id($result);
            wp_send_json_success($data);
        }else{
            // insert faild
            wp_send_json_error(['error' => "Insert Faild"], 403);
        }
        wp_die();
   }
}