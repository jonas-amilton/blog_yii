<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ProfileForm extends Model
{
    public $age;
    public $gender;
    public $bio;
    public $image_file;
    public $user_id;

    public function __construct()
    {
        $this->user_id = Yii::$app->user->identity->id ?? null;
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['bio', 'age', 'image_file', 'user_id', 'gender'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID do Usuário',
            'avatar_id' => 'Avatar ID',
            'bio' => 'Bio',
            'age' => 'Idade',
            'gender' => 'Sexo',
            'image_file' => 'Imagem',
        ];
    }

    public function saveProfile()
    {
        $modelProfile = new Profile();

        $modelProfile->attributes = $this->attributes;

        $modelProfile->save();

        $this->uploadImage($modelProfile->id);

        return true;
    }

    private function uploadImage($idCreatedProfile)
    {
        $modelUpload = new UploadForm();
        $this->image_file = UploadedFile::getInstance($this, 'image_file');
        $modelUpload->image_file = $this->image_file;
        $modelUpload->upload($idCreatedProfile);

        $nameUploadedImage = "{$modelUpload->image_file->baseName}_0{$idCreatedProfile}";

        $this->saveImage($nameUploadedImage, $idCreatedProfile);
    }

    private function saveImage($nameUploadedImage, $idCreatedProfile)
    {
        $modelAvatar = new Avatar();

        $modelAvatar->extension = $this->image_file->extension;
        $modelAvatar->name = $nameUploadedImage;
        $modelAvatar->avatar_id = $idCreatedProfile;

        $modelAvatar->save();
    }
}
