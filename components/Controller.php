<?php

namespace app\components;

use app\components\UserGroupBehavior;

class Controller extends \yii\web\Controller {
	
	public function behaviors() {
		return [
			'UserGroupBehavior' => [
				'class' => UserGroupBehavior::class,
			]
		];
	}
}