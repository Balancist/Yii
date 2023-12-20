<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
use yii\web\ServerErrorHttpException;
use app\components\Controller;

class UserGroupBehavior extends Behavior {

	public function init() {
		parent::init();
	}


	public function events() {
		return [
			ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
			ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
		];
	}

	public function beforeInsert($e = null) {

		$sender = $e->sender;
		$modelName = explode('\\', $sender::className());
		$class = end($modelName);

		if (Yii::$app->user->can("insert{$class}")) {
			return true;
		} else {
			throw new ServerErrorHttpException("شما مجوز افزودن در {$class} را ندارید");
		}
	}


	public function beforeUpdate($e = null) {

		$sender = $e->sender;
		$modelName = explode('\\', $sender::className());
		$class = end($modelName);
		$object = $sender::findOne($sender->id);
		if (Yii::$app->user->can("update{$class}", ['object' => $object])) {
			return true;
		} else {
			throw new ServerErrorHttpException("شما مجوز ویرایش در {$class} را ندارید",);
		}
	}


	public function beforeDelete($e = null) {

		$sender = $e->sender;
		$modelName = explode('\\', $sender::className());
		$class = end($modelName);
		$object = $sender::findOne($sender->id);
		if (Yii::$app->user->can("update{$class}", ['object' => $object])) {
			return true;
		} else {
			throw new ServerErrorHttpException("شما مجوز ویرایش در {$class} را ندارید",);
		}
	}
}