<?php
require_once("include/db.php");
TesteDB::getInstance()->delete_sms_usuario ($_POST["id"]);
header('Location: lista_sms_usuario.php' );
?>
