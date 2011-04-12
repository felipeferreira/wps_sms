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
        $result=TesteDB::getInstance()->get_grupo_usuario_by_id($id);
        $row = pg_fetch_array($result);
        $idgrupo = $row["id"];
        $descricao = $row["descricao"];

        include("classes/sms_usuario.php");


        /** Check that the page was requested from itself via the POST method. */

	   ?>

    <body>
       
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <h1>Grupo :  <? echo $descricao; ?></h1>
                       <br/>
                        <form method="POST" action="aloca_mensagem_grupo.php" >
                            <fieldset>
                            <label for="mensagem">Mensagens:</label>
                            <select name="idmensagem">
                                <?php
                                $result = TesteDB::getInstance()->get_aloca_mensagens_disp($idgrupo);
                                while($row = pg_fetch_array($result)) {
                                    $id = $row["id"];
                                    $descricao = $row["descricao"];
                                    $valor = $row["valor"];
                                    $ativa = $row["ativa"];
                                    $intervalo_padrao = $row["intervalo_padrao"];
                                    $sql = $row["sql"];
                                    echo "<option value='".$id."'>".$descricao."</option>";
                                }
                                ?>
            
                            </select>
                             <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>"/>
                            <input class="form_submitb" name="imageField" type="submit" value="Inserir Mensagem" />
                            
                            </fieldset>
                             </form>
                             
                           <table class="aatable">
                            <tr>
                                <th>Mensagens Configuradas para este Grupo</th>
                                <th></th>
                            </tr>
                            <?php
       $result = TesteDB::getInstance()->get_aloca_mensagens_by_grupo_id($idgrupo);
            while($row = pg_fetch_array($result)) {
                $id2 = $row["id"];
                $descricao2 = $row["descricao"];
                echo "<tr>";
               # echo "<td>" . strip_tags($id)."</td>";
                echo "<td>" . strip_tags($descricao2)."</td>";
                            ?>

                               <td>
    <form name="deleteAloca" action="delete_aloca_mensagem.php" method="POST">
        <input type="hidden" name="id2" value="<?php echo $id2; ?>"/>
         <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>"/>
        <input type="submit" name="delete_aloca_mensagem" value="Delete"/>
    </form>
</td>
                           </tr>
  <? } ?>
                        </table>
<br/><br/><br/>

                        <br />
                           <form method="POST" action="aloca_usuario_grupo.php" >
                            <fieldset>
                            <label for="mensagem">Usu&aacute;rios:</label>
                            <select name="id_usuario">
                                <?php
                                $result = TesteDB::getInstance()->get_aloca_usuarios_disp($idgrupo);
                                while($row = pg_fetch_array($result)) {
                                    $id_usuario = $row["id"];
                                    $nome = $row["nome"];
                                    echo "<option value='".$id_usuario."'>".$nome."</option>";
                                }
                                ?>

                            </select>
                             <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>"/>
                            <input class="form_submitb" name="imageField" type="submit" value="Alocar Usu&aacute;rio" />

                            </fieldset>
                             </form>

                           <table class="aatable">
                            <tr>
                                <th>Usu&aacute;rios Alocados neste grupo</th>
                                <th></th>
                            </tr>
                            <?php
       $result = TesteDB::getInstance()->get_aloca_usuario_by_grupo_id($idgrupo);
            while($row = pg_fetch_array($result)) {
                $id_usuario  = $row["id"];
                $nome = $row["nome"];
                echo "<tr>";
               # echo "<td>" . strip_tags($id)."</td>";
                echo "<td>" . strip_tags($nome)."</td>";
                            ?>

                               <td>
    <form name="deleteAlocaUsuario" action="delete_aloca_usuario.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>"/>
         <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>"/>
        <input type="submit" name="delete_aloca_usuario" value="Delete"/>
    </form>
</td>
                           </tr>
  <? } ?>
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
