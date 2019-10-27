<?php
//clase Main que es una hija de controller
class Configuracion extends Controller
{
    function __construct()
    {
      parent::__construct();//se manda a llamar al ducnon construct de la clase padre controller
      /* $selected = $this->model->getConfiguracion(); */
      $this->view->mensaje = "";
      /* echo "<p>Nuevo controlador main</p>"; */
    }

    function render()
    {
      $this->view->render('login/index');//del objeto view se llama al metodo render que muestra la vista main
    }

//Este metodo es el encargado de recibir los datos desde el arduino, recibie con un GET y ejecuta las metodos definidos en arduinomodel.php de esta manera se peude recibir y enviar al mismo tiempo sin afetar al resto de la aplicacion Web
    function selectEtapa()
    {
      
    
      if(isset($_POST['opciones']))
      {
          $this->model->setParametros($_POST['opciones']);
          if($this->model->insert())
          {
              $selected = $this->model->getConfiguracion();
          }
        
      }

      $this->view->mensaje = $selected;

      $this->render();

    }
}

?>