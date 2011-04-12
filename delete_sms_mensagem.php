<?php
require_once("include/db.php");
TesteDB::getInstance()->delete_sms_mensagem ($_POST["id"]);
header('Location: lista_sms_mensagem.php' );
?>
