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

        $insertCompany = $auth->createPermission('insertCompany');
        $insertCompany->description = 'ساخت کمپانی';
        $auth->add($insertCompany);

        $updateCompany = $auth->createPermission('updateCompany');
        $updateCompany->description = 'ویرایش کمپانی';
        $auth->add($updateCompany);

        $deleteCompany = $auth->createPermission('deleteCompany');
        $deleteCompany->description = 'پاک کردن کمپانی';
        $auth->add($deleteCompany);

        $insertFilm = $auth->createPermission('insertFilm');
        $insertFilm->description = 'ساخت فیلم';
        $auth->add($insertFilm);

        $updateFilm = $auth->createPermission('updateFilm');
        $updateFilm->description = 'ویرایش فیلم';
        $auth->add($updateFilm);

        $deleteFilm = $auth->createPermission('deleteFilm');
        $deleteFilm->description = 'پاک کردن فیلم';
        $auth->add($deleteFilm);

        $insertSerie = $auth->createPermission('insertSerie');
        $insertSerie->description = 'ساخت سریال';
        $auth->add($insertSerie);

        $updateSerie = $auth->createPermission('updateSerie');
        $updateSerie->description = 'ویرایش سریال';
        $auth->add($updateSerie);

        $deleteSerie = $auth->createPermission('deleteSerie');
        $deleteSerie->description = 'پاک کردن سریال';
        $auth->add($deleteSerie);

        $insertCollection = $auth->createPermission('insertCollection');
        $insertCollection->description = 'ساخت کالکشن';
        $auth->add($insertCollection);

        $updateCollection = $auth->createPermission('updateCollection');
        $updateCollection->description = 'ویرایش کالکشن';
        $auth->add($updateCollection);

        $deleteCollection = $auth->createPermission('deleteCollection');
        $deleteCollection->description = 'پاک کردن کالکشن';
        $auth->add($deleteCollection);

        $insertGenre = $auth->createPermission('insertGenre');
        $insertGenre->description = 'ساخت ژانر';
        $auth->add($insertGenre);

        $updateGenre = $auth->createPermission('updateGenre');
        $updateGenre->description = 'ویرایش ژانر';
        $auth->add($updateGenre);

        $deleteGenre = $auth->createPermission('deleteGenre');
        $deleteGenre->description = 'پاک کردن ژانر';
        $auth->add($deleteGenre);

        $insertStream = $auth->createPermission('insertStream');
        $insertStream->description = 'ساخت استریم';
        $auth->add($insertStream);

        $updateStream = $auth->createPermission('updateStream');
        $updateStream->description = 'ویرایش استریم';
        $auth->add($updateStream);

        $deleteStream = $auth->createPermission('deleteStream');
        $deleteStream->description = 'پاک کردن استریم';
        $auth->add($deleteStream);

        $insertEpisode = $auth->createPermission('insertEpisode');
        $insertEpisode->description = 'ساخت قسمت';
        $auth->add($insertEpisode);

        $updateEpisode = $auth->createPermission('updateEpisode');
        $updateEpisode->description = 'ویرایش قسمت';
        $auth->add($updateEpisode);

        $deleteEpisode = $auth->createPermission('deleteEpisode');
        $deleteEpisode->description = 'پاک کردن قسمت';
        $auth->add($deleteEpisode);

        $filmAdmin = $auth->createRole('filmAdmin');
        $filmAdmin->ruleName = $rule->name;
        $auth->add($filmAdmin);
        $auth->addChild($filmAdmin, $createFilm);
        $auth->addChild($filmAdmin, $updateFilm);
        $auth->addChild($filmAdmin, $deleteFilm);
        $auth->addChild($filmAdmin, $createCollection);
        $auth->addChild($filmAdmin, $updateCollection);
        $auth->addChild($filmAdmin, $deleteCollection);

        $serieAdmin = $auth->createRole('serieAdmin');
        $serieAdmin->ruleName = $rule->name;
        $auth->add($serieAdmin);
        $auth->addChild($serieAdmin, $createSerie);
        $auth->addChild($serieAdmin, $updateSerie);
        $auth->addChild($serieAdmin, $deleteSerie);
        $auth->addChild($serieAdmin, $createEpisode);
        $auth->addChild($serieAdmin, $updateEpisode);
        $auth->addChild($serieAdmin, $deleteEpisode);

        $admin = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $filmAdmin);
        $auth->addChild($admin, $serieAdmin);
        $auth->addChild($admin, $createCompany);
        $auth->addChild($admin, $updateCompany);
        $auth->addChild($admin, $deleteCompany);
        $auth->addChild($admin, $createStream);
        $auth->addChild($admin, $updateStream);
        $auth->addChild($admin, $deleteStream);
        $auth->addChild($admin, $createGenre);
        $auth->addChild($admin, $updateGenre);
        $auth->addChild($admin, $deleteGenre);

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