<?php

use app\models\User;
use yii\rbac\UserGroupRule;
use yii\db\Migration;

class m231122_173012_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        $rule = new UserGroupRule;
        $auth->add($rule);

        $create = $auth->createPermission('create');
        $create->description = 'Create';
        $auth->add($create);

        $update = $auth->createPermission('update');
        $update->description = 'Update';
        $auth->add($update);

        $delete = $auth->createPermission('delete');
        $delete->description = 'Delete';
        $auth->add($delete);

        $admin = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $create);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $delete);

        $superUser = new User;
        $superUser->username = 'superuser';
        $superUser->password = 'superuser';
        $superUser->phone = '09383710200';
        $superUser->save();

        $auth->assign($admin, $superUser->id);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}