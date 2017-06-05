<?php
namespace xalberteinsteinx\articles\backend\controllers;

use bl\multilang\entities\Language;
use phpDocumentor\Reflection\Types\Null_;
use xalberteinsteinx\articles\common\entities\ArticleCategory;
use xalberteinsteinx\articles\common\entities\ArticleCategoryTranslation;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'roles' => ['viewShopCategoryList'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['save', 'add-basic', 'add-images', 'add-seo', 'delete-image',
                            'select-filters', 'delete-filter', 'up', 'down', 'switch-show', 'get-seo-url',
                            'get-categories'
                        ],
                        'roles' => ['saveShopCategory'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['delete'],
                        'roles' => ['deleteShopCategory'],
                        'allow' => true,
                    ]
                ],
            ]
        ];
    }

    /**
     * Renders list of all categories.
     * @return mixed
     */
    public function actionIndex()
    {
        $categories = ArticleCategory::find()->all();
        return $this->render('index', ['categories' => $categories]);
    }

    public function actionSave($id = null, $languageId = null)
    {
        $language = (!empty($languageId)) ? Language::findOne($languageId) : Language::getDefault();
        $category = (!empty($id)) ? ArticleCategory::findOne($id) : new ArticleCategory();
        $categoryTranslation = (!empty($category)) ?
            ArticleCategoryTranslation::find()->where(['category_id' => $id, 'languageId' => $language->id])->one() :
            new ArticleCategoryTranslation(['language_id' => $language->id]);

        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            $redirectTo = \Yii::$app->request->referrer;

            $category->load($post);

            if ($category->validate()) {
                $category->save();

                $categoryTranslation->load($post);
                $categoryTranslation->category_id = $category->id;
                if ($categoryTranslation->validate()) $categoryTranslation->save();

                \Yii::$app->session->setFlash('success', \Yii::t('articles', 'Data saved successfully'));
                $redirectTo = ['save', 'id' => $category->id, 'languageId' => $language->id];
            }

            \Yii::$app->session->setFlash('error', \Yii::t('articles', 'An error occurred while saving the data'));
            return $this->redirect($redirectTo);
        }

        return $this->render('save', [
            'category' => $category,
            'categoryTranslation' => $categoryTranslation
        ]);

    }
}