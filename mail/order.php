<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead class="w-100">
            <tr>
                <th>Фото</th>
                <th>Наиенование</th>
                <th>Кол-во</th>
                <th>Цена</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach($session['cart'] as $id => $item):?>
            <tr>
                <td><?= $item['img'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['qty'] ?></td>
                <td><?= $item['price'] ?></td>
            </tr>
            <?php endforeach ?>
            <tr>
                <td colspan = "3">
                    Итого:
                </td>
                <td>
                    <?= $session['cart.qty'] ?>
                </td>
            </tr>
            <tr>
                <td colspan = "3">
                    На сумму:
                </td>
                <td>
                    <?= $session['cart.sum'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
