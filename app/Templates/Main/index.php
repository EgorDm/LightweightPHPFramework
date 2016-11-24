<?php $this->start('sidebar'); ?>
<h1>Cart</h1>

<?php if (empty($this->cart['Items'])) { ?>
    <p>Your cart is empty</p>
<?php } else { ?>
    <table class="table">
        <tr>
            <th>Product</th>
            <th>Amount</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($this->cart['Items'] as $key => $value) { ?>
            <tr>
                <td><?= $value['title'] ?></td>
                <td><?= $value['amount'] ?></td>
                <td>$<?= money_format('%.2n', $value['amount'] * $value['price']) ?></td>
            </tr>
        <?php } ?>
    </table>
<?php }
$this->end(); ?>
<h1>GTR webshop</h1>
<div class="row">
    <?php foreach ($this->products as $product) {
        foreach ($this->cart['Items'] as $key => $value) {
            if($value['id'] == $product->id) {
                $product->stock -= $value['amount'];
            }
        }
        ?>
        <div class="col-md-4">
            <div class="product">
                <img src="<?= $product->images ?>"/>
                <div class="info">
                    <div class="description">
                        <h2><?= $product->title ?></h2>
                        <p>
                            <?= $product->description ?>
                            <br>
                            Stock: <?= $product->stock ?>
                        </p>
                    </div>
                    <form method="post" action="<?= $this->link(array('action' => 'addcart',)) ?>">
                        <input type="hidden" name="product" value="<?= $product->id ?>"/>
                        <div class="btn-group" role="group">
                            <a class="btn btn-default">Price $<?= money_format('%.2n', $product->price) ?></a>
                            <button type="submit" class="btn btn-primary">Add to cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php $this->start('scripts') ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
<script>
    $(function () {
        $('.description').matchHeight();
    });
</script>
<?php $this->end(); ?>

