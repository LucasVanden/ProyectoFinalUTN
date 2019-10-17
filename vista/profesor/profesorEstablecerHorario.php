<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
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
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body background = <?php echo $URL.$fondo?>>
        <?php require './../partials/headerp.php' ?>
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
        <h2>Establecer Horario de Consulta:</h2>
        <form action="alumnoPpal.php" method="POST">
            <div>
                <table align='center' id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Nombre</th>
                        <td>
                           <?php echo $nommat?>
<!--                            <select name="Materias">                       
                                <option>Administración de Recursos</option>
                                <option>Administración Gerencial</option>
                            </select> -->
                        </td>
                    </tr>
                    <tr>
                        <th>Dedicación</th>
                        <td>
                        <?php echo $dedicacion->gettipo()?>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Primer Semestre</th>
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
                    <tr>
                        <th>Segundo Semestre</th>
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
                <input type='hidden' name="idmateria" value=<?php echo $idmateria?>></input>
                <input type='hidden' name="dedicacion" value=<?php echo $dedicacion->getid_dedicacion()?>></input>
                <input type="submit" value="Establecer" name="Establecer"  formaction=<?php echo $crearHorario?> />                
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>   
    </footer>  
</html>