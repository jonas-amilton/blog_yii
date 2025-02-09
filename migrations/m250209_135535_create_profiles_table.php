<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profiles}}`.
 */
class m250209_135535_create_profiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profiles}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'avatar_id' => $this->integer()->notNull(),
            'bio' => $this->string(60),
            'age' => $this->integer()->notNull(),
            'gender' => $this->string(2),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-profiles-user_id',
            'profiles',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-profiles-avatar_id',
            'profiles',
            'avatar_id',
            'images',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');

        $this->dropForeignKey(
            'fk-profiles-user_id',
            'users'
        );

        $this->dropForeignKey(
            'fk-profiles-avatar_id',
            'images'
        );
    }
}
