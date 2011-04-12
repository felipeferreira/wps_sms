<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Lista Grupo de Usu&aacute;rios SMS.</title>
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

        include("classes/sms_usuario.php");
        include("classes/sms_grupo_usuario.php");
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
                        <h1>Grupos de Usu&aacute;rios</h1>
                        <p>
                            Insira os dados abaixo para cadastrar um novo grupo  de usu&aacute;rios.
                        </p>
                         <p>    
                        <form method="POST" action="cadastra_sms_grupo_usuario.php" >
                            <fieldset>
                            <label for="nome">Descri&ccedil;&atilde;o:</label> <input id="desc"  type="text" name="desc" value="" /><br/>
                           <input class="form_submitb" name="imageField" type="submit" value="Criar Grupo" />
                            </fieldset>
                             </form>
</p>
                        <table class="aatable">
                            <tr>
                                <th>Descricao</th>
                                <th></th>
                            </tr>
                            <?php
       $result = TesteDB::getInstance()->get_grupo_usuario();
            while($row = pg_fetch_array($result)) {
                $id = $row["id"];
                $descricao = $row["descricao"];
                echo "<tr>";
               # echo "<td>" . strip_tags($id)."</td>";
                echo "<td><a href='aloca_sms_grupo_usuario.php?id=".$id."'>" . strip_tags($descricao)."</a></td>";
                
           

            


                    #        $sms_usuarioData = getSms_usuario($id);
#
 #                           for($index=0;$index < count($sms_usuarioData);$index++){
  ####                           echo "<td>".$sms_usuario->get_nome()."</td>";
#
 #                               echo "<td>".$sms_usuario->get_telefone()."</td>";
  #                              echo "<td><form name='delete_sms_usuario' action='delete_sms_usuario.php' method='POST'>";
   #                             echo "<input type='hidden' name='id' value=".$sms_usuario->get_id()."/>";
    #                            echo "<input type='submit' class='form_submit' name='delete_sms_usuario' value='Excluir'/> </form>";
   

     #                           echo "</tr>";
      #                      }
                            ?>

                               <td>
    <form name="deleteGrupoUsuario" action="delete_sms_grupo_usuario.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="submit" name="delete_sms_grupo_usuario" value="Delete"/>
    </form>
</td></tr>
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
