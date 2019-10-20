<?php

$userSession = new UserSession(); // se crea un objeto de userSession
$user = new UserModel();

if(isset($_SESSION['user'])) //si existe una session
{
    $user->setUser($userSession->getCurrentUser()); //recupera el usuario
    include_once 'home.php';

}elseif (isset($_POST['username']) && isset($_POST['password'])) //si se envia desde el form datos entra aqui
{
    $userForm = $_POST['username']; //guarda el username
    $passForm = $_POST['password']; //guarda el password

    if($user->userExists($userForm, $passForm)) //si el usuario existe
    {
        $userSession->setCurrentUser($userForm);  //asigna el usuario a userSession
        $user->setUser($userForm);  //guarda de la base de datos, en la clase user el username y el nombre

        include_once 'home.php';
    }else
    {
        $errorLogin = "Nombre de usuario y/o password es incorrecto";
        include_once 'login.php';
    }
}else
{
    include_once 'login.php';
}

 ?>