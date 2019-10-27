<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);


$abmcrearAula= $URL.$abmcrearAula;
$Menu= $URL.$AsuetoMenu;
$ABMAula= $URL.$ABMAula;
$borrarAula=$URL.$borrarAula;

$a=new controladorAdministrador();
$aulas=$a->BuscarAulas();

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Cargar Aula</h2>
        <form action=<?php echo $abmcrearAula ?> method="POST">
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">                     
                    <tr>
                        <th>Cuerpo</th>
                        <td>
                            <input type="text" name="cuerpo" required><br>
                        </td>
                    </tr>
                    <tr>                   
                        <th>Nivel</th>
                        <td>
                            <input type="number" name="nivel" min="-2" max="10" step="1" required>
                        </td>
                        <br>
                    </tr>
                    <tr>   
                        <th>Aula</th>
                        <td>
                            <input type="text" name="Aula" required><br>
                        </td>
                        <br>
                    </tr>   
                </table>
            </div>
            <div><input type="submit" value="Cargar Aula" name="Buscar" formaction=<?php echo $abmcrearAula ?> /></div>     
        </form>
            <div><input type="submit" value="Mostrar Aulas" name="Buscar" formaction=<?php echo $ABMAula ?> onClick="myFunction()"/></div>
        
        <form action=<?php echo $borrarAula ?> method="POST">
            <div id="myDIV" >
                <table>
                    <?php foreach ($aulas as $aula): ?>
                    <tr>
                        <td>
                            <div>
                                <?php echo "cuerpo ".$aula->getcuerpoAula() ?>
                                <?php echo "nivel ".$aula->getnivelAula() ?>
                                <?php echo "aula ".$aula->getnumeroAula() ?>
                                <button type="submit" value=<?php echo $aula->getid_aula()?> name="borrarAula" formaction=<?php echo $borrarAula ?> onclick="return confirm('Esta seguro que desea eliminar aula <?php echo $fecha?> ')"> Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>    
            </div>
        </form>
        <script>
            var x = document.getElementById("myDIV");
            x.style.display = "none";
        </script>

        <?php if(isset($_SESSION['mostrarAulas'])) :?>
        <script>
            var x = document.getElementById("myDIV");
            x.style.display = "block";
        </script>
        <?php endif; ?>

        <script>
        function myFunction() {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
        } 
        </script>
            <!-- metodo vandenbosch para ver el fondo -->
            <div>
            <td>.</td><br>
            <td>.</td>
            </div>
             <!-- metodo vandenbosch para ver el fondo -->
</body>
    <footer>
    <?php require $DIR.$footer; ?>       
    </footer>  
</html>