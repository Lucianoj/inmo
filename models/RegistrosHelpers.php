<?php

namespace app\models;

use Yii;

class RegistrosHelpers
{
    /**
     * @userTiene
     * @param type $modelo_nombre
     * @return boolean
     */
    public static function userTiene($modelo_nombre)
    {
        $conexion = \Yii::$app->db;
        $userid = Yii::$app->user->identity->id;
        $sql = "select id from $modelo_nombre where user_id=:userid";
        $comando = $conexion->createCommand($sql);
        $comando->bindValue(":userid", $userid);
        $resultado = $comando->queryOne();
        if($resultado == null){
            return false;
        } else {
            return $resultado['id'];
        }
    }
}