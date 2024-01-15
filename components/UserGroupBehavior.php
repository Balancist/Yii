<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use app\components\ActiveRecord;
use yii\helpers\Inflector;
use yii\web\ServerErrorHttpException;
use app\components\Controller;

class UserGroupBehavior extends Behavior {

	public function init() {
		parent::init();
	}


	public function events() {
		return [
			// Controller::EVENT_BEFORE_ACTION => 'beforeAction',
			ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
			ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
		];
	}


	public function beforeAction($e = null) {

		$sender = $e->sender;
		$controllerName = Yii::$app->controller->id;
		$controllerClassArray = explode('\\', $sender::class);
		$controllerClass = end($controllerClassArray);
		$class = explode('Controller', $controllerClass)[0];
		$route = explode('/', $e->sender->route);
		$method = end($route);

		$access = true;

		if ($method == 'create') {
			$access = Yii::$app->user->can("insert{$class}");
		}


		if ($method == 'update') {
			$access = Yii::$app->user->can("update{$class}");
		}

		if ($method == 'delete') {
			$access = Yii::$app->user->can("delete{$class}");
		}

		if ($access) {
			return true;
		} else {
			throw new ServerErrorHttpException('شما مجوز لازم برای انجام عملیات مورد نظر خود را ندارید.');
		}
	}


	public function beforeInsert($e = null) {
		exit('d');

		$sender = $e->sender;
		$controllerName = Yii::$app->controller->id;
		$controllerClassArray = explode('\\', $sender::class);
		$controllerClass = end($controllerClassArray);
		$class = explode('Controller', $controllerClass)[0];

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