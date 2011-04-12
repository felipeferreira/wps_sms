<?php
/*
This file contains the functions
that performs the DB operation. The
Database properties are taken from the
session.
*/


$databaseURL;
$databaseUName;
$databasePWord;
$databaseName;



/*
DB Initialization method.
Returns the connection variable.
*/
function initDB(){


/* Get Sectors from session */
    if(! isset($_SESSION['databaseURL'])){
            include("conf/conf.php");
            $dbConf = new WPSConf();
            $databaseURL = $dbConf->get_databaseURL();
            $databaseUName = $dbConf->get_databaseUName();
            $databasePWord = $dbConf->get_databasePWord();
            $databaseName = $dbConf->get_databaseName();

                //Set DB Info. in-session
            $_SESSION['databaseURL']=$databaseURL;
            $_SESSION['databaseUName']=$databaseUName;
            $_SESSION['databasePWord']=$databasePWord;
            $_SESSION['databaseName']=$databaseName;



            $connection =@pg_connect("host=$databaseURL user=$databaseUName password=$databasePWord dbname=$databaseName");
          
            $rowArray;
            $rowID = 1;
            $query = "SELECT * FROM sms_usuario";
            $result = pg_query($query);
            while($row = pg_fetch_array($result)){
                    $rowArray[$rowID] = $row['Sector'];
                    $rowID = $rowID +1;
                }

                //Update the session with the sectors.
            #$_SESSION['sectors']=$rowArray;
            return($connection);
            #pg_close($connection);
        }
}
function closeDB($connection){
    pg_close($connection);
}

/*
This method returns the flight information
given the Flight ID. The Flight table
is queries to return the sectors supported.
Pass the Flight ID.
Returns an array of Flight objects. See classes/
Flight for the helper class.
*/
function getSms_usuario($id){
    $connection = initDB();
    $query;

    if($id == 0){
            $query = "SELECT * FROM sms_usuario";
        }
        else{
            $query = "SELECT * FROM sms_usuario WHERE ID='".$id."'";
        }


    $result = pg_query($query);
        // or die ("Query Failed ".mysql_error());

    $sms_usuarioData;
    $sms_usuarioID = 0;

    while($row = pg_fetch_array($result)){
            $id = $row['id'];
            $nome = $row['nome'];
            $telefone = $row['telefone'];

                //Build the Flight object
            $sms_usuario = new Sms_usuario();
            $sms_usuario->set_id($id);
            $sms_usuario->set_nome($nome);
            $sms_usuario->set_telefone($telefone);

               //Build the Flight object array
            $sms_usuarioData[$sms_usuarioID] = $sms_usuario;
            $sms_usuarioID = $sms_usuarioID +1;
        }
    closeDB($connection);
    return $sms_usuarioData;
}

function delete2_sms_usuario($id){
     return pg_query("DELETE FROM sms_usuario WHERE id = " . $id);
}

?>
