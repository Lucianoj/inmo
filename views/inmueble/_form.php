<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TipoInmueble;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Inmueble */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inmueble-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row"><br>
        <div class="panel panel-default">
            <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-info-circle"></i> Complete los datos del
                    Inmueble </h4></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col col-lg-4">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col col-lg-4">
                        <?= $form->field($model, 'tipo_inmueble_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(TipoInmueble::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ]); ?>

                    </div>
                    <div class="col col-lg-4">
                        <?= $form->field($model, 'cantidad_habitaciones')->textInput(['type' => 'number']) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-8">
                        <?= $form->field($model, 'direccion')->textInput(['maxlength' => true, 'id' => 'address', 'placeholder' => 'Calle Ejemplo 123, Neuquén, Neuquén']) ?>
                    </div>
                    <div class="col col-lg-2"><br>
                        <a class="btn btn-info" id="enviar" value="Geocode">Verificar Dirección</a>
                    </div>
                    <div class="col col-lg-2"><br>
                        <?= $form->field($model, 'tiene_garage')->checkbox(['yes', 'no']) ?>
                    </div>

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
                    </div>
                </div>

                <?= $form->field($model, 'latitud')->hiddenInput(['id' => 'lat'])->label(false) ?>
                <?= $form->field($model, 'longitud')->hiddenInput(['id' => 'long'])->label(false) ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Cargar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: {lat: -38.9516784, lng: -68.05918880000002}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('enviar').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });
    }

    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
                jQuery('#lat').val(results[0].geometry.location.lat());
                jQuery('#long').val(results[0].geometry.location.lng());
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD5TwT3vXLfYEv9WD-kOcEg7YQLcncsls&signed_in=true&callback=initMap" async defer></script>


