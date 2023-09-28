<?php
if (!defined('ACSEPT'))
    exit('No direct script access allowed');

class Sdjson {
     public $error_message;
    public $success_message;
    public $html;
    public $data;

    public function __construct() {
      
    }
    

    public function send_form() {
        $d = array();
        if (!empty($this->error_message)){
        header('500','Internal Server Error');
        header("HTTP/1.0 500 Internal Server Error");
        header("HTTP/1.1 500 Internal Server Error");
            
        $d['error'] = $this->error_message;}
        if (!empty($this->success_message))
            $d['success'] = $this->success_message;
        if (!empty($this->html))
            $d['html'] = $this->html;

        if (!empty($this->data))
            $d['danue'] = $this->data;

        header('Content-Type: application/json');
        echo json_encode($d);
      
    }
    
    public function send_pre($array_in){
        
        echo '<pre>';
        print_r($array_in);
        echo '</pre>';
        
    }
    
    
}




