<?php
/**
 * author: yidashi
 * Date: 2015/12/3
 * Time: 10:57.
 */

/* @var $this yii\web\View */
/* @var $model common\models\Article */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="article-create">

    <h4><?= $createTitle ?></h4>

    <?php $form = ActiveForm::begin(['action' => Url::to(['/comment/create'])]); ?>
    <?= $form->field($model, 'content')->label(false)->widget('\yidashi\markdown\Markdown', ['options' => ['style' => 'height:200px;']]); ?>
    <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'type_id')->hiddenInput()->label(false) ?>
    <div class="form-group">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        <?php else: ?>
            <?= Html::a('登录', ['/user/security/login'], ['class' => 'btn btn-primary'])?>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>
    <!--回复-->
    <?php $form = ActiveForm::begin(['action' => Url::to(['/comment/create']), 'options' => ['class' => 'reply-form hidden']]); ?>
    <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'type_id')->hiddenInput()->label(false) ?>
    <?= Html::hiddenInput(Html::getInputName($model, 'parent_id'), 0, ['class' => 'parent_id']) ?>
    <?=$form->field($model, 'content')->label(false)->textarea()?>
    <div class="form-group">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= Html::submitButton('回复', [
                'class' => 'btn btn-sm btn-primary',
                'data-ajax' => '1',
                'data-refresh-pjax-container' => 'comment-container'
            ]) ?>
        <?php else: ?>
            <?= Html::a('登录', ['/user/security/login'], ['class' => 'btn btn-primary'])?>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
