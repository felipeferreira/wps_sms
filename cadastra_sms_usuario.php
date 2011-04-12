<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once("include/db.php");
/**other variables */
$nomeIsUnique = true;
$nomeIsEmpty = false;
$telefoneIsEmpty = false;

 if ($_SERVER["REQUEST_METHOD"] == "POST"){
    /** Check whether the user has filled in the wisher's name in the text field "user" */
    if ($_POST["nome"]==""){
        $nomeIsEmpty = true;
    }

    /** Create database connection */
    $usuarioID = TesteDB::getInstance()->get_usuario_id_by_nome($_POST["nome"]);
    if ($usuarioID) {
        $nomeIsUnique = false;
    }

    /** Check whether a password was entered and confirmed correctly */
    if ($_POST["telefone"]=="")
    $telefoneIsEmpty = true;


    /** Check whether the boolean values show that the input data was validated successfully.
     * If the data was validated successfully, add it as a new entry in the "wishers" database.
     * After adding the new entry, close the connection and redirect the application to editWishList.php.
     */
    if (!$nomeIsEmpty && $nomeIsUnique && !$telefoneIsEmpty ) {
        TesteDB::getInstance()->create_sms_usuario($_POST["nome"], $_POST["telefone"]);
        header('Location: lista_sms_usuario.php' );
        exit;
    }else {
       if (!$nomeIsEmpty ) echo "Campo Nome Precisa ser preenhcido!";
       if ($nomeIsUnique ) echo "Nome ja existente!";
       if (!$telefoneIsEmpty ) echo "Campo Telefone Precisa ser preenhcido!";
       
    }
}


?>
