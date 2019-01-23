<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dok_summary_belum_lengkap".
 *
 * @property string $no_dokumen
 */
class DokSummaryBelumLengkap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dok_summary_belum_lengkap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_dokumen'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'no_dokumen' => 'No Dokumen',
        ];
    }
}
