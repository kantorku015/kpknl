<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lelang_setor_kas_negara".
 *
 * @property integer $id
 * @property string $tgl_bl_penjual
 * @property string $tgl_bl_pembeli
 * @property string $tgl_bl_batal
 * @property string $tgl_pph_final
 *
 * @property LelangHitung $id0
 */
class LelangSetorKasNegara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_setor_kas_negara';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['tgl_bl_penjual', 'tgl_bl_pembeli', 'tgl_bl_batal', 'tgl_pph_final'], 'safe'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => LelangHitung::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl_bl_penjual' => 'Tgl Bl Penjual',
            'tgl_bl_pembeli' => 'Tgl Bl Pembeli',
            'tgl_bl_batal' => 'Tgl Bl Batal',
            'tgl_pph_final' => 'Tgl Pph Final',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(LelangHitung::className(), ['id' => 'id']);
    }
}
