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
    public $email;
    public $password;
    public $password_confirm;
    public $name;
    public $last_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => \Yii::$app->getUser()->identityClass, 'message' => 'Данный емейл уже зарегистрирован в системе'],

            [['last_name','name'], 'filter', 'filter' => 'trim'],
            [['last_name','name'], 'required'],
            [['last_name','name'], 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_confirm',  'required'],
            ['password_confirm',  'string', 'min' => 6],
            ['password_confirm',  'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают"],

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
            $user->username = $this->email;
            $user->email = $this->email;
            $user->name  = $this->name;
            $user->last_name = $this->last_name;
            $user->password = $this->password;
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        print_r($this->password);
        die();

        return null;
    }
}
