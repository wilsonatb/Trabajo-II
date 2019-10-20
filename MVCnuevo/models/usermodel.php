<?php

/* include_once 'database.php'; */

class UserModel extends Database
{
    private $nombre;
    private $username;

    public function userExists($user, $pass) //revisa si el usuario existe en la base de datos
    {
        $md5pass = $pass;

        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);

        if($query->rowCount()) //si encuentra una fila entonces existe usuario
        {
            return true;
        }else {
            return false;
        }
    }

    public function setUser($user)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser)
        {
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
        }
        return $this->nombre;
    }

    public function getNombre()//permite obtener el nombre del usuario activo
    {
        return $this->nombre;
    }

    public function getConfiguracion()
    {
        $query = $this->connect()->query('SELECT MAX(id) AS id_max FROM `configuracion`');
        $id_maximo = $query->fetch(PDO::FETCH_OBJ)->id_max;

        $query = $this->connect()->query('SELECT `etapa` FROM `configuracion` WHERE id = ' . $id_maximo);
        $valor_deseado = $this->etapa = $query->fetch(PDO::FETCH_OBJ)->etapa;

        return $valor_deseado;

    }
}

 ?>