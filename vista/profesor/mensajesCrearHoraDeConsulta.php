<?php
session_start();
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
require_once $DIR . $profesorControlador;

$idProfesor=$_SESSION['idProfesor'];


$activo11=false;
$activo12=false;
$activo21=false;
$activo22=false;

$DM1S1=null;
$HM1S1=null;
$MM1S1=null;

$DM2S1=null;
$HM2S1=null;
$MM2S1=null;

$DM1S2=null;
$HM1S2=null;
$MM1S2=null;

$DM2S2=null;
$HM2S2=null;
$MM2S2=null;

$mensj= $_SESSION['mensajesCrearHorario'];
if(isset($_POST['dedicacion'])){
$postdedicacion= $_POST['dedicacion'];
}else{
    $postdedicacion=$_SESSION['dedicacionParaqueNoExploteMensaje'];
}

if(isset($_SESSION['horariosdeMesasAagregar'])){
    $mesas=$_SESSION['horariosdeMesasAagregar'];
    foreach ($mesas as $semestreN ) {
        if ($semestreN==11){$activo11=true;}
        if ($semestreN==12){$activo12=true;}
        if ($semestreN==21){$activo21=true;}
        if ($semestreN==22){$activo22=true;}
    }
}

if($activo11||$activo12||$activo21||$activo22){
    $Aceptar = $URL.$crearHorarioDeConsulta;}else{
    $Aceptar = $URL.$profesorPpal;
    }
    if(isset( $_SESSION['seEnvioLosDatosParaLaConsultaEnSemanaDeMesa'])){
        $Aceptar = $URL.$profesorPpal;
    }

if($_SESSION["falloComprobacion"]){
    $Aceptar= $URL.$EstablecerHorario;
}

if((!$_SESSION["falloComprobacion"])&&$_SESSION["igualMesa"]){
    $Aceptar=  $URL.$crearHorarioDeConsulta;
}
if((!$_SESSION["falloComprobacion"])&&$_SESSION["igualMesa"]&& $_SESSION["falloComprobacionMesa"]){
    $Aceptar=  $URL.$crearHorarioDeConsulta;
}
if($_SESSION["Ejecuto"]){
    $Aceptar= $URL.$profesorPpal;
}

echo '$_SESSION["igualMesa"]'.$_SESSION["igualMesa"]; 
echo '$_SESSION["falloComprobacion'.$_SESSION["falloComprobacion"];
echo ' $_SESSION["falloComprobacionMesa"]'.$_SESSION["falloComprobacionMesa"];
echo $Aceptar;



