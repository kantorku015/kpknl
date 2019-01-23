<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gudang_pkn".
 *
 * @property int $id
 * @property int $id_lemari
 * @property int $id_satker
 * @property string $isi_berkas
 *
 * @property LemariPkn $lemari
 * @property Satker $satker
 */
class GudangPkn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gudang_pkn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'id',*/ 'id_lemari', 'id_satker', 'isi_berkas'], 'required'],
            [['id', 'id_lemari', 'id_satker'], 'integer'],
            [['isi_berkas'], 'string'],
            [['id'], 'unique'],
            [['id_lemari'], 'exist', 'skipOnError' => true, 'targetClass' => LemariPkn::className(), 'targetAttribute' => ['id_lemari' => 'id']],
            [['id_satker'], 'exist', 'skipOnError' => true, 'targetClass' => Satker::className(), 'targetAttribute' => ['id_satker' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lemari' => 'Nama Lemari',
            'id_satker' => 'Nama Satker',
            'isi_berkas' => 'Isi Berkas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLemari()
    {
        return $this->hasOne(LemariPkn::className(), ['id' => 'id_lemari']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatker()
    {
        return $this->hasOne(Satker::className(), ['id' => 'id_satker']);
    }
}
