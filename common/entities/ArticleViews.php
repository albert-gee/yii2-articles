<?php

namespace xalberteinsteinx\articles\common\entities;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_views".
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $period
 * @property integer $views
 *
 * @property Article $article
 */
class ArticleViews extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_views';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'views'], 'integer'],
            [['period'], 'required'],
            [['period'], 'safe'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('articles', 'ID'),
            'article_id' => Yii::t('articles', 'Article'),
            'period' => Yii::t('articles', 'Period'),
            'views' => Yii::t('articles', 'Views'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}
