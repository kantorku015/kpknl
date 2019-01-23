<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dok_summary".
 *
 * @property string $no_dokumen
 * @property double $credit
 * @property double $debit
 * @property double $saldo
 */
class DokSummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dok_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['credit', 'debit', 'saldo'], 'number'],
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
            'credit' => 'Credit',
            'debit' => 'Debit',
            'saldo' => 'Saldo',
        ];
    }
}
