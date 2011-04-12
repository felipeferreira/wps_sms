 <?php
 require_once("include/db.php");
 include("classes/sms_usuario.php");
  include("classes/sms_mensagem.php");

 //Obtem as mensagens do Banco
  $result2 = TesteDB::getInstance()->get_mensagens_ativas();

 //While para verificar se o intervalo atual de cada mensagem é igual ao intervalo padrao
  while($row2=pg_fetch_array($result2)) {
      $id = $row2["id"];
      echo "ID:".$id;
      $descricao = $row2["descricao"];
      echo "DESC:".$descricao;
      $ativa = $row2["ativa"];
      $intervalo_padrao = $row2["intervalo_padrao"];
      $sql = $row2["sql"];
    //Se o intervalo for igual, verifica que estah alocado para receber a mensagem
     if(TesteDB::getInstance()->verifica_mensagem_para_envio($id)=='true') {
         $sql = trim($sql);
         $result = pg_query($sql);
         $row = pg_fetch_array($result);
         $valor = $row["valor"];
         $valor = trim($valor);
         $descricao =  trim($descricao);
         $msg = "** NOVA AMERICA **   ".$descricao.":".$valor;
         $msg = trim($msg);
         #echo "MENSAGEM ANTES DE PASSAR PARA FUNCAO:".$msg ;
         $msg = trim($msg);
         $result = TesteDB::getInstance()->get_usuarios_alocados($id);
          while($row = pg_fetch_array($result)) {
             $mobile=$row["telefone"];
             echo "TELEFONE".$mobile;
             echo "MSG".$msg;
             TesteDB::getInstance()->envia_sms($mobile,$msg);
             TesteDB::getInstance()->zera_intervalo_atual($id);
          }
    }
}
?>

