<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var \xalberteinsteinx\articles\common\entities\ArticleCategory[]    $categories
 */
?>

<?php foreach ($categories as $category): ?>
    <?= $category->id; ?>

<?php endforeach; ?>