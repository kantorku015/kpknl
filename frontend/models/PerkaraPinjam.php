<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "perkara_pinjam".
 *
 * @property integer $id
 * @property string $no_perkara
 * @property string $peminjam
 * @property string $tgl_pinjam
 * @property string $tgl_kembali
 * @property string $keterangan
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Perkara $noPerkara
 */
class PerkaraPinjam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perkara_pinjam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'no_perkara', 'peminjam', 'tgl_pinjam'], 'required'],
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['tgl_pinjam', 'tgl_kembali', 'created_at', 'updated_at'], 'safe'],
            [['keterangan'], 'string'],
            [['no_perkara'], 'string', 'max' => 100],
            [['peminjam'], 'string', 'max' => 20],
            [['no_perkara'], 'exist', 'skipOnError' => true, 'targetClass' => Perkara::className(), 'targetAttribute' => ['no_perkara' => 'no_perkara']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_perkara' => 'No Perkara',
            'peminjam' => 'Peminjam',
            'tgl_pinjam' => 'Tgl Pinjam',
            'tgl_kembali' => 'Tgl Kembali',
            'keterangan' => 'Keterangan',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoPerkara()
    {
        return $this->hasOne(Perkara::className(), ['no_perkara' => 'no_perkara']);
    }
}
