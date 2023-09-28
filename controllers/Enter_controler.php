<?php

   if (!defined('ACSEPT'))
       exit('No direct script access allowed');
?>


<?php

   class ControllerEnter {

       private $user_one = array(
           'login' => 'admin',
           'password' => '1'
       );
       private $user_two = array(
           'login' => 'user',
           'password' => '2'
       );

       public function __construct() {
           
       }

       public function index() {
           $sendJson = new Sdjson();

           if (!empty($_GET['enter'])) {
               
               
               if ($_GET['enter'] === 'true') {

                   return $this->inner_in_();
               } elseif($_GET['enter'] === 'destroy'){
                 return $this->destroy_session_();  
                 
                 
               }else {
                   $sendJson->error_message = 'Ошиибка ввода данных!';
                   return $sendJson->send_form();
               }
           }

           return $this->view_enter_();
       }

       private function inner_in_() {
           $sendJson = new Sdjson();
           $validLib = new Validation();

           $login = '';
           if (!empty($_POST['login'])) {
               $login = $validLib->clearData($_POST['login']);
           }
           $passw = '';
           if (!empty($_POST['passw'])) {
               $passw = $validLib->clearData($_POST['passw']);
           }

           if (empty($login)) {
               $sendJson->error_message = 'Ошиибка ввода логина!';
               return $sendJson->send_form();
           }
           if (empty($passw)) {
               $sendJson->error_message = 'Ошиибка ввода пароля!';
               return $sendJson->send_form();
           }



           if ($this->user_one['login'] == $login || $this->user_one['password'] == $passw) {

               $_SESSION['user'] = $this->user_one['login'];
           }

           if ($this->user_two['login'] == $login || $this->user_two['password'] == $passw) {

               $_SESSION['user'] = $this->user_two['login'];
           }

           if (empty($_SESSION['user'])) {
               $sendJson->error_message = 'Отсутвует пользователь с такими параметрами!';
               return $sendJson->send_form();
           }
           
           
               $sendJson->success_message = 'Вы авторизованы!';
               return $sendJson->send_form();
       
           
           
       }

       private function view_enter_() {
           require_once $_SERVER['DOCUMENT_ROOT'] . 'view/Enter_view.php';
       }
       
       
       
         private function destroy_session_() {
             $_SESSION['user'] = '';
            
             $sendJson = new Sdjson(); 
             $sendJson->success_message = 'OK!';
               return $sendJson->send_form();
       }
   }
   