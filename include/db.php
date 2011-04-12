<?php
  class TesteDB {
  // single instance of self shared among all instances
    private static $instance = null;

    // db connection config vars
    private $user = "postgres";
    private $pass = "postgres";
    private $dbName = "parkingplus";
    private $dbHost = "125.125.10.100";

    private $con = null;

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    private function __construct() {
       
        $con = @pg_connect("host=$this->dbHost user=$this->user password=$this->pass dbname=$this->dbName");
      
    }

    //SMS***********************************************************************
    public function envia_sms($numero_telefone,$mensagem) {
    $mobile = trim($numero_telefone);
    #echo "   MOBILE=>".$mobile;
    $msg = $mensagem;
    $msg=trim($msg);
    #echo "   MENSAGEM NAO COD:".$msg;
    #$msg="teste";
    $credencial="BF5646FD0B7E33C3E7F9E88197BBC12952762239";
    $usuariomaster = "MPGATEWAY";
    $msg = URLEncode($msg);
    #echo "   MENSAGEM COD:" .$msg;
    $response = fopen("http://www.mpgateway.com/v_2_00/smspush/enviasms.aspx?Credencial=".$credencial."&Principal_User=".$usuariomaster."&Aux_User=USUAUX&Mobile=".$mobile."&Send_Project=N&Message=".$msg,"r");
    $status_code= fgets($response,4);
    echo "Status Code=>" .$status_code;
    }

 //MENSAGENS SMS********************************************************
     public function get_mensagens() {
        return pg_query("SELECT * FROM sms_mensagem order by descricao");
    }

    public function get_mensagens_ativas() {
        return pg_query("SELECT * FROM sms_mensagem where ativa='TRUE' order by descricao");
    }

    public function get_mensagens_inativas() {
        return pg_query("SELECT * FROM sms_mensagem where ativa='f' order by descricao");
    }
    public function verifica_mensagem_para_envio($id) {
        $result = pg_query("select m.id,m.descricao,m.ativa,m.intervalo_padrao,m.intervalo_atual from sms_mensagem m,sms_usuario u,sms_aloca_usuario au,sms_aloca_mensagem am where  m.id=am.mensagem_id and am.grupo_usuario_id=au.grupo_usuario_id and usuario_id=u.id and m.id =".$id );
        $row = pg_fetch_array($result);
        $id = $row["id"];
        $descricao = $row["descricao"];
        $ativa = $row["ativa"];
        $intervalo_padrao = $row["intervalo_padrao"];
        $intervalo_correto = $intervalo_padrao -1;
        $intervalo_atual = $row["intervalo_atual"];
        if ($intervalo_correto==$intervalo_atual) {
                return true;
        }
        else {
             echo "CHAMOU INCREMENTO PARA A MENSAGEM ID:".$id."";
             $intervalo_atual = $intervalo_atual +1;
              pg_query("UPDATE sms_mensagem set intervalo_atual=".$intervalo_atual." where id=".$id);
        }
        

    }

     public function get_mensagem_id_by_descricao ($descricao) {
        $result = pg_query("SELECT id FROM sms_mensagem WHERE descricao = '"
            . $descricao . "'");
        if (pg_num_rows($result) > 0)
        return pg_result($result, 0);
        else
        return null;
    }

      public function get_mensagem_by_mensagem_id($id) {
        return pg_query("SELECT * FROM sms_mensagem WHERE id=" . $id);
    }

     public function create_sms_mensagem ($descricao,$intervalo_padrao,$sql){
        pg_query("INSERT INTO sms_mensagem (descricao,intervalo_padrao,sql) VALUES ('" . $descricao
            . "',".$intervalo_padrao.",'".$sql."')");
    }

     public function delete_sms_mensagem ($id){
        return pg_query("DELETE FROM sms_mensagem WHERE id = " . $id);
    }

    public function update_sms_mensagem ($id,$intervalo){
        return pg_query("UPDATE sms_mensagem set intervalo_padrao=".$intervalo.",intervalo_atual=0 WHERE id =".$id);
    }

    public function set_ativa_sms_mensagem ($id,$ativa){
        return pg_query("UPDATE sms_mensagem set ativa='".$ativa."' WHERE id = " . $id);
    }

    public function incrementa_intervalo_atual($id,$intervalo_atual) {
        $novo_intervalo_atual=$intervalo_atual +1;
        pg_query("UPDATE sms_mensagem set intervalo_atual=".$novo_intervalo_atual." where id=".$id);
    }

    public function zera_intervalo_atual($id) {
        $intervalo_atual=0;
        pg_query("UPDATE sms_mensagem set intervalo_atual=".$intervalo_atual." where id=".$id);
    }



    //FIM MENSAGENS*************************************************************


    //GRUPOS SMS********************************************************
     public function get_grupo_usuario() {
        return pg_query("SELECT * FROM sms_grupo_usuario");
    }
  
    public function get_grupo_usuario_by_id($id) {
        return pg_query("SELECT * FROM sms_grupo_usuario WHERE id=" . $id);
    }

     public function create_sms_grupo_usuario ($descricao){
        pg_query("INSERT INTO sms_grupo_usuario (descricao) VALUES ('" . $descricao
            . "')");
    }

     public function delete_sms_grupo_usuario ($id){
        return pg_query("DELETE FROM sms_grupo_usuario WHERE id = " . $id);
    }

     public function get_grupo_id_by_descricao ($descricao) {
        $result = pg_query("SELECT id FROM sms_grupo_usuario WHERE descricao = '"
            . $descricao . "'");
        if (pg_num_rows($result) > 0)
        return pg_result($result, 0);
        else
        return null;
    }

    //FIM GRUPO*************************************************************


    //ALOCA MENSAGENS********************************************************
     public function get_aloca_mensagens_by_grupo_id($id2) {
         return pg_query("SELECT a.id,a.mensagem_id,a.grupo_usuario_id,m.descricao FROM sms_aloca_mensagem a,sms_mensagem m where a.mensagem_id=m.id and grupo_usuario_id=".$id2);
    }

    public function get_aloca_usuario_by_grupo_id($idgrupo) {
         return pg_query("SELECT a.id,a.grupo_usuario_id,a.usuario_id,u.nome FROM sms_aloca_usuario a,sms_usuario u where a.usuario_id=u.id and grupo_usuario_id=".$idgrupo);
    }

    public function get_aloca_mensagens_disp($idgrupo) {
        return pg_query("SELECT * FROM sms_mensagem where id not in (SELECT mensagem_id from sms_aloca_mensagem where grupo_usuario_id=".$idgrupo.")");
    }

    public function get_aloca_usuarios_disp($idgrupo) {
        return pg_query("SELECT * FROM sms_usuario where id not in (SELECT usuario_id from sms_aloca_usuario where grupo_usuario_id=".$idgrupo.")");
    }
    public function set_aloca_mensagem_grupo($idgrupo,$idmensagem) {
        return pg_query("INSERT INTO sms_aloca_mensagem(mensagem_id,grupo_usuario_id) VALUES(".$idmensagem.",".$idgrupo.")");
    }
    public function set_aloca_usuario_grupo($idgrupo,$id_usuario) {
        return pg_query("INSERT INTO sms_aloca_usuario(usuario_id,grupo_usuario_id) VALUES(".$id_usuario.",".$idgrupo.")");
    }

    public function delete_aloca_mensagem($id){
        return pg_query("DELETE FROM sms_aloca_mensagem WHERE id = " . $id);
    }
    public function delete_aloca_usuario($id){
        return pg_query("DELETE FROM sms_aloca_usuario WHERE id = " . $id);
    }

    //FIM ALOCA MENSAGEM*************************************************************




    //PATIO ATUAL***************************************************************
    public function get_patio_atual() {
        return pg_query("SELECT COUNT(*) FROM LOT");
    }
    //FIM PATIO ATUAL***********************************************************

    //USUARIOS******************************************************************

     public function get_usuario_id_by_nome ($nome) {
        $result = pg_query("SELECT id FROM sms_usuario WHERE nome = '"
            . $nome . "'");
        if (pg_num_rows($result) > 0)
        return pg_result($result, 0);
        else
        return null;
    }

    public function get_usuario_by_usuario_id($id) {
        return pg_query("SELECT * FROM sms_usuario WHERE id=" . $id);
    }

    public function get_usuarios() {
        return pg_query("SELECT * FROM sms_usuario");
    }

     public function get_usuarios_alocados($id) {
        return pg_query("select u.nome,u.telefone,m.id,m.descricao,m.ativa,m.intervalo_padrao,m.intervalo_atual from sms_mensagem m,sms_usuario u,sms_aloca_usuario au,sms_aloca_mensagem am where  m.id=am.mensagem_id and am.grupo_usuario_id=au.grupo_usuario_id and usuario_id=u.id and m.ativa='t' and m.id =".$id);
    }

    public function create_sms_usuario ($nome, $telefone){
        pg_query("INSERT INTO sms_usuario (nome, telefone) VALUES ('" . $nome
            . "', '" . $telefone . "')");
    }

    public function delete_sms_usuario ($id){
        return pg_query("DELETE FROM sms_usuario WHERE id = " . $id);
    }


    //**************************************************************************


    public function update_wish($wishID, $description, $duedate){
        $description = mysql_real_escape_string($description);
        return mysql_query("UPDATE wishes SET description = '" . $description .
                           "', due_date = " . $this->format_date_for_sql($duedate)
                           . " WHERE id =" . $wishID);
    }



    public function format_date_for_sql($date){
        if ($date == "")
            return "NULL";
        else {
            $dateParts = date_parse($date);
            return $dateParts["year"]*10000 + $dateParts["month"]*100 + $dateParts["day"];
        }
    }
  }
?>