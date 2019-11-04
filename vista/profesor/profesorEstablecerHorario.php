<?php
session_start();

require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if(!($_SESSION['rol'] == 2 || $_SESSION['rol']==3)){
        header('location: '. $URL.$login);
    }
}
require_once $DIR . $profesorControlador;
$crearHorario= $URL . $crearHorarioDeConsulta;


$idProfesor=$_SESSION['idProfesor'];
// id de la decicacion que le corresponden 2 horas de consulta
$nombrededicacion="1";

$D1S1=null;
$H1S1=null;
$M1S1=null;

$D2S1=null;
$H2S1=null;
$M2S1=null;

$D1S2=null;
$H1S2=null;
$M1S2=null;

$D2S2=null;
$H2S2=null;
$M2S2=null;

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,  minimum-scale=1.0">
        <title>Establecer Horario</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <?php require $DIR.$headerp ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>

        <?php 
        if (isset($_POST['nombreMateriaSeleccionada'])){
           $nommat= $_POST['nombreMateriaSeleccionada'];
           $_SESSION['nombreMateriaSeleccionadaEnPpal']=$nommat;
        }else{
            $nommat=$_SESSION['nombreMateriaSeleccionadaEnPpal'];
        }
        $a=new Profesorcontrolador();
        $idmateria= $a->buscarIDdeNombreMateria($nommat);
        $dedicacion=$a->buscarDedicaciondeMateria($idmateria,$idProfesor);//id PROFESOR SESSION<---------------------------------------------------------------------------------------------
        
        $dedicaciondoble=false;
        if($dedicacion->getid_dedicacion()==$nombrededicacion){
            $dedicaciondoble=true;
        }
          
        $cargar=$a->buscarHorariosParallenarEnlosSelect($idmateria,$idProfesor);
        if(isset($cargar)){
           foreach ($cargar as $horario) {
                if($horario->getsemestre()==1){
                    if($horario->getn()==2){
                        $D1S2=$horario->getdia()->getid_dia();
                        $H1S2=date("H", strtotime( $horario->gethora()));
                        $M1S2=date("i", strtotime( $horario->gethora()));
                    }else{
                        $D1S1=$horario->getdia()->getid_dia();
                        $H1S1=date("H", strtotime( $horario->gethora()));
                        $M1S1=date("i", strtotime( $horario->gethora()));
                    }
                }
                elseif($horario->getsemestre()==2){
                    if($horario->getn()==2){
                        $D2S2=$horario->getdia()->getid_dia();
                        $H2S2=date("H", strtotime( $horario->gethora()));
                        $M2S2=date("i", strtotime( $horario->gethora()));
                    }else{
                        $D2S1=$horario->getdia()->getid_dia();
                        $H2S1=date("H", strtotime( $horario->gethora()));
                        $M2S1=date("i", strtotime( $horario->gethora()));
                    }
                }
            }
        }
        ?>
        
        <div class="container">
            <br>
            <form action="alumnoPpal.php" method="POST" >
                <div class="form-group">
                    <h2 for="establecer" class="text-primary col-md-5 col-md-offset-4"> Establecer Horario de Consulta: </h2>
                </div>
                <div class="container">
                    <div class="table-responsive col-md-4 col-md-offset-4">
                        <table class="table table-bordered table-hover" id="tablaBuscar">
                            <tr class="info">
                                <th> Nombre </th> 
                                <td>
                                    <strong><?php echo $nommat?></strong>
                                </td>
                            </tr>
                            <tr>
                                <th>Dedicación</th>
                                <td>
                                <?php echo $dedicacion->gettipo()?>
                                </td>
                            </tr>                   
                            <tr class="text-primary">
                                <th colspan="2" class="text-center">Primer Semestre</th>
                            </tr>
                            <tr>
                                <th>Día</th>
                                <td>
                                    <select name="Dia1ersemestre1">                       
                                        <option <?php if($D1S1 == '1'){echo("selected");}?> value=1>Lunes</option>
                                        <option <?php if($D1S1 == '2'){echo("selected");}?> value=2>Martes</option>
                                        <option <?php if($D1S1 == '3'){echo("selected");}?> value=3>Miércoles</option>
                                        <option <?php if($D1S1 == '4'){echo("selected");}?> value=4>Jueves</option>
                                        <option <?php if($D1S1 == '5'){echo("selected");}?> value=5>Viernes</option>
                                    </select>
                                </td>
                                <?php if($dedicaciondoble): ?>  
                                <td>
                                    <select name="Dia1ersemestre2">                       
                                        <option <?php if($D1S2 == '1'){echo("selected");}?> value=1>Lunes</option>
                                        <option <?php if($D1S2 == '2'){echo("selected");}?> value=2>Martes</option>
                                        <option <?php if($D1S2 == '3'){echo("selected");}?> value=3>Miércoles</option>
                                        <option <?php if($D1S2 == '4'){echo("selected");}?> value=4>Jueves</option>
                                        <option <?php if($D1S2 == '5'){echo("selected");}?> value=5>Viernes</option>
                                    </select>
                                </td>
                                <?php endif; ?>
                            </tr>                   
                            <tr>
                                <th>Horario</th>                        
                                <td>
                                    <select name="Horarioshora1ersemestre1">                       
                                        <option <?php if($H1S1 == '08'){echo("selected");}?> value='08'>08</option>
                                        <option <?php if($H1S1 == '09'){echo("selected");}?> value='09'>09</option>
                                        <option <?php if($H1S1 == '10'){echo("selected");}?> value='10'>10</option>
                                        <option <?php if($H1S1 == '11'){echo("selected");}?> value='11'>11</option>
                                        <option <?php if($H1S1 == '12'){echo("selected");}?> value='12'>12</option>
                                        <option <?php if($H1S1 == '13'){echo("selected");}?> value='13'>13</option>
                                        <option <?php if($H1S1 == '14'){echo("selected");}?> value='14'>14</option>
                                        <option <?php if($H1S1 == '15'){echo("selected");}?> value='15'>15</option>
                                        <option <?php if($H1S1 == '16'){echo("selected");}?> value='16'>16</option>
                                        <option <?php if($H1S1 == '17'){echo("selected");}?> value='17'>17</option>
                                        <option <?php if($H1S1 == '18'){echo("selected");}?> value='18'>18</option>
                                        <option <?php if($H1S1 == '19'){echo("selected");}?> value='19'>19</option>
                                        <option <?php if($H1S1 == '20'){echo("selected");}?> value='20'>20</option>
                                        <option <?php if($H1S1 == '21'){echo("selected");}?> value='21'>21</option>
                                        <option <?php if($H1S1 == '22'){echo("selected");}?> value='22'>22</option>
                                
                                    </select>:<select name="Horariomin1ersemestre1">                       
                                    
                                        <option <?php if($M1S1 == '00'){echo("selected");}?> value='00'>00</option>
                                        <option <?php if($M1S1 == '15'){echo("selected");}?> value='15'>15</option>
                                        <option <?php if($M1S1 == '30'){echo("selected");}?> value='30'>30</option>
                                        <option <?php if($M1S1 == '45'){echo("selected");}?> value='45'>45</option>
                    
                                    </select>
                                </td>
                                <?php if($dedicaciondoble): ?>  
                                <td>
                                    <select name="Horarioshora1ersemestre2">                       
                                        <option <?php if($H1S2 == '08'){echo("selected");}?> value='08'>08</option>
                                        <option <?php if($H1S2 == '09'){echo("selected");}?> value='09'>09</option>
                                        <option <?php if($H1S2 == '10'){echo("selected");}?> value='10'>10</option>
                                        <option <?php if($H1S2 == '11'){echo("selected");}?> value='11'>11</option>
                                        <option <?php if($H1S2 == '12'){echo("selected");}?> value='12'>12</option>
                                        <option <?php if($H1S2 == '13'){echo("selected");}?> value='13'>13</option>
                                        <option <?php if($H1S2 == '14'){echo("selected");}?> value='14'>14</option>
                                        <option <?php if($H1S2 == '15'){echo("selected");}?> value='15'>15</option>
                                        <option <?php if($H1S2 == '16'){echo("selected");}?> value='16'>16</option>
                                        <option <?php if($H1S2 == '17'){echo("selected");}?> value='17'>17</option>
                                        <option <?php if($H1S2 == '18'){echo("selected");}?> value='18'>18</option>
                                        <option <?php if($H1S2 == '19'){echo("selected");}?> value='19'>19</option>
                                        <option <?php if($H1S2 == '20'){echo("selected");}?> value='20'>20</option>
                                        <option <?php if($H1S2 == '21'){echo("selected");}?> value='21'>21</option>
                                        <option <?php if($H1S2 == '22'){echo("selected");}?> value='22'>22</option>
                                    
                                    </select>:<select name="Horariomin1ersemestre2">                       
                                        
                                        <option <?php if($M1S2 == '00'){echo("selected");}?> value='00'>00</option>
                                        <option <?php if($M1S2 == '15'){echo("selected");}?> value='15'>15</option>
                                        <option <?php if($M1S2 == '30'){echo("selected");}?> value='30'>30</option>
                                        <option <?php if($M1S2 == '45'){echo("selected");}?> value='45'>45</option>
                        
                                    </select>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <tr class="text-primary">
                                <th colspan="2" class="text-center">Segundo Semestre</th>
                            </tr>
                            <tr>
                                <th>Día</th>
                                <td>
                                    <select name="Dia2dosemestre1">                       
                                        <option <?php if($D2S1 == '1'){echo("selected");}?> value=1>Lunes</option>
                                        <option <?php if($D2S1 == '2'){echo("selected");}?> value=2>Martes</option>
                                        <option <?php if($D2S1 == '3'){echo("selected");}?> value=3>Miércoles</option>
                                        <option <?php if($D2S1 == '4'){echo("selected");}?> value=4>Jueves</option>
                                        <option <?php if($D2S1 == '5'){echo("selected");}?> value=5>Viernes</option>
                                    </select>
                                </td>
                                <?php if($dedicaciondoble): ?>  
                                <td>
                                    <select name="Dia2dosemestre2">                       
                                        <option <?php if($D2S2 == '1'){echo("selected");}?> value=1>Lunes</option>
                                        <option <?php if($D2S2 == '2'){echo("selected");}?> value=2>Martes</option>
                                        <option <?php if($D2S2 == '3'){echo("selected");}?> value=3>Miércoles</option>
                                        <option <?php if($D2S2 == '4'){echo("selected");}?> value=4>Jueves</option>
                                        <option <?php if($D2S2 == '5'){echo("selected");}?> value=5>Viernes</option>
                                    </select>
                                </td>
                                <?php endif; ?>
                            </tr>                   
                            <tr>
                                <th>Horario</th>                        
                                <td>
                                    <select name="Horarioshora2dosemestre1">                       
                                        <option <?php if($H2S1 == '08'){echo("selected");}?> value='08'>08</option>
                                        <option <?php if($H2S1 == '09'){echo("selected");}?> value='09'>09</option>
                                        <option <?php if($H2S1 == '10'){echo("selected");}?> value='10'>10</option>
                                        <option <?php if($H2S1 == '11'){echo("selected");}?> value='11'>11</option>
                                        <option <?php if($H2S1 == '12'){echo("selected");}?> value='12'>12</option>
                                        <option <?php if($H2S1 == '13'){echo("selected");}?> value='13'>13</option>
                                        <option <?php if($H2S1 == '14'){echo("selected");}?> value='14'>14</option>
                                        <option <?php if($H2S1 == '15'){echo("selected");}?> value='15'>15</option>
                                        <option <?php if($H2S1 == '16'){echo("selected");}?> value='16'>16</option>
                                        <option <?php if($H2S1 == '17'){echo("selected");}?> value='17'>17</option>
                                        <option <?php if($H2S1 == '18'){echo("selected");}?> value='18'>18</option>
                                        <option <?php if($H2S1 == '19'){echo("selected");}?> value='19'>19</option>
                                        <option <?php if($H2S1 == '20'){echo("selected");}?> value='20'>20</option>
                                        <option <?php if($H2S1 == '21'){echo("selected");}?> value='21'>21</option>
                                        <option <?php if($H2S1 == '22'){echo("selected");}?> value='22'>22</option>
                                    
                                    </select>:<select name="Horariomin2dosemestre1">                       
                                        
                                        <option <?php if($M2S1 == '00'){echo("selected");}?> value='00'>00</option>
                                        <option <?php if($M2S1 == '15'){echo("selected");}?> value='15'>15</option>
                                        <option <?php if($M2S1 == '30'){echo("selected");}?> value='30'>30</option>
                                        <option <?php if($M2S1 == '45'){echo("selected");}?> value='45'>45</option>
                        
                                    </select>
                                </td>
                                <?php if($dedicaciondoble): ?>  
                                <td>
                                    <select name="Horarioshora2dosemestre2">                       
                                        <option <?php if($H2S2 == '08'){echo("selected");}?> value='08'>8</option>
                                        <option <?php if($H2S2 == '09'){echo("selected");}?> value='09'>9</option>
                                        <option <?php if($H2S2 == '10'){echo("selected");}?> value='10'>10</option>
                                        <option <?php if($H2S2 == '11'){echo("selected");}?> value='11'>11</option>
                                        <option <?php if($H2S2 == '12'){echo("selected");}?> value='12'>12</option>
                                        <option <?php if($H2S2 == '13'){echo("selected");}?> value='13'>13</option>
                                        <option <?php if($H2S2 == '14'){echo("selected");}?> value='14'>14</option>
                                        <option <?php if($H2S2 == '15'){echo("selected");}?> value='15'>15</option>
                                        <option <?php if($H2S2 == '16'){echo("selected");}?> value='16'>16</option>
                                        <option <?php if($H2S2 == '17'){echo("selected");}?> value='17'>17</option>
                                        <option <?php if($H2S2 == '18'){echo("selected");}?> value='18'>18</option>
                                        <option <?php if($H2S2 == '19'){echo("selected");}?> value='19'>19</option>
                                        <option <?php if($H2S2 == '20'){echo("selected");}?> value='20'>20</option>
                                        <option <?php if($H2S2 == '21'){echo("selected");}?> value='21'>21</option>
                                        <option <?php if($H2S2 == '22'){echo("selected");}?> value='22'>22</option>
                                
                                    </select>:<select name="Horariomin2dosemestre2">                       
                                    
                                        <option <?php if($M2S2 == '00'){echo("selected");}?> value='00'>00</option>
                                        <option <?php if($M2S2 == '15'){echo("selected");}?> value='15'>15</option>
                                        <option <?php if($M2S2 == '30'){echo("selected");}?> value='30'>30</option>
                                        <option <?php if($M2S2 == '45'){echo("selected");}?> value='45'>45</option>
                    
                                    </select>
                                </td>
                                <?php endif; ?>
                            </tr>                   
                        </table>
                    </div>      
                <div>
                <br>
                <div class="form-group"> 
                    <div class="col-md-4 col-md-offset-2">
                        <input type='hidden' name='idmateria' value=<?php echo $idmateria?>>
                        <input type='hidden' name='dedicacion' value=<?php echo $dedicacion->getid_dedicacion()?>>
                        <button class="btn btn-success" name="Establecer" type="submit" value=<?php echo $hora->getid_horadeconsulta()?> formaction=<?php echo $crearHorario?>> Establecer 
                            <span class="glyphicon glyphicon-ok"></span>
                        </button>
                    </div>
                </div>            
            </form>
        </div>
        <script src="./../js/jquery.js"></script>
        <script src="./../js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
    </footer>   
</html>