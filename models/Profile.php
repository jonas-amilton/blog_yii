<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $bio
 * @property int $age
 * @property string|null $gender
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Avatars[] $avatars
 * @property Users $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'age'], 'required'],
            [['user_id', 'age'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['bio'], 'string', 'max' => 60],
            [['gender'], 'string', 'max' => 2],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID do usuário',
            'bio' => 'Bio',
            'age' => 'Idade',
            'gender' => 'Sexo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Avatars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvatars()
    {
        return $this->hasMany(Avatar::class, ['avatar_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
