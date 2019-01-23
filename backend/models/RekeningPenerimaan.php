<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rekening_penerimaan".
 *
 * @property int $id
 * @property string $post_date
 * @property string $value_date
 * @property string $branch
 * @property string $journal_no
 * @property string $description
 * @property double $debit
 * @property double $credit
 * @property string $jns_trn
 * @property string $no_dokumen
 * @property string $tgl
 * @property string $jam
 * @property string $keterangan
 *
 * @property RekeningJenisTrn $jnsTrn
 */
class RekeningPenerimaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rekening_penerimaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'id',*/ 'post_date', 'value_date', 'branch', 'journal_no', 'description', 'debit', 'credit'], 'required'],
            [['id','id_parent','id_child'], 'integer'],
            [['description', 'keterangan'], 'string'],
            [['debit', 'credit'], 'number'],
            [['tgl', 'jam'], 'safe'],
            [['post_date', 'value_date'], 'string', 'max' => 100],
            [['branch', 'journal_no', 'jns_trn'], 'string', 'max' => 10],
            [['no_dokumen'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['jns_trn'], 'exist', 'skipOnError' => true, 'targetClass' => RekeningJenisTrn::className(), 'targetAttribute' => ['jns_trn' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'ID Induk',
            'id_child' => 'ID Sub',
            'post_date' => 'Post Date',
            'value_date' => 'Value Date',
            'branch' => 'Branch',
            'journal_no' => 'Journal No',
            'description' => 'Description',
            'debit' => 'Uang Keluar',
            'credit' => 'Uang Masuk',
            'jns_trn' => 'Jns Trn',
            'no_dokumen' => 'No Dokumen',
            'tgl' => 'Tgl',
            'jam' => 'Jam',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJnsTrn()
    {
        return $this->hasOne(RekeningJenisTrn::className(), ['id' => 'jns_trn']);
    }
    
}
