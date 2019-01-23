<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lelang_rekening".
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
 * @property string $keterangan
 *
 * @property LelangRekeningJenisTrn $jnsTrn
 */
class LelangRekening extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lelang_rekening';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_date', 'value_date', 'branch', 'journal_no', 'description', 'debit', 'credit'], 'required'],
            [['id'], 'integer'],
            [['description', 'keterangan'], 'string'],
            [['debit', 'credit'], 'number'],
            [['tgl'], 'safe'],
            [['post_date', 'value_date'], 'string', 'max' => 100],
            [['branch', 'journal_no', 'jns_trn'], 'string', 'max' => 10],
            [['no_dokumen'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['jns_trn'], 'exist', 'skipOnError' => true, 'targetClass' => LelangRekeningJenisTrn::className(), 'targetAttribute' => ['jns_trn' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_date' => 'Post Date',
            'value_date' => 'Value Date',
            'branch' => 'Branch',
            'journal_no' => 'Journal No',
            'description' => 'Description',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'jns_trn' => 'Jns Trn',
            'no_dokumen' => 'No Dokumen',
            'tgl' => 'Tgl',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJnsTrn()
    {
        return $this->hasOne(LelangRekeningJenisTrn::className(), ['id' => 'jns_trn']);
    }
}
