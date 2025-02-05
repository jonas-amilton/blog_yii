<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class PostForm extends Model
{
    public $title;
    public $content;
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
            [['title', 'content', 'image_file', 'user_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID do usuário',
            'title' => 'Titulo',
            'content' => 'Conteúdo',
            'image_file' => 'Imagem',
        ];
    }

    public function savePost()
    {
        $modelPost = new Post();

        $modelPost->attributes = $this->attributes;

        if (!$modelPost->validate()) {
            return false;
        }

        $modelPost->save();

        $this->uploadImage($modelPost->id);

        return true;
    }

    private function uploadImage($idCreatedPost)
    {
        $modelUpload = new UploadForm();
        $this->image_file = UploadedFile::getInstance($this, 'image_file');
        $modelUpload->image_file = $this->image_file;
        $modelUpload->upload($idCreatedPost);

        $nameUploadedImage = "{$modelUpload->image_file->baseName}_0{$idCreatedPost}";

        $this->saveImage($nameUploadedImage, $idCreatedPost);
    }

    private function saveImage($nameUploadedImage, $idCreatedPost)
    {
        $modelImage = new Image();

        $modelImage->extension = $this->image_file->extension;
        $modelImage->name = $nameUploadedImage;
        $modelImage->post_id = $idCreatedPost;

        $modelImage->save();
    }
}
