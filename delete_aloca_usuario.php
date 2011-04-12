<?php
require_once("include/db.php");
TesteDB::getInstance()->delete_aloca_usuario($_POST["id_usuario"]);
 header('Location: aloca_sms_grupo_usuario.php?id='.$_POST["idgrupo"]);
?>
