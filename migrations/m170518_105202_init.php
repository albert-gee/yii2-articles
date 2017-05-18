<?php

use yii\db\Migration;

class m170518_105202_init extends Migration
{
    public function up()
    {
        /*CREATE TABLES*/
        /*article*/
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'user_id' => $this->integer(),
            'key' => $this->string(),
            'position' => $this->integer()->notNull()->defaultValue(1),
            'show' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'publish_at' => $this->dateTime(),
            'all_views' => $this->integer()->defaultValue(0)
        ]);

        /*article_translation*/
        $this->createTable('{{%article_translation}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'language_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'short_description' => $this->text(),
            'full_description' => $this->text(),
            'meta_title' => $this->string(),
            'meta_keywords' => $this->string(),
            'meta_description' => $this->text(),
            'meta_author' => $this->string(),
            'meta_robots' => $this->string()
        ]);

        /*article_category*/
        $this->createTable('{{%article_category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'key' => $this->string(),
            'show' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'publish_at' => $this->dateTime(),
        ]);

        /*article_category_translation*/
        $this->createTable('{{%article_category_translation}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'language_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'short_description' => $this->text(),
            'full_description' => $this->text(),
            'meta_title' => $this->string(),
            'meta_keywords' => $this->string(),
            'meta_description' => $this->text(),
            'meta_author' => $this->string(),
            'meta_robots' => $this->string()
        ]);

        /*article_views*/
        $this->createTable('{{%article_views}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'period' => $this->date()->notNull(),
            'views' => $this->integer()->notNull()->defaultValue(0)
        ]);


        /*CREATE FOREIGN KEYS*/
        $this->addForeignKey('{{%fk_article_category}}',
            '{{%article}}', 'category_id', '{{%article_category}}', 'id');
        $this->addForeignKey('{{%fk_article_user}}',
            '{{%article}}', 'user_id', '{{%user}}', 'id');

        $this->addForeignKey('{{%fk_article_translation_article}}',
            '{{%article_translation}}', 'article_id', '{{%article}}', 'id');
        $this->addForeignKey('{{%fk_article_translation_language}}',
            '{{%article_translation}}', 'language_id', '{{%language}}', 'id');

        $this->addForeignKey('{{%fk_category_category}}',
            '{{%article_category}}', 'parent_id', '{{%article_category}}', 'id');

        $this->addForeignKey('{{%fk_category_translation_category}}',
            '{{%article_category_translation}}', 'category_id', '{{%article_category}}', 'id');
        $this->addForeignKey('{{%fk_category_translation_language}}',
            '{{%article_category_translation}}', 'language_id', '{{%language}}', 'id');

        $this->addForeignKey('{{%fk_article_views_article}}',
            '{{%article_views}}', 'article_id', '{{%article}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk_article_category}}', '{{%article}}');
        $this->dropForeignKey('{{%fk_article_user}}', '{{%article}}');

        $this->dropForeignKey('{{%fk_article_translation_article}}', '{{%article_translation}}');
        $this->dropForeignKey('{{%fk_article_translation_language}}', '{{%article_translation}}');

        $this->dropForeignKey('{{%fk_category_category}}', '{{%article_category}}');

        $this->dropForeignKey('{{%fk_category_translation_category}}','{{%article_category_translation}}');
        $this->dropForeignKey('{{%fk_category_translation_language}}', '{{%article_category_translation}}');

        $this->dropForeignKey('{{%fk_article_views_article}}', '{{%article_views}}');


        $this->dropTable('{{%article_views}}');
        $this->dropTable('{{%article_category_translation}}');
        $this->dropTable('{{%article_category}}');
        $this->dropTable('{{%article_translation}}');
        $this->dropTable('{{%article}}');
    }
}
