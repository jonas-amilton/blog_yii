<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%avatars}}`.
 */
class m250209_231424_create_avatars_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%avatars}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'avatar_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'extension' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-avatars-avatar_id',
            'avatars',
            'avatar_id',
            'profiles',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%avatars}}');

        $this->dropForeignKey(
            'fk-avatars-avatar_id',
            'avatars'
        );
    }
}
