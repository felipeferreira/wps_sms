<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once("include/db.php");
/**other variables */
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
        TesteDB::getInstance()->set_aloca_usuario_grupo($_POST["idgrupo"],$_POST["id_usuario"]);
        header('Location: aloca_sms_grupo_usuario.php?id='.$_POST["idgrupo"]);
        exit;
  
 }


?>
