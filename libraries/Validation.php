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
class Validation {
    
    
    
    function clearData($text){
        $text=  strip_tags($text);
        $text=  stripcslashes($text);
        $text = trim($text);
        return $text;
    }
    
    
    function validPhone($phone){
        $valid_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
       $Nums = preg_replace("/[^0-9]/", '',  $valid_number);
        if (strlen($Nums) > 10)            return true;
        return false;
    }

}

?>
