<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\PermisosHelpers;

$es_invitado = Yii::$app->user->isGuest;
$this->title = 'Inmobiliaria';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><i class="fa fa-fort-awesome"></i> JR Inmobiliaria</h1>
    </div>
<?php 
    if ($es_invitado) {
?>
        <div class="text-center">
            <h2 class="text-primary">Debe ingresar para ver las opciones.</h2>
            <?= Html::a('Ingresar', ['site/login'], ['class' => 'btn btn-lg btn-success']) ?>
        </div>
    </div>
<?php
    } else  {
?>

    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="text-center">
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <h2><i class="fa fa-bullhorn"></i> Publicar Avisos</h2>

                        <p>En este proceso se le asigna a un afiliado una entrada</p>

                        <?= Html::a('Publicar &raquo;', ['aviso/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div class="col-lg-6 text-center">
                        <h2><i class="fa fa-home"></i> ABM Inmueble</h2>

                        <p>ABM Inmuebles</p>

                        <?= Html::a('Ver Inmuebles &raquo;', ['inmueble/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div><!-- row -->
            </div>
        </div>
    </div>
<?php
    }
?>
</div>
