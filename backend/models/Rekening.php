<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rekening".
 *
 * @property string $id
 * @property string $post_date
 * @property string $value_date
 * @property string $branch
 * @property string $journal_no
 * @property string $description
 * @property string $debit
 * @property string $credit
 */
class Rekening extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rekening';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['debit', 'credit'], 'number'],
            [['post_date', 'value_date', 'branch', 'journal_no'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
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
        ];
    }
}
