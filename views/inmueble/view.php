<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inmueble */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Inmuebles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inmueble-view">

    <h1 class="text-center text-info"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
//        echo Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-list"></i> Detalles del Inmueble </h4></div>
            <div class="panel-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
            //            'id',
//                        'nombre',
            //            'latitud',
            //            'longitud',
                        'tipoNombre:html:Tipo',
                        'direccion',
                        'cantidad_habitaciones',
                        'tieneGarageSiNo:html:Tiene Garage',
                    ],
                ]) ?>
                <div class="panel panel-info">
                    <div class="panel-heading"><h4 class="text-muted"><i class="fa fa-map-marker"></i> Intereses cercanos </h4></div>
                    <div class="panel-body">

                        <div  class="row">
                            <form id="formulario" action="#" method="post">
                                <div class="col col-lg-5">
                                    <label class="text-muted">Interes</label>
                                    <select id="type" class="form-control" name="opcion">
                                        <option value="">Seleccione Opción</option>
                                        <option value="bank">Bancos</option>
                                        <option value="cafe">Bares</option>
                                        <option value="night_club">Boliches</option>
                                        <option value="atm">Cajeros</option>
                                        <option value="movie-theater">Cines - Teatros</option>
                                        <option value="stadium">Estadios</option>
                                        <option value="church">Iglesias</option>
                                        <option value="car_wash">Lavadero de Autos</option>
                                        <option value="museum">Museos</option>
                                        <option value="police">Policía</option>
                                        <option value="restaurant">Restaurantes</option>
                                        <option value="university">Universidades</option>
                                        <option value="veterinary_care">Veterinaria</option>
                                    </select>
                                </div>
                                <div class="col col-lg-5">
                                    <label class="text-muted">Radio</label>
                                    <select id="radio" class="form-control" name="radio">
                                        <option value="">Seleccione Radio...</option>
                                        <option value="100">100 ms</option>
                                        <option value="500">500 ms</option>
                                        <option value="1000">1000 ms</option>
                                        <option value="5000">5000 ms</option>
                                        <option value="10000">10000 ms</option>
                                        <option value="50000">50000 ms</option>
                                    </select>
                                </div>
                                <div class="col col-lg-2"><br>
                                    <a class="btn btn-info" id="enviar" value="Geocode">Consultar</a>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col col-lg-2"><br>
                            </div>
                            <div class="col col-lg-8"><br>
                                <div class="panel">
                                    <div class="panel panel-body panel-info">
                                        <div id='map' style='width:700px; height:400px;'></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-2">
                                <input id="lat" type="hidden" value="<?=$model->latitud?>">
                                <input id="long" type="hidden" value="<?=$model->longitud?>">
                                <div id="message"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

<!-- Importar jQuery -->
<!--<script type="text/javascript" src="../libs/js/jquery-3.min.js"></script>-->

<!-- Importar bootstrap JS -->
<!--<script type="text/javascript" src="../libs/js/bootstrap.min.js"></script>-->

<!-- Importar API Google-Places JS -->
<!--        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJN1t_tDeuEmsRUsoyG83frY4&key=AIzaSyC5nmMl8WaACnrlO_Y1o-wyi7LPp5VHoBw"></script>-->

<!--        <script type="text/javascript" src="../../web/addSiteApi.json"></script>-->

        </div>
    </div>
</div>
<?php
$url = \Yii::$app->getUrlManager()->createUrl('inmueble/get-data-google-maps');
?>
<script>

    function initMap() {
        var latitud = jQuery('#lat').val();
        var longitud = jQuery('#long').val();
        var ubicacion = new google.maps.LatLng(latitud, longitud);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: ubicacion
        });
        var geocoder = new google.maps.Geocoder();

        var latitud = jQuery('#lat').val();
        var longitud = jQuery('#long').val();
        var ubicacion = new google.maps.LatLng(latitud, longitud);
        var marker = new google.maps.Marker({
            map: map,
            position: ubicacion
        });

        document.getElementById('enviar').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });
    }

    function marcarMapa(data, map) {
        var info = $.parseJSON(data);
        for (var i = 0; i < info.results.length; i++) {
            var marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(info.results[i].geometry.location.lat, info.results[i].geometry.location.lng),
                label: info.results[i].name,
                icon: info.results[i].icon,
            });

        }
    }

    function geocodeAddress(geocoder, map) {
        var latitud = jQuery('#lat').val();
        var longitud = jQuery('#long').val();
        var ubicacion = new google.maps.LatLng(latitud, longitud);
        var type = jQuery('#type').val();
        var radio = jQuery('#radio').val();
        var marker = new google.maps.Marker({
            map: map,
            position: ubicacion
        });

        var data = {
            url: 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' + latitud + ',' + longitud + '&radius=' + radio + '&type=' + type + '&name=cruise&key=AIzaSyCD5TwT3vXLfYEv9WD-kOcEg7YQLcncsls',
        }

        jQuery.ajax({
            type: 'GET',
            data : data,
            url: '<?=$url?>',
            success:  function(data) {
                marcarMapa(data, map);

            },
            error: function(e) {
                console.log('error:' + e.message);
            }
        });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD5TwT3vXLfYEv9WD-kOcEg7YQLcncsls&callback=initMap" async defer></script>