<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="login-box">
    <div class="login-logo">
        <b>Install Yii-kit CMS</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=Yii::t('app', 'These information will be used for create admin user');?></p>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($installForm, 'root_login', [
            'template' => '{error}<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-user form-control-feedback"></span></div>',
        ])->textInput(['placeholder' => $installForm->getAttributeLabel( 'root_login' )]); ?>

        <?= $form->field($installForm, 'root_email', [
            'template' => '{error}<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span></div>'
        ])->textInput(['placeholder' => $installForm->getAttributeLabel( 'root_email' )]); ?>

        <?= $form->field($installForm, 'root_password', [
            'template' => '{error}<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span></div>'
        ])->passwordInput(['placeholder' => $installForm->getAttributeLabel( 'root_password' )]); ?>

        <?= Html::submitButton(Yii::t('app', 'Install'), ['class' => 'btn btn-lg btn-primary btn-block']) ?>

        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div>
