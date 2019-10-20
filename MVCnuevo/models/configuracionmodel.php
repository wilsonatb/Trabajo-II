<?php

class ConfiguracionModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setParametros($parametro1)//eta fuincion guarda la opcion que elegi
    {
        $this->etapa = $parametro1;
    }
// el metodo insert hace la conexion con la base de datos, hace la preparacion de la peticion y la ejecuta para evitar inytecccion de datos, en caso de que no se logre la solicitud en este caso x matricula repetida se indica con un echo, y se regresa el valor false que retornara al controlador nuevo
    public function insert()
    {
        //insertar datos en la base de datos
        try 
        {
            $query = $this->db->connect()->prepare('INSERT INTO configuracion (etapa) VALUES (:etapa)');
            $query->execute(['etapa' => $this->etapa]);

            return true;
        } catch (PDOException $e) 
        {
            return false;
        }
        
    }

    public function getConfiguracion()
    {
        $query = $this->db->connect()->query('SELECT MAX(id) AS id_max FROM `configuracion`');
        $id_maximo = $query->fetch(PDO::FETCH_OBJ)->id_max;

        $query = $this->db->connect()->query('SELECT `etapa` FROM `configuracion` WHERE id = ' . $id_maximo);
        $valor_deseado = $this->etapa = $query->fetch(PDO::FETCH_OBJ)->etapa;

        return $valor_deseado;

    }
}

?>