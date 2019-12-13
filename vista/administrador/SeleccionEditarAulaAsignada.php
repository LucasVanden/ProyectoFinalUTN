<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!in_array(11,$_SESSION['permisos'])){
        header('location: '. $URL.$login);
    }
  }
require_once $DIR .$alumnoControlador;
require_once $DIR .$profesorControlador;
require_once $DIR .$controladorAdministrador;
require_once $DIR .$Aula;
$setearAula= $URL .$setearAula;
$EditarAultaAsignada= $URL .$EditarAultaAsignada;
$buscarNivelAula1ervacio=$URL.$buscarNivelAula1ervacio;
$buscarNombreAula=$URL.$buscarNombreAula;

if(isset($_SESSION['Materias'])){
    $idmateria=$_SESSION['Materias'];
}else{
$idmateria=$_POST['Materias'];  
$_SESSION['Materias']=$idmateria;
}

if(isset($_SESSION['profesor'])){
    $idprofesor=$_SESSION['profesor'];
}else{
    if(isset($_POST['profesor'])){
$idprofesor=$_POST['profesor'];  
$_SESSION['profesor']=$idprofesor;
}else{
    $direccion= $EditarAultaAsignada;
header("Location: $direccion");
}
}
?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(./../SnowHut.ttf);
}
</style>

