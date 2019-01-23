<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lelang_hitung".
 *
 * @property integer $id
 * @property integer $id_lelang
 * @property string $bl_penjual
 * @property string $tgl_bl_penjual
 * @property string $bl_pembeli
 * @property string $tgl_bl_pembeli
 * @property string $bl_batal
 * @property string $tgl_bl_batal
 * @property string $pph_final
 * @property string $tgl_pph_final
 *
 * @property LelangHeader $idLelang
 */
class LelangHitung extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_hitung';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_lelang'], 'required'],
            [['id', 'id_lelang'], 'integer'],
            [['bl_penjual', 'bl_pembeli', 'bl_batal', 'pph_final'], 'number'],
            [['tgl_bl_penjual', 'tgl_bl_pembeli', 'tgl_bl_batal', 'tgl_pph_final'], 'safe'],
            [['id_lelang'], 'exist', 'skipOnError' => true, 'targetClass' => LelangHeader::className(), 'targetAttribute' => ['id_lelang' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lelang' => 'Objek Lelang',
            'bl_penjual' => 'Bea Lelang Penjual',
            'tgl_bl_penjual' => 'Tgl Penyetoran BL Penjual',
            'bl_pembeli' => 'Bea Lelang Pembeli',
            'tgl_bl_pembeli' => 'Tgl Penyetoran BL Pembeli',
            'bl_batal' => 'Bea Lelang Batal',
            'tgl_bl_batal' => 'Tgl Penyetoran BL Batal',
            'pph_final' => 'Pph Final',
            'tgl_pph_final' => 'Tgl Tgl Penyetoran PPH Final',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLelang()
    {
        return $this->hasOne(LelangHeader::className(), ['id' => 'id_lelang']);
    }
}
