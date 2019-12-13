<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!in_array(4,$_SESSION['permisos'])){
        header('location: '. $URL.$login);
    }
  }
  
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);
require_once ($DIR.$controladorAdministrador);
$controladorMesas= $URL.$controladorMesas;
$controladorBuscarMesa= $URL.$controladorBuscarMesa;
$controladorEliminarMesa= $URL.$controladorEliminarMesa;
$marcarfechaMesa= $URL.$marcarfechaMesa;

$MenuIndex= $URL.$MenuIndex;

$fechaMesaIngresar="'".date("Y-m-d")."'";
if(isset($_SESSION['FechaMesaIngresada'])){
 $fechaMesaIngresar=$_SESSION['FechaMesaIngresada'];
 }

$año=date('Y'); 
$buscar=false;
if(isset($_SESSION['fechasBuscadas'])){
    $buscar=true;
 }
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
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,  minimum-scale=1.0">
        <title>Mesas</title>
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/> 
    </head>
    <body onload="myFunction()" background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
    <style>
        html, body{
            text-align: left;      
        }
    </style>
        <?php require './../partials/headera.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <form action=<?php echo $controladorMesas ?> method="POST" align="center"> 
        <br>
            <div class="form-group" align="center">
                <h2 for="menuindex" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;">Cargar Fecha de Mesa</h2>
            </div>
            <div class="container" align="center">
                <div class="table-responsive col-md-5 col-md-offset-4">
                    <table class="table table-bordered table-hover" id="tablaBuscar">                     
                        <tr class="info">
                            <th>Fecha Mesa</th>
                            <td>
                                <input class="form-control" type="date" id="f1" name="fechaMesa" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechaMesaIngresar;?>>   
                            </td>
                        </tr>                
                    </table>
                </div>
            </div>
            <br>
            <div class="form-group" align="center"> 
                <button class="btn btn-success" id="Cargar" value="Cargar" name="Obtener" type="submit" formaction=<?php echo $controladorMesas ?>> <b>  +  Cargar  </b>  
                    <span class="glyphicon glyphicon-ok"></span>
                </button> 
                <button class="btn btn-danger" id="Borrar" type="submit"  value="Borrar" name="Obtener" formaction=<?php echo $controladorMesas ?>> <b>  -  Borrar  </b>  
                    <span class="glyphicon glyphicon-remove"></span>
                </button> 
            </div> 

        <!-- <tr>
                        <th>Buscar mesas del año:</th>
                        <td>
                        <input type="number" name="año" min="1900" max="2200" step="1" value=<?php echo $año?> />
                        </td>
                        <br>

                    </tr>    
                                <div>  <input type="submit" value="Buscar fecha Mesas" name="Buscar" formaction=<?php echo $controladorBuscarMesa ?> /></div>
                                <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $MenuIndex ?> /></div> -->
                    </form>

    <!-- <?php if ($buscar): ?>
<table>

<?php

foreach ($_SESSION['fechasBuscadas'] as $fecha): ?> 
<tr>
<td>
<?php   echo $fecha." " ?>
<button type="submit" value=<?php echo $fecha?> name="fechaAborrar" formaction=<?php echo $controladorEliminarMesa ?> onclick="return confirm('Esta seguro que desea eliminar fecha <?php echo $fecha?> ')"> Eliminar</input>

</td>
</tr>

<?php endforeach; ?>

</table>

     <?php endif; ?> -->


<!-- Setear Año -->
<?php 
            $year=date("Y");
            if(isset($_SESSION["year"])){
                $year=$_SESSION["year"];
            }

            if (isset($_POST["anterior"])){
                $year=$_POST["anterior"]-1;
                $_SESSION["year"]=$year;
            }
            if (isset($_POST["siguiente"])){
                $year=$_POST["siguiente"]+1;
                $_SESSION["year"]=$year;
            }
        
?>
<!-- CALENDARIO -->
<iframe width="0" height="0" border="0" name="dummyframe" id="dummyframe"></iframe>
   

<!-- STYLE calendario -->
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
    grid-template-columns:400px 400px 400px ;
    grid-template-rows: 1fr 1fr 1fr 1fr;
    justify-content: center;
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
      
    }
    .cuadrodia{
        height:30;
        width:50;
        color:black;
    }
    .cuadroDiaMacado{
        height:30;
        width:50;
        background-color:#1abc9c;
        color:white;
    }
    .feriado{
        height:30;
        width:50;
        background-color:red;
        color:white;
    }
    .receso{
        height:30;
        width:50;
        background-color:blue;
        color:white;
    }
</style>

<!-- Cabecera Año -->
<div class="Row" >
    <div class="Column" align='right' > 
        <form action="Mesas.php" method="POST" class="form-horizontal">
            <button style="height:75;width:75" type="submit" name="anterior"  onclick="recargarCalendario()" value=<?php echo $year?>><</button>
        </form>
    </div>

    <div class="Column" align='center' > 
        <button style="height:75;width:100%;font-size: 25px"  > <?php echo $year?> </button>
    </div>

    <div class="Column" align='left'> 
        <form action="Mesas.php" method="POST" class="form-horizontal">
            <button style="height:75;width:75"  type="submit" name="siguiente"  onclick="recargarCalendario()" value=<?php echo $year?>>></button>
        </form>
    </div>
