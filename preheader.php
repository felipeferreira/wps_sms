<?php

	#a session variable is set by class for much of the CRUD functionality -- eg adding a row
    #session_start();

    #for pesky IIS configurations without silly notifications turned off
#    error_reporting(E_ALL - E_NOTICE);

	#this is the info for your database connection
    ####################################################################################
    ##
	$PG_HOST = "localhost";
	$PG_LOGIN = "postgres";
	$PG_PASS = "postgres";
	$PG_DB = "teste";
    ##
    ####################################################################################

	 $connection  = @pg_connect("host=$PG_HOST user=$PG_LOGIN password=$PG_PASS dbname=$PG_DB");
         $query;
	 $query = "SELECT * FROM sms_usuario";
         $result = pg_query($query);
        $sms_usuarioData;
        $sms_usuarioID = 0;

while($row = pg_fetch_array($result)){
        $id = $row['id'];
        $nome = $row['nome'];
        $telefone = $row['telefone'];

    
            $sms_usuario = new  Sms_usuario();
            $sms_usuario->set_id($id);
            $sms_usuario->set_nome($nome);
            $sms_usuario->set_telefone($telefone);

          
            $sms_uaurioData[$sms_usuarioID] = $sms_usuario;
            $sms_usuarioID = $sms_usuarioID +1;
        
}
    return $sms_usuarioData;

?>