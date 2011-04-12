<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once("include/db.php");
/**other variables */
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
        TesteDB::getInstance()->update_sms_mensagem($_POST["id"],$_POST["intervalo"]);
        header('Location: lista_sms_mensagem.php');
        exit;
  
 }


?>
