<?php
namespace xalberteinsteinx\articles\frontend;

use Yii;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'xalberteinsteinx\articles\backend\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['articles'] =
            Yii::$app->i18n->translations['articles'] ??
            [
                'class'          => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath'       => '@vendor/xalberteinsteinx/yii2-articles/frontend/messages',
            ];
    }
}