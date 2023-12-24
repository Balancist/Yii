<?php

namespace app\components;

class ActiveRecord extends \yii\db\ActiveRecord {

	public function behaviors() {
		return [
			'UserGroupBehavior' => [
				'class' => UserGroupBehavior::class,
			]
		];
	}
}