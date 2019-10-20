<?php

class NuevoModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
// el metodo insert hace la conexion con la base de datos, hace la preparacion de la peticion y la ejecuta para evitar inytecccion de datos, en caso de que no se logre la solicitud en este caso x matricula repetida se indica con un echo, y se regresa el valor false que retornara al controlador nuevo
    public function insert($datos)
    {
        //insertar datos en la base de datos
        try 
        {
            $query = $this->db->connect()->prepare('INSERT INTO alumnos (matricula, nombre, apellido) VALUES (:matricula, :nombre, :apellido)');
            $query->execute(['matricula' => $datos['matricula'], 'nombre' => $datos['nombre'], 'apellido' => $datos['apellido']]);
            return true;
        } catch (PDOException $e) 
        {
            return false;
        }
        
    }
}

?>