<!-- ANTES DE GUARDAR -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,  minimum-scale=1.0">
        <title>aHora</title>
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
        <script src="./../js/funciones.js" type="text/javascript"></script>
        <script src="jquery.js"></script>
    </head>
    <body style="text-align: center" background = <?php echo $URL.$fondo?>>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <?php $a = new controladorAdministrador();
        $horarios=$a->buscarHorariosParallenarEnlosSelect($idmateria,$idprofesor);
        ?>
        <div class="container" align="center">
        <br>
            <div class="form-group" align="center">
                <h2 for="asignarMateriaAProfesor" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;">Horarios de Consulta</h2>
            </div>
            <div class="container" align="center">
                <div class="table-responsive col-md-10 col-md-offset-2">
                    <table id="tablaMateriaPpal" align="center">
                        <tr class="info">                    
                            <th>Día</th>
                            <th>Horario</th>
                            <th>Semestre</th>
                            <th>Cuerpo</th>
                            <th>Nivel</th>
                            <th>Aula</th>
                        </tr>                  
                        <?php foreach ($horarios as $horario): ?> 
                        <form action=<?php echo $setearAula ?> method="POST">   
                            <?php $salon=$a->BuscarAulaID($horario->getfk_aula()); ?>
                            <input type="hidden" id="<?php echo "AulaidX".$horario->getid_horarioDeConsulta(); ?>" name="idmateria" value=<?php echo $salon->getid_aula() ?>></input> 
                        <tr>
                            <td>
                                <?php echo $horario->getDia()->getdia(); ?>
                            </td>
                            <td>
                                <?php echo $horario->getHora(); ?>
                            </td>
                            <td>
                                <?php if($horario->getsemestre()==31){echo "Mesa 1";}elseif
                                    ($horario->getsemestre()==32){echo "Mesa 2";}else{
                                        echo  $horario->getsemestre();};?>
                            </td>  
                            <!-- <td>
                                <select name="AulaAsignada"> 
                                    <?php
                                        $aulas=$a->BuscarAulas();
                                        foreach ($aulas as $aula): ?>
                                    <option  <?php if($horario->getfk_aula() == $aula->getid_aula()){echo("selected");}?> value=<?php echo $aula->getid_aula()?>> 
                                        <?php 
                                        echo "Cuerpo: ".$aula->getcuerpoAula()." nivel: ".$aula->getnivelAula()." aula: ".$aula->getnumeroAula();
                                        ?>
                                    </option>
                                        <?php endforeach; ?>
                                </select>
                            </td> -->
                            <td>                                
                                <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" name="cuerpo"  id="<?php echo "first-choice".$horario->getid_horarioDeConsulta(); ?>" onclick="b()">
                                    <?php
                                    $listacuerpoAula = $a->BuscarCuerpoAulas();
                                    foreach ($listacuerpoAula as $cuerpoAula): ?> 
                                    <option <?php if($salon->getcuerpoAula()==$cuerpoAula){echo ("selected");}?> value=<?php echo $cuerpoAula ?>> <?php echo $cuerpoAula  ?></option>   
                                    <?php endforeach;?>
                                </select>
                            </td>
                            <td>                       
                                <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" name="nivel" id="<?php echo "second-choice".$horario->getid_horarioDeConsulta(); ?>">
                                </select> 
                                <script>
                                    $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).change(function() {
                                        $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).load("<?php echo $buscarNivelAula1ervacio.'?choice='?>"+ $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"';?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$horario->getid_horarioDeConsulta().'"'; ?>).val());
                                    }).change();
                                </script>
                            </td>
                            <td>
                                <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" name="numeroaula" id="<?php echo "profesor-choice".$horario->getid_horarioDeConsulta(); ?>">
                                </select>
                                <script>
                                    $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).change(function() {
                                        $(<?php echo '"#profesor-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).load("<?php echo $buscarNombreAula.'?choice='?>"+ $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).val()+'&choice2='+ $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$horario->getid_horarioDeConsulta().'"'; ?>).val());
                                    }).change();
                                </script>   
                                <script>
                                    $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"';?>).change(function() {
                                        $(<?php echo '"#profesor-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).load("<?php echo $buscarNombreAula.'?choice='?>"+ $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).val()+'&choice2='+ $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$horario->getid_horarioDeConsulta().'"'; ?>).val());
                                    }).change();
                                </script>                             
                            </td>
                            <td>
                                <button type="submit" id="buttonAsistir" name="asignar" value=<?php echo $horario->getid_horarioDeConsulta()?> formaction=<?php echo $setearAula?>> asignar </button>
                            </td>    
                        </tr>
                        </form>     
                        <?php endforeach;?>                           
                    </table>
                </div>
            </div>  
            <div class="container" align="center">   
                <form action=<?php echo $setearAula ?> method="POST">  
                    <br>
                    <div class="form-group" align="center"> 
                        <button class="btn btn-primary" value="Volver" name="Buscar" type="submit" formaction=<?php echo $EditarAultaAsignada ?>> <b>  +  Volver </b>  
                            <span class="glyphicon glyphicon-ok"></span>
                        </button>  
                    </div>  
                </form> 
            </div>              
        </div>
    </body>
    
    <script>
        $(document).ready(function() {
            setTimeout(function(){a()},250)
        });
        function b(){
            setTimeout(function(){a()},250)
        }
        function a(){
            <?php   foreach ($horarios as $horario): ?>  
            $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).change(function() {
            $(<?php echo '"#profesor-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).load("<?php echo $buscarNombreAula.'?choice='?>"+ $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).val()+'&choice2='+ $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$horario->getid_horarioDeConsulta().'"'; ?>).val());
            }).change();
            <?php endforeach?>
        }
    </script>
    
    <script>
        $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).change(function() {
            $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).load("<?php echo $buscarNivelAula1ervacio.'?choice='?>"+ $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"';?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$horario->getid_horarioDeConsulta().'"'; ?>).val());
        }).change();
    </script>
    
    <script>
        $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).change(function() {
            $(<?php echo '"#profesor-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).load("<?php echo $buscarNombreAula.'?choice='?>"+ $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).val()+'&choice2='+ $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$horario->getid_horarioDeConsulta().'"'; ?>).val());
        }).change();
    </script>

    <script>
        $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"';?>).change(function() {
            $(<?php echo '"#profesor-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).load("<?php echo $buscarNombreAula.'?choice='?>"+ $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).val()+'&choice2='+ $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$horario->getid_horarioDeConsulta().'"'; ?>).val());
        }).change();
    </script>

    <footer>
       <?php require $DIR.$footer; ?>         
    </footer>  
</html>