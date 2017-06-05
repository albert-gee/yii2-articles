<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var \xalberteinsteinx\articles\common\entities\ArticleCategory              $category
 * @var \xalberteinsteinx\articles\common\entities\ArticleCategoryTranslation   $categoryTranslation
 */
use yii\widgets\ActiveForm;

?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($category, 'show')->checkbox(); ?>
<?= $form->field($categoryTranslation, 'title')->textInput(); ?>


<?php $form::end(); ?>
