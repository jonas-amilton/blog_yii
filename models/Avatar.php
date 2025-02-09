<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "avatars".
 *
 * @property int $id
 * @property string $name
 * @property int $avatar_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $extension
 *
 * @property Profiles $avatar
 */
class Avatar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avatars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'avatar_id', 'extension'], 'required'],
            [['avatar_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'extension'], 'string', 'max' => 255],
            [['avatar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['avatar_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome da imagem',
            'avatar_id' => 'Avatar ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'extension' => 'Extensão',
        ];
    }

    /**
     * Gets query for [[Avatar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar()
    {
        return $this->hasOne(Profile::class, ['id' => 'avatar_id']);
    }
}
