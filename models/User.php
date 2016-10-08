<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\helpers\Security;
use yii\helpers\ArrayHelper;
use app\models\Rol;
use app\models\EstadoUser;
use app\models\TipoUsuario;
use app\models\Perfil;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\behaviors\BlameableBehavior;

/**
 * User model
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $telefono
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $rol_id
 * @property integer $estado_user_id
 * @property integer $tipo_usuario_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property EstadoUser $estadoUser
 * @property Rol $rol
 * @property TipoUsuario $tipoUsuario
 * @property UserEntregaEntrada[] $userEntregaEntradas
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ESTADO_ACTIVO = 1;
    const ROLE_USER = 1; 
    const ROLE_ADMIN = 2; 

    public static function tableName()
    {
        return 'user';
    }

    /**
     * behaviors
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            
            //BlameableBehavior::className(),
            
        ];
    }

    /**
     * reglas de validación
     */
    public function rules()
    {
        return [
//            ['estado_user_id', 'default', 'value' => self::ESTADO_ACTIVO],
            [['estado_user_id'], 'in', 'range' => array_keys($this->getEstadoLista())],
//            ['rol_id', 'default', 'value' => 1],
//            ['tipo_usuario_id', 'default', 'value' => 1],
//            [['tipo_usuario_id'], 'in', 'range' => array_keys($this->getTipoUsuarioLista())],
            [['telefono'], 'string', 'max' => 25],
//            [['telefono'], 'unique'],
            [['telefono'], 'required'],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
//            [['created_at', 'updated_at'], 'safe'],
            //------
//            [['username', 'email', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
//            [['auth_key'], 'string', 'max' => 32],
//            [['username'], 'unique'],
//            [['estado_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoUser::className(), 'targetAttribute' => ['estado_user_id' => 'id']],
//            [['rol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id' => 'id']],
//            [['tipo_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuario::className(), 'targetAttribute' => ['tipo_usuario_id' => 'id']],
        ];
    }

    /* Las etiquetas de los atributos de su modelo */
    public function attributeLabels()
    {
        return [
            /* Sus otras etiquetas de atributo */
            'rolNombre' => Yii::t('app', 'Rol'),
            'telefono' => Yii::t('app', 'Teléfono'),
            'estadoNombre' => Yii::t('app', 'Estado'),
            'perfilId' => Yii::t('app', 'Perfil'),
            'perfilLink' => Yii::t('app', 'Perfil'),
            'userLink' => Yii::t('app', 'Usuario'),
            'userName' => Yii::t('app', 'Usuario'),
            'tipoUsuarioNombre' => Yii::t('app', 'Tipo Usuario'),
            'tipoUsuarioId' => Yii::t('app', 'Tipo Usuario'),
            'userIdLink' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @findIdentity
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Encuentra usuario por username
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Encuentra usuario por clave de restablecimiento de password
     *
     * @param string $token clave de restablecimiento de password
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * Determina si la clave de restablecimiento de password es válida
     *
     * @param string $token clave de restablecimiento de password
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @getId
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @getAuthKey
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @validateAuthKey
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Valida password
     *
     * @param string $password password a validar
     * @return boolean si la password provista es válida para el usuario actual
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    /**
     * Genera hash de password a partir de password y la establece en el modelo
     * @setPassword
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Genera clave de autenticación "recuerdame"
     * @generateAuthKey
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Genera nueva clave de restablecimiento de password
     * @generatePasswordResetToken
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Remueve clave de restablecimiento de password
     * @removePasswordResetToken
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @getPerfil 
     */
    public function getPerfil()
    {
        return $this->hasOne(Perfil::className(), ['user_id' => 'id']);
    }

    /**
     * @getRol relacion get rol
     * @return type
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }

    /**
     * @getRolNombre get rol nombre
     */
    public function getRolNombre()
    {
        return $this->rol ? $this->rol->rol_nombre : '- sin rol -';
    }

    /**
     * @getRolLista get lista de roles para roles desplegables
     */
    public static function getRolLista()
    {
        $dropciones = Rol::find()->asArray()->all();
        
        return ArrayHelper::map($dropciones, 'id', 'rol_nombre');
    }

    /**
     * @getEstado relacion get estado
     */
    public function getEstado()
    {
        return $this->hasOne(EstadoUser::className(), ['id' => 'estado_user_id']);
    }
    
    /**
     * @getEstadoNombre get estado nombre
     */
    public function getEstadoNombre()
    {
        return $this->estado ? $this->estado->estado_nombre : '- sin estado -';
    }

    /**
     * @getEstadoLista get lista de estados para lista desplegable
     */

    public static function getEstadoLista()
    {
        $dropciones = EstadoUser::find()->asArray()->all();
        return ArrayHelper::map($dropciones, 'id', 'estado_nombre');
    }

    /**
     * 
     * @getTipoUsuario 
     */
    public function getTipoUsuario()
    {
        return $this->hasOne(TipoUsuario::className(), ['id' => 'tipo_usuario_id']);
    }

    /**
     * @getTipoUsuarioNombre get tipo usuario nombre
     */
    public function getTipoUsuarioNombre()
    {
        return $this->tipoUsuario ? $this->tipoUsuario->tipo_usuario_nombre : '- sin tipo usuario -';
    }

    /**
     * @getTipoUsuarioLista get lista de tipo usuario para lista desplegable
     */
    public static function getTipoUsuarioLista()
    {
        $dropciones = TipoUsuario::find()->asArray()->all();
        return ArrayHelper::map($dropciones, 'id', 'tipo_usuario_nombre');
    }

    /**
     * @getTipoUsuarioId
     */
    public function getTipoUsuarioId()
    {
        return $this->tipoUsuario ? $this->tipoUsuario->id : 'ninguno';
    }

    /**
     * @getPerfilId
     */
    public function getPerfilId()
    {
        return $this->perfil ? $this->perfil->id : 'ninguno';
    }

    /**
     * @getPerfilLink
     */
    public function getPerfilLink()
    {
        $url = Url::to(['perfil/view', 'id' => $this->perfilId]);
        $opciones = [];
        return Html::a($this->perfil ? 'perfil' : 'ninguno', $url, $opciones);
    }

    /**
     * @getUserIdLink
     */
    public function getUserIdLink()
    {
        $url = Url::to(['user/update', 'id' => $this->id]);
        $opciones = [];
        return Html::a($this->id, $url, $opciones);
    }

    /**
     * @getUserLink
     */
    public function getUserLink()
    {
        $url = Url::to(['use/view', 'id' => $this->id]);
        $opciones = [];
        return Html::a($this->username, $url, $opciones);
    }
    
    public static function roleInArray($arr_role) 
    { 
        return in_array(Yii::$app->user->identity->rol_id, $arr_role); 
    } 

    
} 