<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "iku_pic".
 *
 * @property int $id
 * @property int $id_head
 * @property int $seksi_pic
 * @property string $porsi_pic
 *
 * @property IkuCapaian[] $ikuCapaians
 * @property IkuHeader $head
 * @property KpknlStruktur $seksiPic
 * @property IkuTarget[] $ikuTargets
 */
class IkuPic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iku_pic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_head', 'seksi_pic', 'porsi_pic'], 'required'],
            [['id', 'id_head', 'seksi_pic'], 'integer'],
            [['porsi_pic'], 'number'],
            [['id'], 'unique'],
            [['id_head'], 'exist', 'skipOnError' => true, 'targetClass' => IkuHeader::className(), 'targetAttribute' => ['id_head' => 'id']],
            [['seksi_pic'], 'exist', 'skipOnError' => true, 'targetClass' => KpknlStruktur::className(), 'targetAttribute' => ['seksi_pic' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_head' => 'Uraian IKU',
            'seksi_pic' => 'Seksi Pic',
            'porsi_pic' => '% Kontribusi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIkuCapaians()
    {
        return $this->hasMany(IkuCapaian::className(), ['id_pic' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHead()
    {
        return $this->hasOne(IkuHeader::className(), ['id' => 'id_head']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeksiPic()
    {
        return $this->hasOne(KpknlStruktur::className(), ['id' => 'seksi_pic']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIkuTargets()
    {
        return $this->hasMany(IkuTarget::className(), ['id_pic' => 'id']);
    }
}
