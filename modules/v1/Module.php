<?php

namespace app\modules\v1;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $this->modules = [
            'company' => [
                'class' => 'app\modules\v1\modules\company\Module',
            ],
            'auth' => [
                'class' => 'app\modules\v1\modules\auth\Module',
            ],
            'film' => [
                'class' => 'app\modules\v1\modules\film\Module',
            ],
            'serie' => [
                'class' => 'app\modules\v1\modules\serie\Module',
            ],
            'stream' => [
                'class' => 'app\modules\v1\modules\stream\Module',
            ],
            'genre' => [
                'class' => 'app\modules\v1\modules\genre\Module',
            ],
            'episode' => [
                'class' => 'app\modules\v1\modules\episode\Module',
            ],
            'collection' => [
                'class' => 'app\modules\v1\modules\collection\Module',
            ],
        ];
    }
}