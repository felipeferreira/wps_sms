<?php
require_once("include/db.php");
TesteDB::getInstance()->delete_sms_grupo_usuario ($_POST["id"]);
header('Location: lista_sms_grupo   _usuario.php' );
?>
