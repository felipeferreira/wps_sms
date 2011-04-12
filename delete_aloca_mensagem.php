<?php
require_once("include/db.php");
TesteDB::getInstance()->delete_aloca_mensagem($_POST["id2"]);
 header('Location: aloca_sms_grupo_usuario.php?id='.$_POST["idgrupo"]);
?>
