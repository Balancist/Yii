<?php

namespace app\components;

use Yii;
use yii\rbac\Rule;
use app\models\User;

class OwnerRule extends Rule
{
    public $name = 'isOwner';

    public function execute($user, $item, $params)
    {
        return isset($params['object']) ? $params['object']->publisher == $user : false;
    }
}