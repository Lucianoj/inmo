<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Inmueble */

$this->title = ' Nuevo Inmueble';
$this->params['breadcrumbs'][] = ['label' => 'Inmuebles', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inmueble-create">

    <h1 class="text-center"><i class="fa fa-home"></i><?= Html::encode($this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
