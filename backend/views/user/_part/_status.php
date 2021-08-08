<?php

use kartik\select2\Select2;
use common\models\User;

?>

<?= $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => [
                User::STATUS_ACTIVE => 'Активный',
                User::STATUS_INACTIVE =>'Не активный',
                User::STATUS_DELETED => 'Удаленный'
            ],
            'options' => ['placeholder' => 'Выберете ...'],
            'pluginOptions' => [
            'allowClear' => true,
            'multiple' => false
        ],
    ]);?>