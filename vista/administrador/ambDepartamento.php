<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
  header('location: '. $URL.$login);
}else{
  if(!in_array(6,$_SESSION['permisos'])){
      header('location: '. $URL.$login);
  }
}
  
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);

$Menu= $URL.$AsuetoMenu;
$ABMAula= $URL.$ABMAula;
$borrarDepartamento=$URL.$borrarDepartamento;
$abmDepartamento=$URL.$abmDepartamento;
$crearDepartamento=$URL.$crearDepartamento;
$editarDepartamento=$URL.$editarDepartamento;
$buscarNivelAula1ervacio=$URL.$buscarNivelAula1ervacio;
$buscarNombreAula=$URL.$buscarNombreAula;

$a=new controladorAdministrador();
$departamentos=$a->BuscarDepartamento();
?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(./../SnowHut.ttf);
}
</style>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
        <title>Departamento</title>
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/> 
    </head>
    <body background = <?php echo $URL.$fondo?> onload="a();PopUp()">
    <script src="jquery.js"></script>
    <?php include  $DIR.$headerAdmin ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container" align="center">
        <br>
            <form action=<?php echo $crearDepartamento ?> method="POST">
                <div class="form-group" align="center">
                    <h2 for="abmdepartamento" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Departamentos </h2>
                </div>
                <div class="container" align="center">
                    <div class="table-responsive col-md-7 col-md-offset-1">
                        <table class="table table-bordered table-hover" id="tablaBuscar" align="center">                     
                            <tr class="info">
                                <th>Departamento</th>
                                <td>
                                    <input class="form-control" type="text1" name="departamento" required>
                                </td>
                            </tr>  
                            <tr>
                                <th colspan="2">Aula de consulta predeterminada:</th>
                                <td style="visibility:hidden">
                                    <select class="browser-default custom-select" name="AulaAsignada" style="visibility:hidden" > 
                                        <?php
                                            $aulas=$a->BuscarAulas();
                                            foreach ($aulas as $aula): ?>
                                        <option value=<?php echo $aula->getid_aula()?>> 
                                        <?php 
                                            echo "Cuerpo: ".$aula->getcuerpoAula()." nivel: ".$aula->getnivelAula()." aula: ".$aula->getnumeroAula();
                                        ?>
                                        </option>
                                            <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Cuerpo</th>
                                <td>
                                    <select class="browser-default custom-select"  data-style="btn-primary" data-widthen="auto" name="cuerpo"  id="first-choice">
                                        <?php 
                                            $listacuerpoAula = $a->BuscarCuerpoAulas();
                                            foreach ($listacuerpoAula as $cuerpoAula): ?> 
                                            <option value=<?php echo $cuerpoAula ?>> <?php echo $cuerpoAula  ?></option>   
                                            <?php endforeach; 
                                            ?>
                                        </select>
                                </td>                            
                            </tr>                             
                            <tr>
                                <th>Nivel</th>
                                <td>                       
                                    <select class="browser-default custom-select"  data-style="btn-primary" data-widthen="auto" name="nivel" id="second-choice">
                                    </select> 
                                    <script>
                                        $("#first-choice").change(function() {
                                            $("#second-choice").load("<?php echo $buscarNivelAula1ervacio.'?choice='?>"+ $("#first-choice").val());
                                        }).change();                                                
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <th>Aula</th>
                                <td>
                                    <select class="browser-default custom-select"  data-style="btn-primary" data-widthen="auto" name="numeroaula" id="profesor-choice" oninvalid="this.setCustomValidity('Ingrese Aula y previamente Nivel')" onchange="this.setCustomValidity('')" required>
                                    </select> 
                                    <script>
                                        $("#second-choice").change(function() {
                                            $("#profesor-choice").load("<?php echo $buscarNombreAula.'?choice='?>"+ $("#second-choice").val()+'&choice2='+ $("#first-choice").val());
                                        }).change();                                                
                                    </script>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <div class="form-group" align="center"> 
                    <button class="btn btn-success" id="CargarDepartamento" name="textoConfirmar" type="submit" formaction=<?php echo $crearDepartamento ?>> <b>  +  Cargar Departamento </b>  
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>  
                </div>
            </form>
            <br>
            <div class="form-group" align="center"> 
                <button class="btn btn-primary" id="MostrarDepartamentos" name="textoConfirmar" type="submit" formaction=<?php echo $abmDepartamento ?> onClick="myFunction();a()"> <b>  +  Mostrar Departamentos </b>  
                    <span class="glyphicon glyphicon-ok"></span>
                </button>  
            </div>      

