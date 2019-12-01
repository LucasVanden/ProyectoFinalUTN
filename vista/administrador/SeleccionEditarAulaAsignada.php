<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if($_SESSION['rol'] != 4){
        header('location: '. $URL.$login);
    }
  }
  


require_once $DIR .$alumnoControlador;
require_once $DIR .$profesorControlador;
require_once $DIR .$controladorAdministrador;
$setearAula= $URL .$setearAula;
$EditarAultaAsignada= $URL .$EditarAultaAsignada;
$buscarNivelAula1ervacio=$URL.$buscarNivelAula1ervacio;
$buscarNombreAula=$URL.$buscarNombreAula;

require_once $DIR .$Aula;



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

<!-- ANTES DE GGUARDAR -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
       
        <h3>Horarios de Consulta</h3>
            <div>
                <table id="tablaMateriaPpal" align="center">
                    <thead>                    
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Semestre</th>
                        <th>Cuerpo</th>
                        <th>Nivel</th>
                        <th>Aula</th>
                    </thead>
                   
                        

                    <?php foreach ($horarios as $horario): ?> 
                    <form action=<?php echo $setearAula ?> method="POST">   
                        <?php $salon=$a->BuscarAulaID($horario->getfk_aula()); ?>
                        <input type="hidden" id="<?php echo "AulaidX".$horario->getid_horarioDeConsulta(); ?>"  name="idmateria" value=<?php echo $salon->getid_aula() ?>></input>
                              
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
                                    echo  $horario->getsemestre();};
                            ?>
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
                                <select name="cuerpo"  id="<?php echo "first-choice".$horario->getid_horarioDeConsulta(); ?>" onclick="b()">
                                            <?php 
                                    $listacuerpoAula = $a->BuscarCuerpoAulas();
                                    foreach ($listacuerpoAula as $cuerpoAula): ?> 
                                    <option <?php if($salon->getcuerpoAula()==$cuerpoAula){echo ("selected");}?> value=<?php echo $cuerpoAula ?>> <?php echo $cuerpoAula  ?></option>   
                                    <?php endforeach; 
                                    ?>
                                </select>
                            </td>

                            <td>                       
                                <select  name="nivel" id="<?php echo "second-choice".$horario->getid_horarioDeConsulta(); ?>">
                                </select> 
                                <script>
                                    $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"'; ?>).change(function() {
                                    $(<?php echo '"#second-choice'.$horario->getid_horarioDeConsulta().'"';?>).load("<?php echo $buscarNivelAula1ervacio.'?choice='?>"+ $(<?php echo '"#first-choice'.$horario->getid_horarioDeConsulta().'"';?>).val()+'&aula='+ $(<?php echo '"#AulaidX'.$horario->getid_horarioDeConsulta().'"'; ?>).val());
                                    }).change();
                                </script>
                            </td>

                            <td>
                                    <select name="numeroaula" id="<?php echo "profesor-choice".$horario->getid_horarioDeConsulta(); ?>">
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
                <form action=<?php echo $setearAula ?> method="POST">  
                    <div>  
                        <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $EditarAultaAsignada ?> />
                    </div>    
                </form>               
            </div>

        <!-- <button onclick="a()">piaCHU</button>        -->
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