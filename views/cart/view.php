<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//use Yii;
?>
<div class="container cart-view">
    <div class="row">

    <?php if( Yii::$app->session->hasFlash('success') ): ?>

        <div class="alert alert-success alert-dismissible" role="alert">

            <button type="button" class="close" data-dismiss="alert">
                <span>&times</span>
            </button>

            <?php echo Yii::$app->session->getFlash('success'); ?>

        </div>

    <?php endif; ?>

    <?php if( Yii::$app->session->hasFlash('error') ): ?>

        <div class="alert alert-danger alert-dismissible" role="alert">

            <button type="button" class="close" data-dismiss="alert">
                <span>&times</span>
            </button>

            <?php echo Yii::$app->session->getFlash('error'); ?>

        </div>

    <?php endif; ?>
        <?php
        if(!empty($session['cart'])): ?>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="w-100">
                    <tr>
                        <th>Фото</th>
                        <th>Наиенование</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th><span class="glyphicon glyphicon-remove"></span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($session['cart'] as $id => $item):?>
                        <tr>
                            <td><?= $item['img'] ?></td>
                            <td>
                                <a href="<?= Url::to(["product/view", 'id' => $id])?>">
                                    <?= $item['name'] ?>
                                </a>
                            </td>
                            <td><?= $item['qty'] ?></td>
                            <td><?= $item['price'] ?></td>
                            <td><span class="glyphicon glyphicon-remove text-danger" style = "cursor: pointer;" data-cart-delete-item = "<?= $id ?>"></span></td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <td colspan = "4">
                            Итого:
                        </td>
                        <td>
                            <?= $session['cart.qty'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan = "4">
                            На сумму:
                        </td>
                        <td>
                            <?= $session['cart.sum'] ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <hr />
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($order, 'name')->textInput(['value' => 'User Name']); ?>
        <?= $form->field($order, 'email')->textInput(['value' => 'email@test.com']);; ?>
        <?= $form->field($order, 'phone')->textInput(['value' => '222-333-22']);; ?>
        <?= $form->field($order, 'address')->textInput(['value' => 'City, Street']);; ?>
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']); ?>
        <?php ActiveForm::end() ?>
        <?php else : ?>
            <p>Ваша корзина пуста</p>
        <?php endif?>

    </div>
</div>
