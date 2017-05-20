<?php

namespace xalberteinsteinx\articles\common\entities;

use bl\multilang\entities\Language;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_translation".
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $language_id
 * @property string $title
 * @property string $short_description
 * @property string $full_description
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $meta_author
 * @property string $meta_robots
 *
 * @property Article $article
 * @property Language $language
 */
class ArticleTranslation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'language_id'], 'required'],
            [['article_id', 'language_id'], 'integer'],
            [['short_description', 'full_description', 'meta_description'], 'string'],
            [['title', 'meta_title', 'meta_keywords', 'meta_author', 'meta_robots'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
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
            'language_id' => Yii::t('articles', 'Language'),
            'title' => Yii::t('articles', 'Title'),
            'short_description' => Yii::t('articles', 'Short description'),
            'full_description' => Yii::t('articles', 'Full description'),
            'meta_title' => Yii::t('articles', 'Meta title'),
            'meta_keywords' => Yii::t('articles', 'Meta keywords'),
            'meta_description' => Yii::t('articles', 'Meta description'),
            'meta_author' => Yii::t('articles', 'Meta author'),
            'meta_robots' => Yii::t('articles', 'Meta robots'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}
