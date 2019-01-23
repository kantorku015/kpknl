<?php
//https://yii2-framework.readthedocs.io/en/stable/guide/input-file-upload/
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // [['file'], 'file'],
             [['file'], 'file', 'skipOnEmpty' => false],
            // [['file'], 'file', 'extensions' => 'csv', 'skipOnEmpty' => false],
            // [['file'], 'file', 'extensions' => 'csv'],
        ];
    }
}
?>