<div id="myDIV" >
<table align="center">
    <th>Departamento</th> 
    <th>Cuerpo</th>
    <th>Nivel</th>
    <th>Aula</th>
    <?php foreach ($departamentos as $dep): ?>    
        <form action=<?php echo $editarDepartamento ?> method="POST"> 
       
                    <select name="AulaAsignada" id="<?php echo "AulaidX".$dep->getid_departamento(); ?>"style="visibility:hidden" >  
                        <?php
                        $aulas=$a->BuscarAulas();
                        foreach ($aulas as $aula): ?>
                        <option  <?php if($aula->getid_aula() == $dep->getfk_aula()){echo("selected");}?> value=<?php echo $aula->getid_aula()?>> 
                            <?php 
                            echo "Cuerpo: ".$aula->getcuerpoAula()." nivel: ".$aula->getnivelAula()." aula: ".$aula->getnumeroAula();
                            ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <?php $salon=$a->BuscarAulaID($dep->getfk_aula()); 
                    $_SESSION["salon"]=$salon;?>
                      
            <tr>
                <td>
                    <?php   echo $dep->getnombre() ?>
                    <!-- <?php   echo $dep->getid_departamento() ?> -->
                </td>
 
                    <!-- // -->
           
                            <td>                                
                                <select name="cuerpo"  id="<?php echo "first-choice".$dep->getid_departamento(); ?>" onclick="b()">
                                            <?php 
                                    $listacuerpoAula = $a->BuscarCuerpoAulas();
                                    foreach ($listacuerpoAula as $cuerpoAula): ?> 
                                    <option <?php if($salon->getcuerpoAula()==$cuerpoAula){echo ("selected");}?> value=<?php echo $cuerpoAula ?>> <?php echo $cuerpoAula  ?></option>   
                                    <?php endforeach; 
                                    ?>
                                </select>
                            </td>
                            <td>                       
                                <select name="nivel" id="<?php echo "second-choice".$dep->getid_departamento(); ?>">
                                </select> 
                                    <script>
                                        $(<?php echo '"#first-choice'.$dep->getid_departamento().'"'; ?>).change(function() {
                                        $(<?php echo '"#second-choice'.$dep->getid_departamento().'"';?>).load("<?php echo $buscarNivelAula1ervacio.'?choice='?>"+ $(<?php echo '"#first-choice'.$dep->getid_departamento().'"';?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$dep->getid_departamento().'"'; ?>).val());
                                        }).change();
                                        
                                    </script>
                            </td>
                            <td>
                                    <select name="numeroaula" id="<?php echo "profesor-choice".$dep->getid_departamento(); ?>">
                                    </select>                                
                                
                                <script>
                                    $(<?php echo '"#second-choice'.$dep->getid_departamento().'"';?>).change(function() {
                                    $(<?php echo '"#profesor-choice'.$dep->getid_departamento().'"'; ?>).load("<?php echo $buscarNombreAula.'?choice='?>"+ $(<?php echo '"#second-choice'.$dep->getid_departamento().'"';?>).val()+'&choice2='+ $(<?php echo '"#first-choice'.$dep->getid_departamento().'"'; ?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$dep->getid_departamento().'"'; ?>).val());
                                    }).change();
                                </script>
                                <script>
                                    $(<?php echo '"#first-choice'.$dep->getid_departamento().'"';?>).change(function() {
                                    $(<?php echo '"#profesor-choice'.$dep->getid_departamento().'"'; ?>).load("<?php echo $buscarNombreAula.'?choice='?>"+ $(<?php echo '"#second-choice'.$dep->getid_departamento().'"';?>).val()+'&choice2='+ $(<?php echo '"#first-choice'.$dep->getid_departamento().'"'; ?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$dep->getid_departamento().'"'; ?>).val());
                                    }).change();
                                </script>
                            </td>
                                        
                                  <!-- // -->
           
                <td>
                    <button type="submit" id="buttonAsistir" name="asignar" value=<?php echo $dep->getid_departamento()?> formaction=<?php echo $editarDepartamento?>> asignar </button>
        </form>
            </td> 
         
        <form action=<?php echo $borrarDepartamento ?> method="POST">
            <td>
                <button type="submit" value=<?php echo $dep->getid_departamento()?> name="borrarDepartamento" formaction=<?php echo $borrarDepartamento ?> onclick="return confirm('Esta seguro que desea eliminar departamento <?php echo $dep->getnombre()?> ')">Eliminar</button>    
            </td>
        </form>
            </tr>
        <?php endforeach; ?>
