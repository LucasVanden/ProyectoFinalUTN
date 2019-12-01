<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if($_SESSION['rol'] != 4){
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

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?> onload="a()">
    <script src="jquery.js"></script>
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Departamento</h2>
        <form action=<?php echo $crearDepartamento ?> method="POST">
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF" align="center">  
                   
                    <tr>
                        <th>Departamento</th>
                        <td>
                        <input type="text" name="departamento" required><br>
                        </td>
                    </tr>   

                    <tr>
                    <th>Aula de consulta predeterminada:</th>
                   <td style="visibility:hidden">
                            <select name="AulaAsignada" style="visibility:hidden" > 
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
                        <select name="cuerpo"  id="first-choice">
                                            <?php 
                                    $listacuerpoAula = $a->BuscarCuerpoAulas();
                                    foreach ($listacuerpoAula as $cuerpoAula): ?> 
                                    <option value=<?php echo $cuerpoAula ?>> <?php echo $cuerpoAula  ?></option>   
                                    <?php endforeach; 
                                    ?>
                                </select>
                        <!-- // -->
                        </td>
                    
                        </tr> 
                         
                        <tr>
                        <th>Nivel</th>
                        <td>                       
                                <select  name="nivel" id="second-choice">
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
                            <select  name="numeroaula" id="profesor-choice" oninvalid="this.setCustomValidity('Ingrese Aula y previamente Nivel')" onchange="this.setCustomValidity('')" required>
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
            <br>
            <div><input type="submit" value="Cargar Departamento" name="Buscar" formaction=<?php echo $crearDepartamento ?>></input></div> 
        </form>
            <div>  <input type="submit" value="Mostrar Departamentos" name="Buscar" formaction=<?php echo $abmDepartamento ?> onClick="myFunction();a()"></input></div>



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
                                <select name="cuerpo"  id="<?php echo "first-choice".$dep->getid_departamento(); ?>">
                                            <?php 
                                    $listacuerpoAula = $a->BuscarCuerpoAulas();
                                    foreach ($listacuerpoAula as $cuerpoAula): ?> 
                                    <option <?php if($salon->getcuerpoAula()==$cuerpoAula){echo ("selected");}?> value=<?php echo $cuerpoAula ?>> <?php echo $cuerpoAula  ?></option>   
                                    <?php endforeach; 
                                    ?>
                                </select>
                            </td>
                            <td>                       
                                <select  name="nivel" id="<?php echo "second-choice".$dep->getid_departamento(); ?>">
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

</script>            

</body>
<script>


$(document).ready(function() {
    setTimeout(function(){a()},250)

});

  
</script>
    <footer>
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>