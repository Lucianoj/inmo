<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\InmuebleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' Inmuebles';
?>
<div class="inmueble-index">

    <h1 class="text-center text-info"><i class="fa fa-home"></i> <?= Html::encode($this->title) ?></h1><br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Cargar Nuevo Inmueble', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'nombre',
            'label' => 'Título',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $grid) {
                return Html::encode($model->nombre);
            },
        ],
        [
            'attribute' => 'cantidad_habitaciones',
            'label' => 'Cantidad de Habitaciones',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $grid) {
                return Html::encode($model->cantidad_habitaciones);
            },
        ],
        [
            'attribute' => 'tiene_garage',
            'label' => 'Garage',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $grid) {
                return $model->tiene_garage?'<div class=\'text-success\'>Sí</div>':'<div class=\'text-danger\'>No</div>';
            },
        ],
        [
            'attribute' => 'tipo.nombre',
            'label' => 'Tipo de Inmueble',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $grid) {
                return Html::encode($model->tipoNombre);

            },
        ],
        ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'pjaxContainerId' => 'kv-pjax-container',
        'dropdownOptions' => [
            'label' => 'Todo',
            'class' => 'btn btn-default',
            'itemsBefore' => [
                '<li class="dropdown-header">Exportar toda la información</li>',
            ],
        ],
    ]);

    echo kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
            'type' => kartik\grid\GridView::TYPE_PRIMARY,
            'heading' => '<h3 class="panel-title"><i class="fa fa-list"></i> Listado de Inmuebles</h3>',
        ],
        // set a label for default menu
        'export' => [
            'label' => 'Página',
            'itemsBefore' => [
                '<li class="dropdown-header">Exportar esta página</li>',
            ],
            'fontAwesome' => true,
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            $fullExportMenu,
        ],
    ]);
    ?>
</div>
