<?php

use yii\helpers\Html;
use app\models\PermisosHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$es_root = (!Yii::$app->user->isGuest && PermisosHelpers::requerirRol('root'));
if($es_root) {
    $this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'User',
    ]) . $model->id;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
    $this->params['breadcrumbs'][] = Yii::t('app', 'Update');
    ?>
    <div class="user-update">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
<?php
} else { ?>
    <div class="user-update">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1> <br>
        <h1 class="text-center text-danger"><?= Html::encode('Usted no tiene autorización para editar usuarios') ?></h1>

        
    </div>
<?php
}