<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $name
 * @property int $post_id
 * @property int $avatar_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $extension
 *
 * @property Posts $post
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'post_id', 'extension'], 'required'],
            [['post_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'extension'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::class, 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'post_id' => 'Post ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'extension' => 'Extension',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }
}
