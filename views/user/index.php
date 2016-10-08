<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\PermisosHelpers;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;

$es_invitado = Yii::$app->user->isGuest;
$es_root = !$es_invitado && PermisosHelpers::requerirRol('root');
if($es_invitado) {
    Yii::$app->getResponse()->redirect(Url::to(['site/login']));
} else if($es_root) {
?>

<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Cargar Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            // 'email:email',
            // 'rol_id',
            // 'estado_id',
            // 'tipo_usuario_id',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php
} else {
    
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <h1 class="text-danger text-center"> Usted no tiene autorización para estar aquí.</h1>
    </p>
    <?php
}