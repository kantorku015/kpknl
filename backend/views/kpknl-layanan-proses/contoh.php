<?php
// THE VIEW
use kartik\widgets\DepDrop;

// Top most parent
echo $form->field($account, 'lev0')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Account::find()
        ->where('parent IS NULL')
        ->asArray()
        ->all(), 'id', 'name')
]);

// Child level 1
echo $form->field($account, 'lev1')->widget(DepDrop::classname(), [
    'data'=> [6=>'Bank'],
    'options' => ['placeholder' => 'Select ...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>[
        'pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['account-lev0'],
        'url' => Url::to(['/account/child-account']),
        'loadingText' => 'Loading child level 1 ...',
    ]
]);

// Child level 2
echo $form->field($account, 'lev2')->widget(DepDrop::classname(), [
    'data'=> [9=>'Savings'],
    'options' => ['placeholder' => 'Select ...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['account-lev1'],
        'url' => Url::to(['/account/child-account']),
        'loadingText' => 'Loading child level 2 ...',
    ]
]);

// Child level 3
echo $form->field($account, 'lev3')->widget(DepDrop::classname(), [
    'data'=> [12=>'Savings A/C 2'],
    'options' => ['placeholder' => 'Select ...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['account-lev2'],
        'initialize' => true,
        'initDepends'=>['account-lev0'],
        'url' => Url::to(['/account/child-account']),
        'loadingText' => 'Loading child level 3 ...'
    ]
]);


// CONTROLLER
public function actionChildAccount() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $id = end($_POST['depdrop_parents']);
        $list = Account::find()->andWhere(['parent'=>$id])->asArray()->all();
        $selected  = null;
        if ($id != null && count($list) > 0) {
            $selected = '';
            foreach ($list as $i => $account) {
                $out[] = ['id' => $account['id'], 'name' => $account['name']];
                if ($i == 0) {
                    $selected = $account['id'];
                }
            }
            // Shows how you can preselect a value
            echo Json::encode(['output' => $out, 'selected'=>$selected]);
            return;
        }
    }
    echo Json::encode(['output' => '', 'selected'=>'']);
}
?>