$volver= $URL . $profesorPpal;
$nommat=$_SESSION['nombreMateriaSeleccionadaEnPpal'];
$a=new profesorControlador();
$idmateria= $a->buscarIDdeNombreMateria($nommat);
$dedicacion=$a->buscarDedicaciondeMateria($idmateria,$idProfesor);//id PROFESOR SESSION<---------------------------------------------------------------------------------------------
$cargar=$a->buscarHorariosParallenarEnlosSelect($idmateria,$idProfesor);
if(isset($cargar)){
foreach ($cargar as $horario) {
   if($horario->getsemestre()==31){
       if($horario->getn()==2){
         $DM1S2=$horario->getdia()->getid_dia();
         $HM1S2=date("H", strtotime( $horario->gethora()));
         $MM1S2=date("i", strtotime( $horario->gethora()));
       }else{
         $DM1S1=$horario->getdia()->getid_dia();
         $HM1S1=date("H", strtotime( $horario->gethora()));
         $MM1S1=date("i", strtotime( $horario->gethora()));
       }
   }
   elseif($horario->getsemestre()==32){
     if($horario->getn()==2){
         $DM2S2=$horario->getdia()->getid_dia();
         $HM2S2=date("H", strtotime( $horario->gethora()));
         $MM2S2=date("i", strtotime( $horario->gethora()));
       }else{
         $DM2S1=$horario->getdia()->getid_dia();
         $HM2S1=date("H", strtotime( $horario->gethora()));
         $MM2S1=date("i", strtotime( $horario->gethora()));
       }
}
}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
            <h2 style="align-content: center">Creacion Horario Consulta</h2>    
            <div>       
                    <?php $i=0;
                     foreach ($mensj as $m):?>   
                            <?php echo "-".$m?> <br><br>
                          <?php endforeach; 
                              ?>                                               
            </div>
            <form action="profesorEstablecerHorario.php" method="POST">     
            <div>
<!-- as -->
<?php if($_SESSION['igualMesa']): ?>
<?php if($_SESSION['horariosdeMesasAagregar']): ?>
        <table id="tablaBuscar" style="border-color: #FFFFFF">  
                                
                    <tr>
                        <th>Primer Semestre</th>
                    </tr>
                    <tr>
                        <th>Día</th>
                        <td>
                        <?php if($activo11): ?>  
                            <select name="MesaDia1ersemestre1">                       
                                <option <?php if($DM1S1 == '1'){echo("selected");}?> value=1>Lunes</option>
                                <option <?php if($DM1S1 == '2'){echo("selected");}?> value=2>Martes</option>
                                <option <?php if($DM1S1 == '3'){echo("selected");}?> value=3>Miércoles</option>
                                <option <?php if($DM1S1 == '4'){echo("selected");}?> value=4>Jueves</option>
                                <option <?php if($DM1S1 == '5'){echo("selected");}?> value=5>Viernes</option>
                            </select>
                            <?php endif; ?>
                        </td>
                        <td>
                        <?php if($activo12): ?>  
                            <select name="MesaDia1ersemestre2">                       
                                <option <?php if($DM1S2 == '1'){echo("selected");}?> value=1>Lunes</option>
                                <option <?php if($DM1S2 == '2'){echo("selected");}?> value=2>Martes</option>
                                <option <?php if($DM1S2 == '3'){echo("selected");}?> value=3>Miércoles</option>
                                <option <?php if($DM1S2 == '4'){echo("selected");}?> value=4>Jueves</option>
                                <option <?php if($DM1S2 == '5'){echo("selected");}?> value=5>Viernes</option>
                            </select>
                            <?php endif; ?>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Horario</th>                        
                        <td>
                        <?php if($activo11): ?>  
                            <select name="MesaHorarioshora1ersemestre1">                       
                                <option <?php if($HM1S1 == '08'){echo("selected");}?> value='08'>08</option>
                                <option <?php if($HM1S1 == '09'){echo("selected");}?> value='09'>09</option>
                                <option <?php if($HM1S1 == '10'){echo("selected");}?> value='10'>10</option>
                                <option <?php if($HM1S1 == '11'){echo("selected");}?> value='11'>11</option>
                                <option <?php if($HM1S1 == '12'){echo("selected");}?> value='12'>12</option>
                                <option <?php if($HM1S1 == '13'){echo("selected");}?> value='13'>13</option>
                                <option <?php if($HM1S1 == '14'){echo("selected");}?> value='14'>14</option>
                                <option <?php if($HM1S1 == '15'){echo("selected");}?> value='15'>15</option>
                                <option <?php if($HM1S1 == '16'){echo("selected");}?> value='16'>16</option>
                                <option <?php if($HM1S1 == '17'){echo("selected");}?> value='17'>17</option>
                                <option <?php if($HM1S1 == '18'){echo("selected");}?> value='18'>18</option>
                                <option <?php if($HM1S1 == '19'){echo("selected");}?> value='19'>19</option>
                                <option <?php if($HM1S1 == '20'){echo("selected");}?> value='20'>20</option>
                                <option <?php if($HM1S1 == '21'){echo("selected");}?> value='21'>21</option>
                                <option <?php if($HM1S1 == '22'){echo("selected");}?> value='22'>22</option>
                          
                            </select>:<select name="MesaHorariomin1ersemestre1">                       
                             
                                <option <?php if($MM1S1 == '00'){echo("selected");}?> value='00'>00</option>
                                <option <?php if($MM1S1 == '15'){echo("selected");}?> value='15'>15</option>
                                <option <?php if($MM1S1 == '30'){echo("selected");}?> value='30'>30</option>
                                <option <?php if($MM1S1 == '45'){echo("selected");}?> value='45'>45</option>
              
                            </select>
                            <?php endif; ?>
                        </td>
                        <td>
                        <?php if($activo12): ?>  
                        <select name="MesaHorarioshora1ersemestre2">                       
                                <option <?php if($HM1S2 == '08'){echo("selected");}?> value='08'>08</option>
                                <option <?php if($HM1S2 == '09'){echo("selected");}?> value='09'>09</option>
                                <option <?php if($HM1S2 == '10'){echo("selected");}?> value='10'>10</option>
                                <option <?php if($HM1S2 == '11'){echo("selected");}?> value='11'>11</option>
                                <option <?php if($HM1S2 == '12'){echo("selected");}?> value='12'>12</option>
                                <option <?php if($HM1S2 == '13'){echo("selected");}?> value='13'>13</option>
                                <option <?php if($HM1S2 == '14'){echo("selected");}?> value='14'>14</option>
                                <option <?php if($HM1S2 == '15'){echo("selected");}?> value='15'>15</option>
                                <option <?php if($HM1S2 == '16'){echo("selected");}?> value='16'>16</option>
                                <option <?php if($HM1S2 == '17'){echo("selected");}?> value='17'>17</option>
                                <option <?php if($HM1S2 == '18'){echo("selected");}?> value='18'>18</option>
                                <option <?php if($HM1S2 == '19'){echo("selected");}?> value='19'>19</option>
                                <option <?php if($HM1S2 == '20'){echo("selected");}?> value='20'>20</option>
                                <option <?php if($HM1S2 == '21'){echo("selected");}?> value='21'>21</option>
                                <option <?php if($HM1S2 == '22'){echo("selected");}?> value='22'>22</option>
                          
                            </select>:<select name="MesaHorariomin1ersemestre2">                       
                             
                                <option <?php if($MM1S2 == '00'){echo("selected");}?> value='00'>00</option>
                                <option <?php if($MM1S2 == '15'){echo("selected");}?> value='15'>15</option>
                                <option <?php if($MM1S2 == '30'){echo("selected");}?> value='30'>30</option>
                                <option <?php if($MM1S2 == '45'){echo("selected");}?> value='45'>45</option>
              
                            </select>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Segundo Semestre</th>
                    </tr>
                    <tr>
                        <th>Día</th>
                        <td>
                        <?php if($activo21): ?>  
                            <select name="MesaDia2dosemestre1">                       
                                <option <?php if($DM2S1 == '1'){echo("selected");}?> value=1>Lunes</option>
                                <option <?php if($DM2S1 == '2'){echo("selected");}?> value=2>Martes</option>
                                <option <?php if($DM2S1 == '3'){echo("selected");}?> value=3>Miércoles</option>
                                <option <?php if($DM2S1 == '4'){echo("selected");}?> value=4>Jueves</option>
                                <option <?php if($DM2S1 == '5'){echo("selected");}?> value=5>Viernes</option>
                            </select>
                            <?php endif; ?>
                        </td>
                        <td>
                        <?php if($activo22): ?>  
                            <select name="MesaDia2dosemestre2">                       
                                <option <?php if($DM2S2 == '1'){echo("selected");}?> value=1>Lunes</option>
                                <option <?php if($DM2S2 == '2'){echo("selected");}?> value=2>Martes</option>
                                <option <?php if($DM2S2 == '3'){echo("selected");}?> value=3>Miércoles</option>
                                <option <?php if($DM2S2 == '4'){echo("selected");}?> value=4>Jueves</option>
                                <option <?php if($DM2S2 == '5'){echo("selected");}?> value=5>Viernes</option>
                            </select>
                            <?php endif; ?>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Horario</th>                        
                        <td>
                        <?php if($activo21): ?>  
                        <select name="MesaHorarioshora2dosemestre1">                       
                                <option <?php if($HM2S1 == '08'){echo("selected");}?> value='08'>08</option>
                                <option <?php if($HM2S1 == '09'){echo("selected");}?> value='09'>09</option>
                                <option <?php if($HM2S1 == '10'){echo("selected");}?> value='10'>10</option>
                                <option <?php if($HM2S1 == '11'){echo("selected");}?> value='11'>11</option>
                                <option <?php if($HM2S1 == '12'){echo("selected");}?> value='12'>12</option>
                                <option <?php if($HM2S1 == '13'){echo("selected");}?> value='13'>13</option>
                                <option <?php if($HM2S1 == '14'){echo("selected");}?> value='14'>14</option>
                                <option <?php if($HM2S1 == '15'){echo("selected");}?> value='15'>15</option>
                                <option <?php if($HM2S1 == '16'){echo("selected");}?> value='16'>16</option>
                                <option <?php if($HM2S1 == '17'){echo("selected");}?> value='17'>17</option>
                                <option <?php if($HM2S1 == '18'){echo("selected");}?> value='18'>18</option>
                                <option <?php if($HM2S1 == '19'){echo("selected");}?> value='19'>19</option>
                                <option <?php if($HM2S1 == '20'){echo("selected");}?> value='20'>20</option>
                                <option <?php if($HM2S1 == '21'){echo("selected");}?> value='21'>21</option>
                                <option <?php if($HM2S1 == '22'){echo("selected");}?> value='22'>22</option>
                          
                            </select>:<select name="MesaHorariomin2dosemestre1">                       
                             
                                <option <?php if($MM2S1 == '00'){echo("selected");}?> value='00'>00</option>
                                <option <?php if($MM2S1 == '15'){echo("selected");}?> value='15'>15</option>
                                <option <?php if($MM2S1 == '30'){echo("selected");}?> value='30'>30</option>
                                <option <?php if($MM2S1 == '45'){echo("selected");}?> value='45'>45</option>
              
                            </select>
                            <?php endif; ?>
                        </td>
                        <td>
                        <?php if($activo22): ?>  
                        <select name="MesaHorarioshora2dosemestre2">                       
                                <option <?php if($HM2S2 == '08'){echo("selected");}?> value='08'>8</option>
                                <option <?php if($HM2S2 == '09'){echo("selected");}?> value='09'>9</option>
                                <option <?php if($HM2S2 == '10'){echo("selected");}?> value='10'>10</option>
                                <option <?php if($HM2S2 == '11'){echo("selected");}?> value='11'>11</option>
                                <option <?php if($HM2S2 == '12'){echo("selected");}?> value='12'>12</option>
                                <option <?php if($HM2S2 == '13'){echo("selected");}?> value='13'>13</option>
                                <option <?php if($HM2S2 == '14'){echo("selected");}?> value='14'>14</option>
                                <option <?php if($HM2S2 == '15'){echo("selected");}?> value='15'>15</option>
                                <option <?php if($HM2S2 == '16'){echo("selected");}?> value='16'>16</option>
                                <option <?php if($HM2S2 == '17'){echo("selected");}?> value='17'>17</option>
                                <option <?php if($HM2S2 == '18'){echo("selected");}?> value='18'>18</option>
                                <option <?php if($HM2S2 == '19'){echo("selected");}?> value='19'>19</option>
                                <option <?php if($HM2S2 == '20'){echo("selected");}?> value='20'>20</option>
                                <option <?php if($HM2S2 == '21'){echo("selected");}?> value='21'>21</option>
                                <option <?php if($HM2S2 == '22'){echo("selected");}?> value='22'>22</option>
                          
                            </select>:<select name="MesaHorariomin2dosemestre2">                       
                             
                                <option <?php if($MM2S2 == '00'){echo("selected");}?> value='00'>00</option>
                                <option <?php if($MM2S2 == '15'){echo("selected");}?> value='15'>15</option>
                                <option <?php if($MM2S2 == '30'){echo("selected");}?> value='30'>30</option>
                                <option <?php if($MM2S2 == '45'){echo("selected");}?> value='45'>45</option>
              
                            </select>
                            <?php endif; ?>
                        </td>
                    </tr>                   
                </table>
         <?php endif; ?>
         <?php endif; ?>
<!-- asd -->
            <input type='hidden' name="dedicacion" value=<?php echo $postdedicacion?>></input>
            <input type="submit" name="mesa" value="Aceptar" formaction=<?php echo $Aceptar?> >
            </div>
            </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>   
    </footer>  
</html>