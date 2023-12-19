<?php

namespace app\components;

use Yii;
use yii\rbac\Rule;
use app\models\User;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        $identity = User::findIdentity($user);
        return !(Yii::$app->user->isGuest) ? Yii::$app->user->identity->group == $identity->group : false;
    }
}