</div>
<!-- Calendario -->
<form action=<?php echo $marcarfechaMesa?> method="POST" class="form-horizontal" target="dummyframe">
        <?php $con= new controladorAdministrador;?>  
    <div id="div">
        <main >
            <!-- 1 -->
            <div >
                <?php $month="01";
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                    <ul>
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

                        <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- //2 -->
            <div>
                <?php $month="02";
                
                  $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 3 -->
            <div>
                <?php
                $month="03";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                    <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 4 -->
            <div>
                <?php
                $month="04";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 5 -->
            <div>
                <?php
                $month="05";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 6 -->
            <div>
                <?php
                $month="06";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 7 -->
            <div>
                <?php
                $month="07";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 8 -->
            <div>
                <?php
                $month="08";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 9 -->
            <div>
                <?php
                $month="09";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 10 -->
            <div>
                <?php
                $month="10";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 11 -->
            <div>
                <?php
                $month="11";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
            <!-- 12 -->
            <div>
                <?php
                $month="12";
                
                $listaAsuetos=$con->ConsultarMesa($year,$month); 
                $listaFeriados=$con->ConsultarAsuetoFeriado($year,$month); 
                $listaRecesos=$con->ConsultarAsuetoReceso($year,$month); ?>
                <div class="month">      
                <ul>
                    
                    
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
                <?php if (in_array($i,$listaFeriados)) :?>
                            <li >
                            <button class="feriado" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                            <?php elseif  (in_array($i,$listaRecesos)) :?>
                            <li >
                            <button class="receso" name="fechadia" type="button" disabled   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php elseif (in_array($i,$listaAsuetos)) :?>
                            <li>
                            <button class="cuadroDiaMacado" name="fechadia" type="submit"   onclick="recargarCalendario()" value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            <!-- <button type="button" onclick="openForm()">Open Form</button> -->
                            </li>
                        <?php else:?>
                            <li>
                            <button class="cuadroDia" name="fechadia" type="submit"  onclick="recargarCalendario()"  value=<?php echo $year."-"."$month"."-".$i?>> <?php echo $i?></button>
                            </li>
                        <?php endif;?>
                    <?php endfor;?>
                </ul>
            </div>
        </main>
    </div>
</form>
<!-- Cartel PopUp al clickear Fecha -->
<div id="snackbar">
    <?php 

    if( $_SESSION["agrego"]&&$_SESSION["elimino"]==NULL){
        echo "Se agrego la Fecha";}
    if( $_SESSION["elimino"]&&$_SESSION["agrego"]==NULL){
        echo "Se elimino la Fecha";}
    if( $_SESSION["esferiado"]){
        echo "No puede en Asueto";}
        ?>
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
    function myFunction() {
    // Get the snackbar DIV

    if(<?php echo ($_SESSION["agrego"]||$_SESSION["elimino"]||$_SESSION["esferiado"]); ?>){
    var x = document.getElementById("snackbar");
    <?php 
    $_SESSION["agrego"]=NULL;
    $_SESSION["elimino"]=NULL; 
    $_SESSION["esferiado"]=NULL; ?>
    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }


    } 
</script>

<!-- style CARTEL POPUP para ingresar desde hasta -->
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box;}



    /* The popup form - hidden by default */
    .form-popup {
    display: none;
    position: fixed;
    bottom: 0;
    right: 15px;
    border: 3px solid #f1f1f1;
    z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
    max-width: 300px;
    padding: 10px;
    background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=time], .form-container input[type=time] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
    background-color: #ddd;
    outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom:10px;
    opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
    background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
    opacity: 1;
    }
</style>

<!-- CARTEL POPUP para ingresar desde hasta -->
<div class="form-popup" id="myForm">
    <form action="/hp" class="form-container">
        <h1>Login</h1>

        <label for="time"><b>Hora Desde</b></label>
        <input type="time" placeholder="Enter Email" name="horaDesde" required>

        <label for="time"><b>Hora Hasta</b></label>
        <input type="time" placeholder="Enter Password" name="horaHasta" min="00:00" max="10:00"required>

        <button type="submit" class="btn">Login</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>
<!-- funcion CARTEL POPUP para ingresar desde hasta -->
<script>
    function openForm() {
    document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
    document.getElementById("myForm").style.display = "none";
    }
</script>

<!-- funcion recargarCalendario -->
<script>
    function recargarCalendario(){
        setTimeout(function(){
            $("#div").load(" #div");
        }, 250);
    }
</script>
<br>
<div align="center">
<button style="width:75" class="feriado" disabled>Feriado</button>
<button style="width:75" class="receso" disabled>Receso</button>
<br>
</div>
<br>
    <footer>
       <?php require $DIR.$footer; ?>         
    </footer>  
</html>