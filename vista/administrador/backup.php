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
                            <button class="btn btn-success" onclick="myFunction()">Crear BackUp</button><br/><br/>
                            </td>
                            <td>
                            <button class="btn btn-success" onclick="return confirm('¿Esta seguro que quiere restaurar los datos?')?restaurar():'';">Restaurar BackUp</button><br/><br/>
                            </td>
                        </tr>
                    </table>
                </div>
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
            document.getElementById("myDiv2").style.display = "none";
            document.getElementById("myDiv").style.display = "none";
            document.getElementById("mensaje").style.display = "block";
            document.getElementById("loader").style.display = "block";
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
    <footer>
       <?php require $DIR.$footer; ?>         
    </footer>  
</html>