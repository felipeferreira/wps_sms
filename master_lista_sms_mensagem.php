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
                        <h1>Mensagens Disponiveis para envio</h1>
                        <p>
                            Insira uma nova mensagem para envio.
                        </p>
                         <p>    
                        <form method="POST" action="cadastra_sms_mensagem.php" >
                            <fieldset>
                            <label for="descricao">Descri&ccedil;&atilde;o:</label> <input id="descricao"  type="text" name="descricao" value="" /><br/>
                            <label for="intervalo_padrao">Intervalo:</label> <input id="intervalo_padrao" type="text" name="intervalo_padrao" value="" /><br/>
                            <label for="SQL">SQL:</label> <textarea rows="3" cols="30" id="sql"  name="sql" ></textarea><br/>
                            <br/>
                           <input class="form_submitb" name="imageField" type="submit" value="Inserir" />
                            </fieldset>
                             </form>
</p>
                        <table class="aatable">
                            <tr>
                                <th>Descricao</th>
                                <th>Intervalo</th>
                                <th>SQL</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php
       $result = TesteDB::getInstance()->get_mensagens();
            while($row = pg_fetch_array($result)) {
                $id = $row["id"];
                $descricao = $row["descricao"];
                $valor = $row["valor"];
                $ativa = $row["ativa"];
                $intervalo_padrao = $row["intervalo_padrao"];
                 $sql = $row["sql"];

                echo "<tr>";
               # echo "<td>" . strip_tags($id)."</td>";
                echo "<td>" . strip_tags($descricao)."</td>";
               # if ($ativa=='t')
               # echo "<td>Sim</td>";
               # else
               # echo "<td>N&atilde;o</td>";
                echo "<td>". strip_tags($intervalo_padrao)."</td>";
                echo "<td>". strip_tags($sql)."</td>";
           ?>

                               <td>
    <form name="deleteMEnsagen" action="delete_sms_mensagem.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="submit" name="delete_sms_mensagem" value="Excluir"/>
    </form>
</td>
 <td>
    <form name="ativaMensagem" action="ativa_sms_mensagem.php" method="POST">
        <?php
    
        if ($ativa=='t') {
            echo "<input type='hidden' name='id' value='".$id."'/>";
            echo "<input type='hidden' name='ativa' value='f'/>";
            echo "<input type='submit' name='ativa_sms_mensagem' value='Desativar'/>";
        }else {
            echo "<input type='hidden' name='id' value='".$id."'/>";
            echo "<input type='hidden' name='ativa' value='t'/>";
            echo "<input type='submit' name='ativa_sms_mensagem' value='Ativar'/>";
        }
        ?>
        </form>
</td>
  <?
  if ($enviada=="f"){
   ?>
    <td>
    <form name="enviaMensagen" action="envia_sms.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="submit" name="envia_sms_mensagem" value="Enviar"/>
    </form>
    </td></tr>
  <?
  }else {
   echo "<td></td></tr>";
  }

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
