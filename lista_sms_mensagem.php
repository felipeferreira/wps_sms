<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Lista Clientes SMS.</title>
        <meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
        require_once("include/db.php");


        $id=0;
        if(isset($_REQUEST["id"])){
            $id = $_REQUEST["id"];
        }

        include("classes/sms_mensagem.php");


        /** Check that the page was requested from itself via the POST method. */

	   ?>

    <body>   
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                     <p>
                        <h1>Mensagens Disponiveis para envio</h1>
                     </p><br />
                        <h1>Ativas</h1>
                        <table class="aatable">
                            <tr>
                                <th>Descricao</th>
                                <th>Intervalo</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php
       $result = TesteDB::getInstance()->get_mensagens_ativas();
            while($row = pg_fetch_array($result)) {
                $id = $row["id"];
                $descricao = $row["descricao"];
                $valor = $row["valor"];
                $ativa = $row["ativa"];
                $intervalo_padrao = $row["intervalo_padrao"];
                 $sql = $row["sql"];

                echo "<tr>";
               # echo "<td>" . strip_tags($id)."</td>";
                echo "<td width='200'>" . strip_tags($descricao)."</td>";
               # if ($ativa=='t')
               # echo "<td>Sim</td>";
               # else
               # echo "<td>N&atilde;o</td>";
                echo "<td>";
                echo "<form name='updateMensagem' action='update_sms_mensagem.php' method='post'>";
                echo "<input type='hidden' name='id' value='".strip_tags($id)."' size='4'/>";
                echo "<input type='text' name='intervalo' value='".strip_tags($intervalo_padrao)."' size='4'/>";
                echo "<input type='submit' name='update_sms_mensagem' value='Alterar'/></form></td>";
                echo "<td>";
                echo "<form name='ativaMensagem' action='ativa_sms_mensagem.php' method='POST'>";
                echo "<input type='hidden' name='id' value='".$id."'/>";
                echo "<input type='hidden' name='ativa' value='f'/>";
                echo "<input type='submit' name='ativa_sms_mensagem' value='Desativar'/>";
                echo "</form>";
                echo "</td></tr>";
            }?>
        </table>
        <br /><br />
        <h1>Inativas</h1>
        <table class="aatable">
            <tr>
                <th>Descricao</th>
                <th>Intervalo</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            $result = TesteDB::getInstance()->get_mensagens_inativas();
            while($row = pg_fetch_array($result)) {
                $id = $row["id"];
                $descricao = $row["descricao"];
                $valor = $row["valor"];
                $ativa = $row["ativa"];
                $intervalo_padrao = $row["intervalo_padrao"];
                 $sql = $row["sql"];

                echo "<tr>";
               # echo "<td>" . strip_tags($id)."</td>";
                echo "<td width='200'>" . strip_tags($descricao)."</td>";
               # if ($ativa=='t')
               # echo "<td>Sim</td>";
               # else
               # echo "<td>N&atilde;o</td>";
                echo "<td>";
                echo "<form name='updateMensagem' action='update_sms_mensagem.php' method='post'>";
                echo "<input type='hidden' name='id' value='".strip_tags($id)."' size='4'/>";
                echo "<input type='text' name='intervalo' value='".strip_tags($intervalo_padrao)."' size='4'/>";
                echo "<input type='submit' name='update_sms_mensagem' value='Alterar'/></form></td>";
                echo "<td>";
                echo "<form name='ativaMensagem' action='ativa_sms_mensagem.php' method='POST'>";
                echo "<input type='hidden' name='id' value='".$id."'/>";
                echo "<input type='hidden' name='ativa' value='t'/>";
                echo "<input type='submit' name='ativa_sms_mensagem' value='Ativar'/>";
                echo "</form>";
                echo "</td></tr>";

            } ?>
        </table>
   </div>
   <!-- end div#welcome -->

   </div>
                <!-- end div#content -->
    <div id="sidebar">
                    <ul>
                        <?php include 'include/nav.php'; ?>
                        <!-- end navigation -->
                            <?php include 'include/updates.php'; ?>
                        <!-- end updates -->
                    </ul>
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
                <?php include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>