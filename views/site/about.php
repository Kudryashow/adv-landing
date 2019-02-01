<?php
use app\widgets\HelloWidget;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Progress;
use yii\captcha\Captcha;
use yii\helpers\Html;

?>
<?php HelloWidget::begin(); ?>

    sample content that may contain one or more <strong>HTML</strong> <pre>tags</pre>

    If this content grows too big, use sub views

    For e.g.

<?php HelloWidget::end(); ?>
<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
<?php echo \kartik\widgets\RangeInput::widget([
    'name' => 'brightness',
    'html5Options' => ['min' => 0, 'max' => 1, 'step' => 1],
    'options' => ['placeholder' => 'Control brightness...'],
    'addon' => ['append' => ['content' => '%']],
]); ?>

<div class = "form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary',
        'name' => 'contact-button']) ?>
</div>
<?php ActiveForm::end(); ?>