</table>
    <!-- // -->
    
</div>

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
         <!-- <button onclick="a()">piaCHU</button>        -->
<script>
function a(){
    <?php foreach ($departamentos as $dep): ?>  
    $(<?php echo '"#profesor-choice'.$dep->getid_departamento().'"'; ?>).load("<?php echo $buscarNombreAula.'?choice='?>"+ $(<?php echo '"#second-choice'.$dep->getid_departamento().'"';?>).val()+'&choice2='+ $(<?php echo '"#first-choice'.$dep->getid_departamento().'"'; ?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$dep->getid_departamento().'"'; ?>).val());
    <?php endforeach?>
}

function b(){
    setTimeout(function(){a()},250)
}
</script>            
</div>
</body>
<script>
$(document).ready(function() {
    setTimeout(function(){a()},250)
});
</script>

<div id="snackbar"> 
  Departamento Existente
       
</div>
<!-- Style popUP -->
<style>
   #snackbar {
   visibility: hidden; /* Hidden by default. Visible on click */
   min-width: 250px; /* Set a default minimum width */
   margin-left: -125px; /* Divide value of min-width by 2 */
   background-color: #333; /* Black background color */
   color: #fff; /* White text color */
   text-align: center; /* Centered text */
   border-radius: 2px; /* Rounded borders */
   padding: 16px; /* Padding */
   position: fixed; /* Sit on top of the screen */
   z-index: 1; /* Add a z-index if needed */
   left: 50%; /* Center the snackbar */
   bottom: 30px; /* 30px from the bottom */
   }

   /* Show the snackbar when clicking on a button (class added with JavaScript) */
   #snackbar.show {
   visibility: visible; /* Show the snackbar */
   /* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
   However, delay the fade out process for 2.5 seconds */
   -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
   animation: fadein 0.5s, fadeout 0.5s 2.5s;
   }


   /* Animations to fade the snackbar in and out */
   @-webkit-keyframes fadein {
   from {bottom: 0; opacity: 0;} 
   to {bottom: 30px; opacity: 1;}
   }

   @keyframes fadein {
   from {bottom: 0; opacity: 0;}
   to {bottom: 30px; opacity: 1;}
   }

   @-webkit-keyframes fadeout {
   from {bottom: 30px; opacity: 1;} 
   to {bottom: 0; opacity: 0;}
   }

   @keyframes fadeout {
   from {bottom: 30px; opacity: 1;}
   to {bottom: 0; opacity: 0;}
   }
</style>
<!-- funcion PopUp -->
<script>
   function PopUp() {
   // Get the snackbar DIV

   if(<?php echo ($_SESSION["existenteDepartamento"]) ?>){
   var x = document.getElementById("snackbar");
   <?php $_SESSION["existenteDepartamento"]=NULL;
   ?>
   // Add the "show" class to DIV
   x.className = "show";

   // After 3 seconds, remove the show class from DIV
   setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
   }


   } 
</script>
    <footer>
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>