<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
use yii\web\ServerErrorHttpException;
use app\components\Controller;

class UserGroupBehavior extends Behavior {
	
	public $except;

	protected function init() {
		parent::init();
	}


	public function events() {
		return [
			ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
			ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
			ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
			Controller::EVENT_BEFORE_ACTION => 'beforeAction',
		];
	}


	protected function isExcept() {
		$actionName = Yii::$app->controller->action->id;

		$exceptMatch = false;
		foreach ((array)$this->except as $pattern) {
			if ($pattern === $actionName) {
				$exceptMatch = true;
				break;
			}
		}

		return $exceptMatch;
	}


	public function beforeAction($e = null) {
		if ($this->isExcept()) {
			return true;
		}

		$sender = $e->sender;

		$appName = Yii::$app->id;
		$controllerName = Yii::$app->controller->id;

		$route = explode('/', $e->sender->route);
		$routeCount = count($route) - 1;

		$postfix = "";
		$permissionNames = [];

		foreach ($route as $k => $r) {

			if ($k !== 0 && $k !== $routeCount) {
				$permissionNames[] = "{$postfix}/$r/*";
				$postfix .= "/{$r}";
			}
			if ($k === $routeCount) {
				$permissionNames[] = "{$postfix}/$r";
				$postfix .= "/{$r}";
			}
		}
		$access = false;

		foreach ($permissionNames as $permission) {
			$access = $access || Yii::$app->user->can($permission, ['object' => $sender]);
		}

		if ($access) {
			return true;
		} else {
			throw new ServerErrorHttpException('شما مجوز لازم برای انجام عملیات مورد نظر خود را ندارید.');
		}
	}


	public function beforeInsert($e = null) {
		if ($this->isExcept()) {
			return true;
		}

		$appName = Yii::$app->id;
		$sender = $e->sender;
		$modelName = explode('\\', $sender::class);
		$class = end($modelName);

		if (Yii::$app->user->can("canInsert{$class}", ['object' => $sender])) {
			return true;
		} else {
			throw new ServerErrorHttpException("شما مجوز افزودن در {$class} را ندارید");
		}
	}


	public function beforeUpdate($e = null) {
		$appName = Yii::$app->id;
		if ($this->isExcept()) {
			return true;
		}

		$sender = $e->sender;
		$modelName = explode('\\', $sender::class);
		$class = end($modelName);
		$object = $sender::findOne($sender->id);
		$object->scenario = $sender->scenario;
		if (Yii::$app->user->can("canUpdate{$class}", ['object' => $object])) {
			return true;
		} else {
			throw new ServerErrorHttpException("شما مجوز ویرایش در {$class} را ندارید",);
		}
	}


	public function beforeDelete($e = null) {
		if ($this->isExcept()) {
			return true;
		}
	}
}