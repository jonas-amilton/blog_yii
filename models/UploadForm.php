<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $image_file;

    public function rules()
    {
        return [
            [['image_file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image_file' => 'Imagem',
        ];
    }

    public function upload($idCreatedPost)
    {
        if ($this->validate()) {

            $alias = Yii::getAlias('@uploads');

            $this->image_file->saveAs($alias . "{$this->image_file->baseName}_0{$idCreatedPost}" . '.' . $this->image_file->extension);
            return true;
        } else {
            return false;
        }
    }

    public static function delete($filename)
    {
        $filenameToDelete = Yii::getAlias('@uploads') . $filename;

        if ($filenameToDelete) {
            unlink($filenameToDelete);

            return true;
        }
        return false;
    }
}
