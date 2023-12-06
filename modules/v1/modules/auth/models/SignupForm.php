<?php

namespace app\modules\v1\modules\auth\models;

use Yii;
use yii\base\Model;
use app\modules\v1\modules\auth\models\User;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $phone;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'این نام کاربری قبلا انتخاب شده'],
            ['username', 'string', 'min' => 5, 'max' => 50],

            ['phone', 'trim'],
            [['phone'], 'required'],
            ['phone', 'match', 'pattern' => '/^09/'],
            ['phone', 'integer'],
            ['phone', 'string', 'min' => 11, 'max' => 11],
            ['phone', 'unique', 'targetClass' => 'app\models\User', 'message' => 'این شماره قبلا انتخاب شده'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->phone = $this->phone;
        $user->password = $this->password;

        return $user->save();
    }
}