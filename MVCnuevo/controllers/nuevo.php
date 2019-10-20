<?php
//clase Main que es una hija de controller
class Nuevo extends Controller
{
    function __construct()
    {
      parent::__construct();//se manda a llamar al ducnon construct de la clase padre controller
      $this->view->mensaje = "";
      /* echo "<p>Nuevo controlador main</p>"; */
    }

    function render()
    {
      $this->view->render('nuevo/index');//del objeto view se llama al metodo render que muestra la vista main
    }
//RegistrarAlumno es un metodo que se encarga de obtener los datos del index de la vista nuevo y luego los manda x el objeto model y los ejecuta en el metodo insert, estos datos son enviados en forma de array
    function registrarAlumno()
    {
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        $mensaje = "";

        if($this->model->insert(['matricula' => $matricula, 'nombre' => $nombre, 'apellido' => $apellido]))
        {
            $mensaje = "Nuevo alumno creado";
        }
        else
        {
            $mensaje = "La matricula ya existe";
        }

        $this->view->mensaje = $mensaje;
        $this->render();//llamamos a la vista

        //se hace la validacion de que el metodo funciono y se muestra el mensaje, en caso de que no funcionara dentro de el metodo insert esta un mensaje de errror 
    }
}

?>