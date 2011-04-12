<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once("include/db.php");
/**other variables */
$descricaoIsUnique = true;
$descricaoIsEmpty = false;


 if ($_SERVER["REQUEST_METHOD"] == "POST"){
    /** Check whether the user has filled in the wisher's name in the text field "user" */
    if ($_POST["desc"]==""){
        $descricaoIsEmpty = true;
    }

    /** Create database connection */
    $usuarioID = TesteDB::getInstance()->get_usuario_id_by_nome($_POST["desc"]);
    if ($grupo_usuarioID) {
        $descricaoIsUnique = false;
    }

    
    /** Check whether the boolean values show that the input data was validated successfully.
     * If the data was validated successfully, add it as a new entry in the "wishers" database.
     * After adding the new entry, close the connection and redirect the application to editWishList.php.
     */
    if (!$descricaoIsEmpty && $descricaoIsUnique ) {
        TesteDB::getInstance()->create_sms_grupo_usuario($_POST["desc"]);
        header('Location: lista_sms_grupo_usuario.php' );
        exit;
    }else {
       if (!$descricaoIsEmpty ) echo "Campo Descricao Precisa ser preenhcido!";
       if ($descricaoIsUnique ) echo "Nome ja existente!";
       
    }
}


?>
