<?php

   if (!defined('ACSEPT'))
       exit('No direct script access allowed');
?>


<?php

   class ControllerMain {

       private $senJson = '';
       private $validLib = '';
       private $db = '';
       private $log = '';

       public function __construct() {
           $this->sendJson = new Sdjson();
           $this->validLib = new Validation();
           $this->db = new Base_model();
           $this->log = new Logs();
       }

       public function index() {

           if (!empty($_GET['mainurl'])) {
               if ($_GET['mainurl'] == 'addnew') {

                   return $this->addnew_();
               } elseif ($_GET['mainurl'] == 'change') {

                   return $this->change_();
               } elseif ($_GET['mainurl'] == 'savechange') {
                   return $this->savechange_();
               } elseif ($_GET['mainurl'] == 'destroy') {
                   return $this->destroy_();
               } elseif ($_GET['mainurl'] == 'gettable') {
                   return $this->get_table_();
               } 
               
             elseif ($_GET['mainurl'] == 'logviewone') {
                   return $this->get_logviewone_();
               }   
               
               else {
                   return $this->view_main_();
               }
           }


           return $this->view_main_();
       }

       private function addnew_() {
           $name = '';
           $phone = '';
           $key = '';

           if (!empty($_POST['name'])) {
               $name = $this->validLib->clearData($_POST['name']);
           }
           if (empty($name) or strlen($name) > 255) {
               $this->sendJson->error_message = 'Ошиибка ввода name!';
               return $this->sendJson->send_form();
           }
           if (!empty($_POST['phone'])) {
               $phone = filter_var($this->validLib->clearData($_POST['phone']), FILTER_SANITIZE_NUMBER_INT);
           }
           if (empty($phone) or strlen($phone) > 15 or $this->validLib->validPhone($phone) == false) {
               $this->sendJson->error_message = 'Ошиибка ввода phone!';
               return $this->sendJson->send_form();
           }


           if (!empty($_POST['key'])) {
               $key = $this->validLib->clearData($_POST['key']);
           }
           if (empty($key) or strlen($phone) > 25) {
               $this->sendJson->error_message = 'Ошиибка ввода key!';
               return $this->sendJson->send_form();
           }


           $d = array();
           $d['name'] = $name;
           $d['phone'] = $phone;
           $d['key'] = $key;

           
           
           
           $id = $this->db->insert_new_($d);

           if (!empty($id)) {
               $this->sendJson->success_message = 'Запись добавлено!';
           } else {
               $this->sendJson->error_message = 'Что-то пошло не так!';
           }

           $this->log->add_('new',$id,$d);
           
           return $this->sendJson->send_form();
       }

       private function change_() {
           $id = '';

           if (!empty($_GET['record'])) {
               $id = intval($this->validLib->clearData($_GET['record']));
           }

           if (empty($id)) {
               $this->sendJson->error_message = 'Ошиибка идентификатора!';
               return $this->sendJson->send_form();
           }

           $row = $this->db->get_one_($id);

           if (empty($row)) {
               $this->sendJson->error_message = 'Запись отсутвует в базе!';
               return $this->sendJson->send_form();
           }





           $this->sendJson->data = $row;

           return $this->sendJson->send_form();
       }

       
      private function  get_logviewone_(){
          if (!empty($_GET['record'])) {
               $id = intval($this->validLib->clearData($_GET['record']));
           }

           if (empty($id)) {
               $this->sendJson->error_message = 'Ошиибка идентификатора!';
               return $this->sendJson->send_form();
           }

           $row = $this->db->get_one_($id);

           if (empty($row)) {
               $this->sendJson->error_message = 'Запись отсутвует в базе!';
               return $this->sendJson->send_form();
           }
          
          $data_logs =  $this->log->read_only_id_($id);
          
           ob_start();
        
           print_r($data_logs);
           
           require_once $_SERVER['DOCUMENT_ROOT'] . 'view/tmpl/Logsbody_view.php';
          
           $pngString = ob_get_contents();
           ob_end_clean();
          
          $this->sendJson->html = $pngString;
               return $this->sendJson->send_form();
      }
       
       
       private function savechange_() {

           $id = '';

           if (!empty($_POST['record'])) {
               $id = intval($this->validLib->clearData($_POST['record']));
           }

           if (empty($id)) {
               $this->sendJson->error_message = 'Ошиибка идентификатора!';
               return $this->sendJson->send_form();
           }

           $row = $this->db->get_one_($id);

           if (empty($row)) {
               $this->sendJson->error_message = 'Запись отсутвует в базе!';
               return $this->sendJson->send_form();
           }



           $name = '';
           $phone = '';
           $key = '';

           if (!empty($_POST['name'])) {
               $name = $this->validLib->clearData($_POST['name']);
           }
           if (empty($name) or strlen($name) > 255) {
               $this->sendJson->error_message = 'Ошиибка ввода name!';
               return $this->sendJson->send_form();
           }
           if (!empty($_POST['phone'])) {
               $phone = filter_var($this->validLib->clearData($_POST['phone']), FILTER_SANITIZE_NUMBER_INT);
           }
           if (empty($phone) or strlen($phone) > 15 or $this->validLib->validPhone($phone) == false) {
               $this->sendJson->error_message = 'Ошиибка ввода phone!';
               return $this->sendJson->send_form();
           }


           if (!empty($_POST['key'])) {
               $key = $this->validLib->clearData($_POST['key']);
           }
           if (empty($key) or strlen($phone) > 25) {
               $this->sendJson->error_message = 'Ошиибка ввода key!';
               return $this->sendJson->send_form();
           }


           $d = array();
           $d['name'] = $name;
           $d['phone'] = $phone;
           $d['key'] = $key;
           $d['updated_at'] = date('Y-m-d H:i:s');
            $this->db->update_($id, $d);

            
           
            
            $this->log->add_('change',$id,$d, $row);
            
            
           $this->sendJson->success_message = 'Запись изменена!';
           return $this->sendJson->send_form();
       }

       private function destroy_() {
           $id = '';

           if (!empty($_GET['record'])) {
               $id = intval($this->validLib->clearData($_GET['record']));
           }

           if (empty($id)) {
               $this->sendJson->error_message = 'Ошиибка идентификатора!';
               return $this->sendJson->send_form();
           }

           $row = $this->db->get_one_($id);

           if (empty($row)) {
               $this->sendJson->error_message = 'Запись отсутвует в базе!';
               return $this->sendJson->send_form();
           }

           
           
           
           $this->db->delete_($id);
           $this->sendJson->success_message = 'Запись удалена!';

           $this->log->add_('destroy',$id,'', $row);
           
           return $this->sendJson->send_form();
       }

       private function view_main_() {


           $login = $_SESSION['user'];
           $table_body = $this->db->get_table_();
           ob_start();
           require_once $_SERVER['DOCUMENT_ROOT'] . 'view/Main_view.php';
           $pngString = ob_get_contents();
           ob_end_clean();

           echo $pngString;
       }

       private function get_table_() {


           $login = $_SESSION['user'];
           $table_body = $this->db->get_table_();
           ob_start();
           require_once $_SERVER['DOCUMENT_ROOT'] . 'view/tmpl/Tbody_view.php';
           $pngString = ob_get_contents();
           ob_end_clean();

           $this->sendJson->html = $pngString;
           return $this->sendJson->send_form();
       }
   }
   