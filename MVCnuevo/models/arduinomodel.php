<?php
//Aca hacemos toda la conexion del arduino con la aplicacion Web, estan definidos los metodos para setear los parametros, enviar a la db y extraer de la db

class ArduinoModel extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    /* private $totalVotes;//conteo de numero de votos */
    private $temperatura;
    private $humedad;
    private $etapa;
    private $valor1;
    private $valor2;

    public function setParametros($parametro1, $parametro2)//eta fuincion guarda la opcion que elegi
    {
        $this->temperatura = $parametro1;
        $this->humedad = $parametro2;
    }

    public function envio()//enviar los datos a la bd
    {
        $query = $this->connect()->prepare('INSERT INTO `parametros`(`temperatura`, `humedad`) VALUES (:temp, :hum)');
        $query->execute(['temp' => $this->temperatura, 'hum' => $this->humedad]);
    }

    public function getParametros()//extraer los datos de la bd
    {
        //seleciona el maximo id de la tabla y regresa un objeto PDO este valor lo guarda para usarlo luego
        $query = $this->connect()->query('SELECT MAX(id) AS id_max FROM `parametros`');
        $id_maximo = $query->fetch(PDO::FETCH_OBJ)->id_max;

        //Con el id_maximno obtenido se hace una busqueda en la tabla donde la humedad se la mas actual
        $query = $this->connect()->query('SELECT `humedad` FROM `parametros` WHERE id = ' . $id_maximo);
        $valor_deseado = $this->humedad = $query->fetch(PDO::FETCH_OBJ)->humedad;

        //Con el id_maximno obtenido se hace una busqueda en la tabla donde la humedad se la mas actual
        $query = $this->connect()->query('SELECT `temperatura` FROM `parametros` WHERE id = ' . $id_maximo);
        $valor_deseado2 = $this->temperatura = $query->fetch(PDO::FETCH_OBJ)->temperatura;

        //finalmente se escriben esos datos en un formato que el arduino pueda reconcoer y almacenar
        echo $valor_deseado . '*' . $valor_deseado2 . '*';
    }

    public function getConfiguracion()
    {
        $query = $this->connect()->query('SELECT MAX(id) AS id_max FROM `configuracion`');
        $id_maximo = $query->fetch(PDO::FETCH_OBJ)->id_max;

        $query = $this->connect()->query('SELECT `etapa` FROM `configuracion` WHERE id = ' . $id_maximo);
        $valor_deseado = $this->etapa = $query->fetch(PDO::FETCH_OBJ)->etapa;

        
        $query = $this->connect()->query('SELECT `valor1` FROM `configuracion` WHERE id = ' . $id_maximo);
        $valor_deseado2 = $this->valor1 = $query->fetch(PDO::FETCH_OBJ)->valor1;

        echo $valor_deseado . '*' . $valor_deseado2 . '*';
    }
/*
    public function getParametros() // esta funcion me permete regresar el valor selecionado
    {
        return $this->temperatura;
        return $this->humedad;
    }
*/
//usamos prepare y execute xq tenemos que validar que sea el tipo de dato que deseamos y asi tener buena seguridad
    

//usamos query xq no tenemos que validar, vamos a sacar un dato de la base de datos
    /* public function showResults()
    {
        return $this->connect()->query('SELECT * FROM lenguajes');
    } */
//SELECT MAX(id) AS id FROM `tesis`
//SELECT `humedad` FROM `tesis` WHERE id = el maximo

//Con esta funcion obetenemos el ultimo valor introducido de cualquier tabla
    

    /* public function getPercentageVotes($votes)
    {
        return round(($votes / $this->totalVotes) * 100, 0);
    } */
}
 ?>
