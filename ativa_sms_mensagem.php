<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once("include/db.php");
/**other variables */
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
        TesteDB::getInstance()->set_ativa_sms_mensagem($_POST["id"],$_POST["ativa"]);
        header('Location: lista_sms_mensagem.php');
        exit;
  
 }


?>
