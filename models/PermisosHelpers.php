<?php

namespace app\models;

use Yii;
use app\models\ValorHelpers;
use yii\web\Controller;
use yii\helpers\Url;

class PermisosHelpers
{
    /**
     * @requerirUpgradeA
     * @param type $tipo_usuario_nombre
     * @return type
     */
    public static function requerirUpgradeA($tipo_usuario_nombre)
    {
        if(!ValorHelpers::tipoUsuarioCoincide($tipo_usuario_nombre)) {
            return Yii::$app->getResponse()->redirect(Url::to(['upgrade/index']));
        }
    }

    /**
     * @requerirEstado
     * @param type $estado_nombre
     * @return type
     */
    public static function requerirEstado($estado_nombre)
    {
        return ValorHelpers::estadoCoincide($estado_nombre);
    }

    /**
     * @requerirRol
     * @param type $rol_nombre
     * @return type
     */
    public static function requerirRol($rol_nombre)
    {
        return ValorHelpers::rolCoincide($rol_nombre);
    }

    /**
     * @requerirMinimoRol
     * @param type $rol_nombre
     * @param type $userId
     * @return boolean
     */
    public static function requerirMinimoRol($rol_nombre, $userId = null)
    {
        if(ValorHelpers::esRolNombreValido($rol_nombre)) {
            if($userId == null) {
                $userRolValor = ValorHelpers::getUsersRolValor();
            } else {
                $userRolValor = ValorHelpers::getUsersRolValor($userId);
            }
            return $userRolValor >= ValorHelpers::getRolValor($rol_nombre) ? true : false;
        } else {
            return false;
        }
    }

    /**
     * @userDebeSerPropietario
     * @param type $model_nombre
     * @param type $model_id
     * @return boolean
     */
    public static function userDebeSerPropietario($model_nombre, $model_id)
    {
        $conexion = \Yii::$app->db;
        $userid = Yii::$app->user->identity->id;
        $sql = "select id from $model_nombre where user_id=:userid and id=:model_id";
        $comando = $conexion->createCommand($sql);
        $comando->bindValue(":userid", $userid);
        $comando->bindValue(":model_id", $model_id);
        if($result = $comando->queryOne()) {
            return true;
        } else {
            return false;
        }
    }
}