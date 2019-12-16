<?php
# Replace text/html with whatever MIME-type you prefer.
header("Content-Type: text/html; charset=utf-8");
?>
<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!in_array(17,$_SESSION['permisos'])){
        header('location: '. $URL.$login);
    }
  }  
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);

$MenuIndex= $URL.$MenuIndex;
$dbbackup= $URL.$dbbackup;
$restore= $URL.$restore;
?>
<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

$conn = mysqli_connect("localhost", "root", "", "consultasfrm");
mysqli_set_charset($conn,"utf8");
if (! empty($_FILES)) {
    // Validating SQL file type by extensions
    if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
        "sql"
    ))) {
        $response = array(
            "type" => "error",
            "message" => "Tipo De archivo Invalido"
        );
    } else {
        if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
            move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
            
            deleteBd();
            $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
        }
    }
}
function restoreMysqlDB($filePath, $conn)
{
    $sql = '';
    $error = '';
    
    if (file_exists($filePath)) {
        $lines = file($filePath);
        // echo '<pre>'; print_r($lines); echo '</pre>';
    $i=0;
        foreach ($lines as $line) {
            //debug
            // if($i==0){
            // echo mb_detect_encoding($line) ;
            // $line = mb_convert_encoding($line, "UTF-8");   
            // echo mb_detect_encoding($line) ;
            // echo $line;
            // }$i=1;
            //degub>/
            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($line), - 1, 1) == ';') {
                // echo $sql;
                $result = mysqli_query($conn, $sql);
                if (! $result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = '';
            }
        } // end foreach
        
        if ($error) {
            $response = array(
                "type" => "error",
                "message" => $error
            );
        } else {
            $response = array(
                "type" => "success",
                "message" => "Base de datos Restaurada exitosamente."
            );
        }
        exec('rm ' . $filePath);
    } // end if file exists
    
    return $response;
}
function deleteBd(){
$con= new conexion();
$conn=$con->getconexion();

$stmt = $conn->prepare("DROP TABLE `alumno`, `anotadosestado`, `asueto`, `aula`, `avisoprofesor`, `dedicacion`, `dedicacion_materia_profesor`, `departamento`, `detalleanotados`, `dia`, `estadoanotados`, `falta`, `fechamesa`, `horadeconsulta`, `horariocursado`, `horariodeconsulta`, `materia`, `materias_alumno`, `perfil`, `persona`, `presentismo`, `privilegio`, `privilegioperfil`, `profesor`, `turno`, `usuario`;");
try{ $stmt->execute();
} 
 catch(Exception $e){
 }

}
?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(./../SnowHut.ttf);
}
</style>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Backup</title>
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/> 
<style>
                    
    /* Center the loader */
    #loader {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
    position: relative;
    -webkit-animation-name: animatebottom;
    -webkit-animation-duration: 1s;
    animation-name: animatebottom;
    animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
    from { bottom:-100px; opacity:0 } 
    to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom { 
    from{ bottom:-100px; opacity:0 } 
    to{ bottom:0; opacity:1 }
    }

    #myDiv {
    display: none;
    text-align: center;
    }
    #myDiv2 {
    display: none;
    text-align: center;
    }
</style>
<style>
    <style>
    body {
        max-width: 550px;
        font-family: "Segoe UI", Optima, Helvetica, Arial, sans-serif;
    }

    #frm-restore {
        background: #aee5ef;
        padding: 20px;
        border-radius: 2px;
        border: #a3d7e0 1px solid;
    }

    .form-row {
        margin-bottom: 20px;
    }

    .input-file {
        background: #FFF;
        padding: 10px;
        margin-top: 5px;
        border-radius: 2px;
    }

    .btn-action {
        background: #333;
        border: 0;
        padding: 10px 40px;
        color: #FFF;
        border-radius: 2px;
    }

    .response {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 2px;
    }

    .error {
        background: #fbd3d3;
        border: #efc7c7 1px solid;
    }

    .success {
        background: #cdf3e6;
        border: #bee2d6 1px solid;
    }
