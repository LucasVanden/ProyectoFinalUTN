<?php 
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';

require $DIR.$conexion;
require $DIR.$Asueto;
require_once ($DIR . $Alumno);
require_once ($DIR . $Materia);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $Departamento);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $EstadoAnotados);
require_once ($DIR . $AvisoProfesor);
require_once ($DIR . $Dedicacion);
require_once ($DIR.$controladorAdministrador);
$marcarAsuetoReceso= $URL.$marcarAsuetoReceso;
?>
<html>
<body>


<style>
* {box-sizing: border-box;}
ul {list-style-type: none;}
body {font-family: Verdana, sans-serif;}

.month {
  padding: 20px 25px;
  width: 100%;
  background: #1abc9c;
  text-align: center;
}

.month ul {
  margin: 0;
  padding: 0;
}

.month ul li {
  color: white;
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: 3px;
}

.month .prev {
  float: left;
  padding-top: 10px;
}

.month .next {
  float: right;
  padding-top: 10px;
}

.weekdays {
  margin: 0;
  padding: 0px 0;
  background-color: #ddd;
  width: 100%;
}

.weekdays li {
  display: inline-block;
  margin-right: -4px;
  width: 13.6%;
  color: #666;
  text-align: center;
}

.days {
  padding: 1px 0;
  background: #eee;
  margin: 0;
  width: 100%;
}

.days li {
  list-style-type: none;
  display: inline-block;
  margin-right: -4px;
  width: 13.6%;
  text-align: center;
  margin-bottom: 5px;
  font-size:12px;
  color: #777;
}

.days li .active {
  padding: 5px;
  background: #1abc9c;
  color: white !important
}

/* Add media queries for smaller screens */
@media screen and (max-width:720px) {
  .weekdays li, .days li {width: 13.1%;}
}

@media screen and (max-width: 420px) {
  .weekdays li, .days li {width: 12.5%;}
  .days li .active {padding: 2px;}
}

@media screen and (max-width: 290px) {
  .weekdays li, .days li {width: 12.2%;}
}

main {
  display: grid;
  grid-gap: 1rem;
  grid-template-columns: 1fr 1fr 1fr ;
  grid-template-rows: 1fr 1fr 1fr 1fr;
}

.Row
{
    display: table;
    width: 100%; /*Optional*/
    table-layout: fixed; /*Optional*/
    border-spacing: 10px; /*Optional*/
}
.Column
{
    display: table-cell;
    background-color: white; /*Optional*/
}

</style>

<?php 
$year=date("Y");

if (isset($_POST["anterior"])){
    $year=$_POST["anterior"]-1;
}
if (isset($_POST["siguiente"])){
    $year=$_POST["siguiente"]+1;
}
?>

<div class="Row">
    <div class="Column" align='right'> 
        <form action="temp.1.php" method="POST" class="form-horizontal">
            <button style="height:75;width:75" type="submit" name="anterior" value=<?php echo $year?>><</button>
        </form>
    </div>

    <div class="Column" align='center'> 
        <button style="height:75;width:100%;font-size: 25px"  > <?php echo $year?> </button>
    </div>

    <div class="Column" align='left'> 
        <form action="temp.1.php" method="POST" class="form-horizontal">
            <button style="height:75;width:75"  type="submit" name="siguiente" value=<?php echo $year?>>></button>
        </form>
    </div>
</div>

<form action=<?php echo $marcarAsuetoReceso?> method="POST" class="form-horizontal">
    <div>
        <?php $con= new controladorAdministrador;?>
        
        <main>
        <div>
        <?php
        $month="01";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                <li>
                <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white;height:30;width:75" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                </li>
            <?php else:?>
                <li>
                <button name="fechadia" type="submit" style="background-color:#white;color:black;height:30;width:75" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- //2 -->
        <div>
        <?php $month="02";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 3 -->
        <div>
        <?php
        $month="03";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 4 -->
        <div>
        <?php
        $month="04";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 5 -->
        <div>
        <?php
        $month="05";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 6 -->
        <div>
        <?php
        $month="06";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 7 -->
        <div>
        <?php
        $month="07";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 8 -->
        <div>
        <?php
        $month="08";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 9 -->
        <div>
        <?php
        $month="09";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 10 -->
        <div>
        <?php
        $month="10";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 11 -->
        <div>
        <?php
        $month="11";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
        <!-- 12 -->
        <div>
        <?php
        $month="12";
        
        $listaAsuetos=$con->ConsultarAsueto($year,$month);
        ?>
        <div class="month">      
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li>
            <?php echo date("F",strtotime($year."-".$month."-01"))?><br>
            <span style="font-size:18px"><?php echo $year?></span>
            </li>
        </ul>
        </div>

        <ul class="weekdays" >
        <li>L</li>
        <li>M</li>
        <li>M</li>
        <li>J</li>
        <li>V</li>
        <li>S</li>
        <li>D</li>
        </ul>

        <ul class="days">
        <?php for ($i = 1; $i < date("N",strtotime($year."-".$month."-01")) ;$i++) : ?>
            <li></li>
        <?php endfor ;?>

        <?php $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);?>
        <?php for ($i = 1; $i <= $days ;$i++) : ?>
            <?php if (in_array($i,$listaAsuetos)) :?>
                 <li>                 
                 <button name="fechadia" type="submit" style="background-color:#1abc9c;color:white" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>    
                </li>
            <?php else:?>
               <li>                 <button name="fechadia" type="submit" style="background-color:#white;color:black" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>                 </li>
            <?php endif;?>
        <?php endfor;?>
        </ul>
        </div>
</form>

<?php echo $_POST["fechadia"];?>
</body>
<footer>
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>

