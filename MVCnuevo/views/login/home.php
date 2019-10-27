<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script|Playfair+Display|Source+Sans+Pro"> -->
    
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/home.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/media.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/normalize.css">
</head>
<body>
    <div class="logo-home">
        <a href="#"><img src="<?php echo constant('URL'); ?>public/img/logo-unexpo.png" alt=""></a>
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
        <h1>Bienvenido <?php echo $user->getNombre(); ?>, la etapa selecionada es <?php echo $user->getConfiguracion() ?> </h1>
    </section>

    <div class="grid-submenu">
        <form action="<?php echo constant('URL'); ?>configuracion/selectEtapa" method="POST" class=grid-item>
        <p>Selección de etapa</p>
            <select name="opciones" class="box-opcion">
                <option value="Germinacion">Germinacion</option>
                <option value="Crecimiento vegetativo">Crecimiento vegetativo</option>
                <option value="Floracion y Fructificación">Floracion y Fructificación</option>
            </select>
            <input type="submit" value="Enviar">
        </form>
        <form action="#" class=grid-item>
        Elige una opcion
            <select name="opciones" class="box-opcion">
                <option value="1">opcion 1</option>
                <option value="2">opcion 2</option>
                <option value="3">opcion 3</option>
                <option value="4">opcion 4</option>
            </select>
        </form>
        <form action="#" class=grid-item>
        Elige una opcion
            <select name="opciones" class="box-opcion">
                <option value="1">opcion 1</option>
                <option value="2">opcion 2</option>
                <option value="3">opcion 3</option>
                <option value="4">opcion 4</option>
            </select>
        </form>
    </div>
    
    <div class="grid-chart">
        <div id="container1" class=grid-item></div>
        <div id="container2" class=grid-item></div>
        <div id="container3" class=grid-item></div>
    </div>
    
    
    <script>
    
    var chartTemp; // global
    var chartHumed;
    var chartAire;

    function requestData() {
        $.ajax({
            //Cambiar a type: POST si necesario
            type: "POST",
            // Formato de datos que se espera en la respuesta
            dataType: "json",
            // URL a la que se enviará la solicitud Ajax
            url: '<?php echo constant('URL'); ?>arduino/datosGraficarTemp',
            success: function(point) {
                var series = chartTemp.series[0],
                    shift = series.data.length > 10; // shift if the series is   
                                                        // longer than 20  
                // add the point
                chartTemp.series[0].addPoint(point, true, shift);
                
                // call it again after one second
                setTimeout(requestData, 3000);    
            },
            cache: false
        });
    }
    
    function requestData2() {
            $.ajax({
                //Cambiar a type: POST si necesario
                type: "POST",
                // Formato de datos que se espera en la respuesta
                dataType: "json",
                // URL a la que se enviará la solicitud Ajax
                url: '<?php echo constant('URL'); ?>arduino/datosGraficarHumd',
                success: function(point) {
                    var series = chartHumed.series[0],
                        shift = series.data.length > 10; // shift if the series is   
                                                            // longer than 20  
                    // add the point
                    chartHumed.series[0].addPoint(eval(point) , true, shift);
                    
                    // call it again after one second
                    setTimeout(requestData2, 3000);    
                },
                cache: false
            });
        }

        function requestData3() {
            $.ajax({
                //Cambiar a type: POST si necesario
                type: "POST",
                // Formato de datos que se espera en la respuesta
                dataType: "json",
                // URL a la que se enviará la solicitud Ajax
                url: '<?php echo constant('URL'); ?>arduino/datosGraficarAire',
                success: function(point) {
                    var series = chartAire.series[0],
                        shift = series.data.length > 10; // shift if the series is   
                                                            // longer than 20  
                    // add the point
                    chartAire.series[0].addPoint(eval(point) , true, shift);
                    
                    // call it again after one second
                    setTimeout(requestData3, 3000);    
                },
                cache: false
            });
        }

    document.addEventListener('DOMContentLoaded', function() {
        chartTemp = Highcharts.chart('container1', {
            chart: {
                type: 'spline',
                events: {
                    load: requestData
                }
            },
            title: {
                text: 'Temperatura Actual'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'Magnitud',
                    margin: 20
                }
            },
            series: [{
                name: 'Temperatura',
                data: []
            }]
        })   
        
        chartHumed = new Highcharts.chart('container2', {
                chart: {
                    type: 'spline',
                    events: {
                        load: function() {
                        chartHumed = this; // `this` is the reference to the chart
                        requestData2();
                        }   
                    }
                },
                title: {
                    text: 'Grafica tiempo real 2'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Magnitud',
                        margin: 20
                    }
                },
                series: [{
                    name: 'Valores aleatorios',
                    data: []
                }]
            })   

            chartAire = new Highcharts.chart('container3', {
                chart: {
                    type: 'spline',
                    events: {
                        load: function() {
                        chartAire = this; // `this` is the reference to the chart
                        requestData3();
                        }   
                    }
                },
                title: {
                    text: 'Grafica tiempo real 3'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Magnitud',
                        margin: 20
                    }
                },
                series: [{
                    name: 'Valores aleatorios',
                    data: []
                }]
            })
    })


    
    </script>

    <script src="<?php echo constant('URL'); ?>public/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/highcharts.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/data.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/dark-unica.js"></script>

    <footer class="footer">
    
        © Wilson Tovar & Leonardo Galindez 2019

    </footer> 

</body>
</html>
