<?php

namespace xalberteinsteinx\articles\common\entities;

use dektrium\user\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $key
 * @property integer $position
 * @property integer $show
 * @property string $created_at
 * @property string $updated_at
 * @property string $publish_at
 * @property integer $all_views
 *
 * @property ArticleCategory $category
 * @property User $user
 * @property ArticleTranslation[] $articleTranslations
 * @property ArticleViews[] $articleViews
 */
class Article extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'user_id', 'position', 'show', 'all_views'], 'integer'],
            [['created_at', 'updated_at', 'publish_at'], 'safe'],
            [['key'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('articles', 'Article'),
            'category_id' => Yii::t('articles', 'Category'),
            'user_id' => Yii::t('articles', 'User'),
            'key' => Yii::t('articles', 'Key'),
            'position' => Yii::t('articles', 'Position'),
            'show' => Yii::t('articles', 'Show'),
            'created_at' => Yii::t('articles', 'Created At'),
            'updated_at' => Yii::t('articles', 'Updated At'),
            'publish_at' => Yii::t('articles', 'Publish At'),
            'all_views' => Yii::t('articles', 'All views'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTranslations()
    {
        return $this->hasMany(ArticleTranslation::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleViews()
    {
        return $this->hasMany(ArticleViews::className(), ['article_id' => 'id']);
    }
}
