<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script|Playfair+Display|Source+Sans+Pro">
    
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/home.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/media.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/normalize.css">
</head>
<body>
    <div class="logo-home">
        <a href="#"><img src="public/img/logo-unexpo.png" alt=""></a>
    </div>
    
    <div id="menu">       
         <ul>
            <li><a href="<?php echo constant('URL'); ?>main">Inicio</a></li>
            <li><a href="<?php echo constant('URL'); ?>nuevo">Buscar</a></li>
            <li><a href="<?php echo constant('URL'); ?>consulta">Ayuda</a></li>
            <li><a href="<?php echo constant('URL'); ?>logout">Cerrar sesión</a></li>
        </ul>
    </div>

    <section>
        <h1>Bienvenido <?php echo $user->getNombre(); ?>, la estapa selecionada es <?php echo $user->getConfiguracion() ?> </h1>
    </section>

    <div class="grid-submenu">
        <form action="<?php echo constant('URL'); ?>configuracion/selectEtapa" method="POST" class=grid-item>
        <p>Selección de etapa</p>
            <select name="opciones" id="">
                <option value="1">Germinacion</option>
                <option value="2">Crecimiento vegetativo</option>
                <option value="3">Floracion y Fructificación</option>
            </select>
            <input type="submit" value="Enviar">
        </form>
        <form action="#" class=grid-item>
        Elige una opcion
            <select name="opciones" id="">
                <option value="1">opcion 1</option>
                <option value="2">opcion 2</option>
                <option value="3">opcion 3</option>
                <option value="4">opcion 4</option>
            </select>
        </form>
        <form action="#" class=grid-item>
        Elige una opcion
            <select name="opciones" id="">
                <option value="1">opcion 1</option>
                <option value="2">opcion 2</option>
                <option value="3">opcion 3</option>
                <option value="4">opcion 4</option>
            </select>
        </form>
    </div>
    

    

    <footer class="footer">
    
        © Wilson Tovar & Leonardo Galindez 2019

    </footer> 

</body>
</html>
