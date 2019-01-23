<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_risalah".
 *
 * @property integer $id
 * @property string $rl_no
 * @property string $rl_tgl
 * @property integer $id_pl
 * @property string $sppl_no
 * @property string $sppl_tgl
 *
 * @property LelangPl $idPl
 */
class LelangRisalah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_risalah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rl_no', 'rl_tgl', 'id_pl'], 'required'],
            [['id', 'id_pl'], 'integer'],
            [['rl_tgl', 'sppl_tgl'], 'safe'],
            [['rl_no', 'sppl_no'], 'string', 'max' => 15],
            [['rl_no', 'sppl_no'], 'unique', 'targetAttribute' => ['rl_no', 'sppl_no'], 'message' => 'The combination of Rl No and Sppl No has already been taken.'],
            [['id_pl'], 'exist', 'skipOnError' => true, 'targetClass' => LelangPl::className(), 'targetAttribute' => ['id_pl' => 'id']],

            //tambahan
            //tambahan
              [['created_by', 'updated_by',], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rl_no' => 'Nomor RL',
            'rl_tgl' => 'Tgl RL',
            'id_pl' => 'Nama PL',
            'sppl_no' => 'Nomor SPPL',
            'sppl_tgl' => 'Tgl SPPL',

            //tambahan
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPl()
    {
        return $this->hasOne(LelangPl::className(), ['id' => 'id_pl']);
    }
}
