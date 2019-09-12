//alumno inscribiendose a consulta
function asistirconsulta() { //funciona
    document.getElementById("buttonAsistir").innerHTML;
    // window.location.replace("http://localhost:8888/pikbguv/alumno/alumnoConfirmarAsistencia.php");
}

function confirmarasistencia() { //no esta funcionando
    document.getElementById("buttonConfirmar").innerHTML;
    //    guardar inscripcion en la db
    // mostrar mensaje de inscripcion correcta
    // prompt("picachu", "...");
    //window.location.replace("http://localhost/ProyectoFinalUTN/vista/alumno/alumnoPpal.php");    
    window.location.replace(alumnoppal);
}

function buscarHorarios(materia, profesor) { //no esta funcionando
    document.getElementById("buttonBuscar").innerHTML;
    //    guardar inscripcion en la db
    // mostrar mensaje de inscripcion correcta
    prompt("lelele" + materia.value + "_" + profesor.value);
    // if (false) {
    //     window.location.replace("http://localhost:8888/PFProyect/vista/alumno/busquedaPorMateria.php");
    // } else {
    //     window.location.replace("http://localhost:8888/PFProyect/vista/alumno/busquedaPorProfesor.php");
    // }

}

function buscarHorariosporMateria($a) {
    prompt($a);
    localStorage.setItem("id_materia", $a);

}

function returnid_materia() {
    var m = localStorage.getItem("id_materia");
    //prompt(m);
}