</style>
</style>
     
    </head>
    <body background = <?php echo $URL.$fondo?> style="bg-secondary">

    <?php include  $DIR.$headerAdmin ?>
    <script src="jquery.js"></script>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container">
            <br>
            <form action=<?php echo $MenuIndex ?> method="POST" class="form-horizontal">
                <div class="form-group" align="center">
                    <h2 for="backup" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Backup </h2>
                </div> 
                    <table align='center' id="tablaBuscar" style="border-color: #FFFFFF">             
                    
                        <tr>   
                        </tr>   
                        <tr>      
            
                    <!-- <IMG SRC="manquina de escribir invisible.gif"> -->
                    </tr>
                    </table>
                </div>
            </form>
            <div class="container" align="center">
                <div class="table-responsive col-md-5 col-md-offset-4">
                    <table class="table table-bordered table-hover" id="tablaBuscar">                     
                        <tr class="info">
                         
                            <td>
                            <form action=<?php echo $dbbackup?> method="POST" class="form-horizontal">
                            <button class="btn btn-success" onclick="myFunction()" formaction=<?php echo $dbbackup?>>Crear BackUp</button><br/><br/>
                            </form>
                            </td>
                            <td>
                            <!-- <button class="btn btn-success" onclick="return confirm('¿Esta seguro que quiere restaurar los datos?')?restaurar():'';">Restaurar BackUp</button><br/><br/> -->
             
                            <button class="btn btn-success" onclick="mostrarRestaurarMenu()">Restaurar BackUp</button><br/><br/>
                         
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

<?php
if(isset($_SESSION['restauracionMensaje'])){ ?>

    <div  style="display:block;" id="mensajeRestaurar">
    <?php
    if (! empty($response)) { ?>
        <div class="response <?php echo $response["type"]; ?>">
        <?php echo nl2br($response["message"]); ?>
        </div>
    <?php } ?>
    </div>
<?php 
$_SESSION['restauracionMensaje']=NULL;
} ?>


<div  style="display:none;" id="restauracionCartel">
    <form method="post" action="" enctype="multipart/form-data"
        id="frm-restore">
        <div class="form-row">
            <div>Seleccione archivo: </div>
            <div>
                <input type="file" name="backup_file" class="input-file" required />
            </div>
        </div>
        <div>
            <input type="submit" name="restore" value="Restore"
                class="btn-action" onclick="mostrarMensajeRestauracion()"/>
        </div>
    </form>
</div>

              
            <div style="display:none;" id="loader"></div>

            <div style="display:none;" id="myDiv" class="animate-bottom">
                <h2>BackUp exitoso</h2>
                <p>Se creo un backup de los datos</p>
            </div>

            <div style="display:none;" id="myDiv2" class="animate-bottom">
                <h2>Restauracion exitosa</h2>
                <p>Se restauraron los datos del ultimo backup</p>
            </div>

            <div style="display:none;" id="mensaje">
                Creando BackUp de Datos...
            </div>

            <div style="display:none;" id="mensajeRestauracion">
                Restaurando Datos...
            </div>

        </div>
    </body>

    <script>
        var myVar;

        function myFunction() {
            document.getElementById("mensaje").style.display = "block";
            document.getElementById("loader").style.display = "block";
            try {
            document.getElementById("restauracionCartel").style.display = "none";
            }catch(e){}
            try {
            document.getElementById("mensajeRestaurar").style.display = "none";
            }catch(e){}
            try {
            document.getElementById("myDiv2").style.display = "none";
            }catch(e){}
            try {
            document.getElementById("myDiv").style.display = "none";
            }catch(e){}
    
            myVar = setTimeout(showPage, 3000);
        }

        function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("mensaje").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
        }

    </script>
    <script>
        var myVar2;

        function restaurar() {
            document.getElementById("myDiv").style.display = "none";
            document.getElementById("myDiv2").style.display = "none";
            document.getElementById("mensajeRestauracion").style.display = "block";
            document.getElementById("loader").style.display = "block";
        myVar2 = setTimeout(showPage2, 3000);
        }

        function showPage2() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("mensajeRestauracion").style.display = "none";
        document.getElementById("myDiv2").style.display = "block";
        }

    </script>

    <script>
        function mostrarRestaurarMenu(){
            document.getElementById("restauracionCartel").style.display = "block";
            
            try {
            document.getElementById("mensajeRestaurar").style.display = "none";
            }catch(e){}
            try {
            document.getElementById("loader").style.display = "none";
            }catch(e){}
            try {
            document.getElementById("mensaje").style.display = "none";
            }catch(e){}
            try {
            document.getElementById("myDiv").style.display = "none";
            }catch(e){}
    
        }
    </script>

    <script>
        function mostrarMensajeRestauracion(){
            <?php $_SESSION['restauracionMensaje']=true;?>
            
        }
    </script>

    <footer>
       <?php require $DIR.$footer; ?>         
    </footer>  
</html>