<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $telefono;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'telefono'], 'required'],
            [['username', 'email'], 'string', 'max' => 100],
            [['username'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Este usuario ya existe.'], 
            [['email'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Este e-mail ya existe.'], 
            [['telefono'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Este teléfono ya existe.'], 
            [['username'], 'string', 'min' => 2, 'max' => 255],
            [['telefono'], 'string', 'max' => 25],
        ];
    }
    
    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Usuario'),
            'email' => Yii::t('app', 'E-mail'),
            'telefono' => Yii::t('app', 'Teléfono'),
            'password' => Yii::t('app', 'Contraseña'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->telefono = $this->telefono;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
