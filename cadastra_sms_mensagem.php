<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once("include/db.php");
/**other variables */
$descricaoIsUnique = true;
$valorIsEmpty = false;

 if ($_SERVER["REQUEST_METHOD"] == "POST"){
    /** Check whether the user has filled in the wisher's name in the text field "user" */
    if ($_POST["descricao"]==""){
        $descricaoIsEmpty = true;
    }

    if ($_POST["sql"]==""){
        $sqlIsEmpty = true;
    }


    /** Create database connection */
    $mensagemID = TesteDB::getInstance()->get_mensagem_id_by_descricao($_POST["descricao"]);
    if ($mensagemID) {
        $descricaoIsUnique = false;
    }


    /** Check whether the boolean values show that the input data was validated successfully.
     * If the data was validated successfully, add it as a new entry in the "wishers" database.
     * After adding the new entry, close the connection and redirect the application to editWishList.php.
     */
    if (!$descricaoIsEmpty && $descricaoIsUnique && !$sqlIsEmpty  ) {
        TesteDB::getInstance()->create_sms_mensagem($_POST["descricao"],$_POST["intervalo_padrao"],$_POST["sql"]);
        header('Location: lista_sms_mensagem.php' );
        exit;
    }else {
       if (!$descricaoIsEmpty ) echo "Campo Descricao Precisa ser preenhcido!";
       if ($descricaoIsUnique ) echo "Descricao ja existente!";
       if (!$sqlIsEmpty ) echo "Campo SQL Precisa ser preenhcido!";
       
    }
}


?>
