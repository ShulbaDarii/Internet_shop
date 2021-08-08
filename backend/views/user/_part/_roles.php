<?php

use kartik\select2\Select2;

?>

<?= $form->field($model, 'roles')->widget(Select2::classname(), [
            'data' => $roles_array,
            'options' => ['placeholder' => 'Выберете ...'],
            'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]);?>