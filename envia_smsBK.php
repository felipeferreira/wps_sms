 <?php
 require_once("include/db.php");
 include("classes/sms_usuario.php");
  include("classes/sms_mensagem.php");

 $result1 = TesteDB::getInstance()->get_mensagem_by_mensagem_id($_POST["id"]);
 $row = pg_fetch_array($result1);
 $id = $row["id"];
 $descricao = $row["descricao"];
 $valor = $row["valor"];
 $enviada = $row["enviada"];

 $result = TesteDB::getInstance()->get_usuarios();
 while($row = pg_fetch_array($result)) {
    $mobile = $row["telefone"];
    $msg = "WPS SMS Service =>";
    $msg=trim($msg).trim($descricao).":".trim($valor);
    #$msg="teste";
    $credencial="BF5646FD0B7E33C3E7F9E88197BBC12952762239";
    $usuariomaster = "MPGATEWAY";
    $msg = URLEncode($msg);
    echo $msg;
    $response = fopen("http://www.mpgateway.com/v_2_00/smspush/enviasms.aspx?Credencial=".$credencial."&Principal_User=".$usuariomaster."&Aux_User=USUAUX&Mobile=".$mobile."&Send_Project=N&Message=".$msg,"r");
    $status_code= fgets($response,4);
    
    if ($status_code==000)
        echo "Mensagem enviada com Sucesso!";
    else
       echo "Erro ao enviar mensage - Status code = ".$status_code;


}
?>

