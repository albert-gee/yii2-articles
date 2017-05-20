<?php
namespace xalberteinsteinx\articles\common\entities;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_category".
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $key
 * @property integer $show
 * @property string $created_at
 * @property string $updated_at
 * @property string $publish_at
 *
 * @property Article[] $articles
 * @property ArticleCategory $parent
 * @property ArticleCategory[] $articleCategories
 * @property ArticleCategoryTranslation[] $articleCategoryTranslations
 */
class ArticleCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'show'], 'integer'],
            [['created_at', 'updated_at', 'publish_at'], 'safe'],
            [['key'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('articles', 'Category'),
            'parent_id' => Yii::t('articles', 'Parent'),
            'key' => Yii::t('articles', 'Key'),
            'show' => Yii::t('articles', 'Show'),
            'created_at' => Yii::t('articles', 'Created At'),
            'updated_at' => Yii::t('articles', 'Updated At'),
            'publish_at' => Yii::t('articles', 'Publish At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleCategories()
    {
        return $this->hasMany(ArticleCategory::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleCategoryTranslations()
    {
        return $this->hasMany(ArticleCategoryTranslation::className(), ['category_id' => 'id']);
    }
}
