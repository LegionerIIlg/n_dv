<?php

   /*
    * To change this template, choose Tools | Templates
    * and open the template in the editor.
    */

   /**
    * Description of words
    *
    * @author Администратор
    */
   class Logs {

       private $logFile = 'file_log.log';
       private $url = 'logs/';

       public function __construct() {
           $this->url = $_SERVER['DOCUMENT_ROOT'] . $this->url;
       }

       public function add_($what, $id, $last_data = null, $before_data = null) {
           $d = array(
               'id' => $id,
               'time' => date('d-m-Y H:i:s'),
               'user' => $_SESSION['user'],
               'what' => $what,
               'before_data' => $before_data,
               'last_data' => $last_data,
           );

           $data = array();

           if (file_exists($this->url . $this->logFile)) {
               $text = file_get_contents($this->url . $this->logFile);
               $data = json_decode($text, true);
           }

           $data[] = $d;

           $myfile = fopen($this->url . $this->logFile, "w+") or die("Unable to open file!");
           $txt = json_encode($data);
           fwrite($myfile, $txt);
           fclose($myfile);
       }

       public function read_all_() {
           if (!file_exists($this->url . $this->logFile)) {
               return false;
           }
           $text = file_get_contents($this->url . $this->logFile);
           $data = json_decode($text, true);
           return $data;
       }

       public function read_only_id_($id) {
           if (!file_exists($this->url . $this->logFile)) {
               return false;
           }
           $text = file_get_contents($this->url . $this->logFile);
           $data = json_decode($text, true);
           $table = array();

           foreach ($data as $kd => $vd) {
               if ($id == $vd['id']) {

                   $table[] = $vd;
               }
           }


           return $table;
       }
   }

?>
