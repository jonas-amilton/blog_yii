<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m250125_002450_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'extension' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-images-post_id',
            'images',
            'post_id',
            'posts',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%images}}');

        $this->dropForeignKey(
            'fk-images-post_id',
            'images'
        );
    }
}
