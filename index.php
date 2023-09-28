<?php

   define('ACSEPT', 'exist');

   session_start();

   require_once $_SERVER['DOCUMENT_ROOT'] . 'libraries/Sdjson.php';
   require_once $_SERVER['DOCUMENT_ROOT'] . 'libraries/Validation.php';
   require_once $_SERVER['DOCUMENT_ROOT'] . 'models/Base_model.php';
   require_once $_SERVER['DOCUMENT_ROOT'] . 'libraries/Logs.php';
   
   
   
   class MainThisClass {

       public function __construct() {
        ;
       }

       public function index() {

           if (!empty($_SESSION['user'])) {
               if (!empty($_GET['enter'])) {
                   return $this->get_enter();
               }

               return $this->get_main();
           }
           return $this->get_enter();
       }

       private function get_enter() {
           require_once $_SERVER['DOCUMENT_ROOT'] . 'controllers/Enter_controler.php';
           $ControllerEnter = new ControllerEnter();
           return $ControllerEnter->index();
       }

       private function get_main() {
           require_once $_SERVER['DOCUMENT_ROOT'] . 'controllers/Main_controler.php';
           $ControllerMain = new ControllerMain();
           return $ControllerMain->index();
       }
   }

   $mainThis = new  MainThisClass();
   $mainThis->index();
  
 
   
   
   
   
   
/*

Почему поля char, а не varchar? 

key - зарезервированое базой даных слово. Пока изменил. Нет в задании как его формировать
  (могу хешировать ( из даты время ввода + индентификкатор из этого вирезать 25 символов )
  
Сейчас сделал ввода изменеие по айди - могу потом переопредить по key. Но тода для быстроты работы в базе его надо индексировать. 
  
  
  updated_at  - почему поле не TimeStamp  тогда можно было-бы измение этого поля навесить на базу даных?
 
  FTP
  
 sceleton.ftp.tools:21
 
 login: sceleton_devsolpro  
 pass: Ck8u25K8vS
 
 * 
*/
   
   
   ?>

