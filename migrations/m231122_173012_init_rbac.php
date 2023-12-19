<?php

use app\models\User;
use app\components\UserGroupRule;
use app\components\OwnerRule;
use yii\db\Migration;

class m231122_173012_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        $userGroupRule = new UserGroupRule;
        $auth->add($userGroupRule);
        $ownerRule = new OwnerRule;
        $auth->add($ownerRule);


        $insertCompany = $auth->createPermission('insertCompany');
        $insertCompany->description = 'ساخت کمپانی';
        $auth->add($insertCompany);

        $updateCompany = $auth->createPermission('updateCompany');
        $updateCompany->description = 'ویرایش کمپانی';
        $auth->add($updateCompany);

        $deleteCompany = $auth->createPermission('deleteCompany');
        $deleteCompany->description = 'پاک کردن کمپانی';
        $auth->add($deleteCompany);


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


        $insertFilm = $auth->createPermission('insertFilm');
        $insertFilm->description = 'ساخت فیلم';
        $auth->add($insertFilm);

        $updateFilm = $auth->createPermission('updateFilm');
        $updateFilm->description = 'ویرایش فیلم';
        $auth->add($updateFilm);

        $updateOwnFilm = $auth->createPermission('updateOwnFilm');
        $updateOwnFilm->description = 'ویرایش فیلم خود';
        $updateOwnFilm->ruleName = $ownerRule->name;
        $auth->add($updateOwnFilm);
        $auth->addChild($updateOwnFilm, $updateFilm);

        $deleteFilm = $auth->createPermission('deleteFilm');
        $deleteFilm->description = 'پاک کردن فیلم';
        $auth->add($deleteFilm);

        $deleteOwnFilm = $auth->createPermission('deleteOwnFilm');
        $deleteOwnFilm->description = 'پاک کردن فیلم خود';
        $deleteOwnFilm->ruleName = $ownerRule->name;
        $auth->add($deleteOwnFilm);
        $auth->addChild($deleteOwnFilm, $deleteFilm);


        $insertCollection = $auth->createPermission('insertCollection');
        $insertCollection->description = 'ساخت کالکشن';
        $auth->add($insertCollection);

        $updateCollection = $auth->createPermission('updateCollection');
        $updateCollection->description = 'ویرایش کالکشن';
        $auth->add($updateCollection);

        $updateOwnCollection = $auth->createPermission('updateOwnCollection');
        $updateOwnCollection->description = 'ویرایش کالکشن خود';
        $updateOwnCollection->ruleName = $ownerRule->name;
        $auth->add($updateOwnCollection);
        $auth->addChild($updateOwnCollection, $updateCollection);

        $deleteCollection = $auth->createPermission('deleteCollection');
        $deleteCollection->description = 'پاک کردن کالکشن';
        $auth->add($deleteCollection);

        $deleteOwnCollection = $auth->createPermission('deleteOwnCollection');
        $deleteOwnCollection->description = 'پاک کردن کالکشن خود';
        $deleteOwnCollection->ruleName = $ownerRule->name;
        $auth->add($deleteOwnCollection);
        $auth->addChild($deleteOwnCollection, $deleteCollection);


        $insertSerie = $auth->createPermission('insertSerie');
        $insertSerie->description = 'ساخت سریال';
        $auth->add($insertSerie);

        $updateSerie = $auth->createPermission('updateSerie');
        $updateSerie->description = 'ویرایش سریال';
        $auth->add($updateSerie);

        $updateOwnSerie = $auth->createPermission('updateOwnSerie');
        $updateOwnSerie->description = 'ویرایش سریال خود';
        $updateOwnSerie->ruleName = $ownerRule->name;
        $auth->add($updateOwnSerie);
        $auth->addChild($updateOwnSerie, $updateSerie);

        $deleteSerie = $auth->createPermission('deleteSerie');
        $deleteSerie->description = 'پاک کردن سریال';
        $auth->add($deleteSerie);

        $deleteOwnSerie = $auth->createPermission('deleteOwnSerie');
        $deleteOwnSerie->description = 'پاک کردن سریال خود';
        $deleteOwnSerie->ruleName = $ownerRule->name;
        $auth->add($deleteOwnSerie);
        $auth->addChild($deleteOwnSerie, $deleteSerie);


        $insertEpisode = $auth->createPermission('insertEpisode');
        $insertEpisode->description = 'ساخت قسمت';
        $auth->add($insertEpisode);

        $updateEpisode = $auth->createPermission('updateEpisode');
        $updateEpisode->description = 'ویرایش قسمت';
        $auth->add($updateEpisode);

        $updateOwnEpisode = $auth->createPermission('updateOwnEpisode');
        $updateOwnEpisode->description = 'ویرایش قسمت خود';
        $updateOwnEpisode->ruleName = $ownerRule->name;
        $auth->add($updateOwnEpisode);
        $auth->addChild($updateOwnEpisode, $updateEpisode);

        $deleteEpisode = $auth->createPermission('deleteEpisode');
        $deleteEpisode->description = 'پاک کردن قسمت';
        $auth->add($deleteEpisode);

        $deleteOwnEpisode = $auth->createPermission('deleteOwnEpisode');
        $deleteOwnEpisode->description = 'پاک کردن قسمت خود';
        $deleteOwnEpisode->ruleName = $ownerRule->name;
        $auth->add($deleteOwnEpisode);
        $auth->addChild($deleteOwnEpisode, $deleteEpisode);



        $filmAdmin = $auth->createRole('filmAdmin');
        $filmAdmin->ruleName = $userGroupRule->name;
        $auth->add($filmAdmin);
        $auth->addChild($filmAdmin, $insertFilm);
        $auth->addChild($filmAdmin, $updateOwnFilm);
        $auth->addChild($filmAdmin, $deleteOwnFilm);
        $auth->addChild($filmAdmin, $insertCollection);
        $auth->addChild($filmAdmin, $updateOwnCollection);
        $auth->addChild($filmAdmin, $deleteOwnCollection);

        $serieAdmin = $auth->createRole('serieAdmin');
        $serieAdmin->ruleName = $userGroupRule->name;
        $auth->add($serieAdmin);
        $auth->addChild($serieAdmin, $insertSerie);
        $auth->addChild($serieAdmin, $updateOwnSerie);
        $auth->addChild($serieAdmin, $deleteOwnSerie);
        $auth->addChild($serieAdmin, $insertEpisode);
        $auth->addChild($serieAdmin, $updateOwnEpisode);
        $auth->addChild($serieAdmin, $deleteOwnEpisode);

        $admin = $auth->createRole('admin');
        $admin->ruleName = $userGroupRule->name;
        $auth->add($admin);
        $auth->addChild($admin, $filmAdmin);
        $auth->addChild($admin, $updateFilm);
        $auth->addChild($admin, $deleteFilm);
        $auth->addChild($admin, $updateCollection);
        $auth->addChild($admin, $deleteCollection);
        $auth->addChild($admin, $serieAdmin);
        $auth->addChild($admin, $updateSerie);
        $auth->addChild($admin, $deleteSerie);
        $auth->addChild($admin, $updateEpisode);
        $auth->addChild($admin, $deleteEpisode);
        $auth->addChild($admin, $insertCompany);
        $auth->addChild($admin, $updateCompany);
        $auth->addChild($admin, $deleteCompany);
        $auth->addChild($admin, $insertStream);
        $auth->addChild($admin, $updateStream);
        $auth->addChild($admin, $deleteStream);
        $auth->addChild($admin, $insertGenre);
        $auth->addChild($admin, $updateGenre);
        $auth->addChild($admin, $deleteGenre);

        $mohammad = new User;
        $mohammad->username = 'mohammad';
        $mohammad->password = 'mohammad';
        $mohammad->phone = '09383710200';
        $mohammad->save();
        $auth->assign($admin, $mohammad->id);

        $hasan = new User;
        $hasan->username = 'hasan';
        $hasan->password = 'hasan';
        $hasan->phone = '09367890200';
        $hasan->save();
        $auth->assign($filmAdmin, $hasan->id);

        $sajjad = new User;
        $sajjad->username = 'sajjad';
        $sajjad->password = 'sajjad';
        $sajjad->phone = '09385610200';
        $sajjad->save();
        $auth->assign($serieAdmin, $sajjad->id);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}