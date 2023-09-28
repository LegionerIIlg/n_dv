<?php

 
if (!defined('ACSEPT'))
    exit('No direct script access allowed');

   
class  Base_model  {
    private $baseHost='sceleton.mysql.tools';
    private $baseName='sceleton_devsolpro';
    private $baseLogin='sceleton_devsolpro';
    private $basePassword=';J8bkT4c6@';
    private $mysqli = '';






    public function __construct() {
         mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

         $this->mysqli = new mysqli($this->baseHost, $this->baseLogin, $this->basePassword, $this->baseName);

/* Set the desired charset after establishing a connection */
$this->mysqli->set_charset('utf8mb4');

 //printf("Success... %s\n", $this->mysqli->host_info);
    }

   
    
    public function insert_new_($param) {
       
    $now_date = date('Y-m-d H:i:s');    
    
    $query = 'INSERT INTO Item (name, phone, keyt, created_at, updated_at) '
        . " VALUES ( '"
        .$this->mysqli->real_escape_string($param['name'])."', '"
        . $this->mysqli->real_escape_string($param['phone'])."', '"
        . $this->mysqli->real_escape_string($param['key'])."', "
        ." '$now_date', '$now_date');";
 
    
      $this->mysqli->query($query);
      return $this->mysqli->insert_id;   
     
        
    }

    public function update_($id,$param) {
        $id = intval($id);
         if($id<1){return false; };
       
             
         $query = 'UPDATE Item SET '
        ." name = '".$this->mysqli->real_escape_string($param['name'])."', "
        ." phone = '". $this->mysqli->real_escape_string($param['phone'])."', "
        ." keyt = '". $this->mysqli->real_escape_string($param['key'])."', "
        ." updated_at = '".$param['updated_at']."' WHERE id = $id;";
 
    
      $this->mysqli->query($query);
      return true;   
         
             
         
        
        
    }
    
    
     public function delete_($id) {
         
         $id = intval($id);
         if($id>0){
       $query = " DELETE From Item WHERE id = $id  LIMIT 1 ; ";
       $result =  $this->mysqli->query($query);
      return true;
         }
      return false;
       
        
    }
    
    public function get_table_() {
   
     $query = 'SELECT * From Item ORDER BY id DESC; ';
     $result =  $this->mysqli->query($query);
      return $result;   
    }


    
    public function get_one_($id) {
        
     $query = "SELECT * From Item WHERE id = $id   ORDER BY id DESC LIMIT 1; ";
     $result =  $this->mysqli->query($query);
     $data  = array();
     if(!empty($result))
     foreach ($result as  $v) {
     $data=$v;    
     }
     
      return $data;    
    }
    
    
    
    
    
    public function __destruct() {
       $this->mysqli->close();
    }
    
} 