<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Perfil */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Perfil',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Perfils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php 
    if (Yii::$app->user->isGuest) {
        Yii::$app->getResponse()->redirect(Url::to(['site/login']));
    } 
?>

<div class="perfil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
