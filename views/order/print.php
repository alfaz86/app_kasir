<div class="w-100">
    <h1 class="text-center mb-3" >App Kasir</h1>
    <span>No.Order : <?= $order->no_transaction ?></span>
    <br><span>Tanggal : <?= date("y/m/d") ?></span></br>
    <span>Kasir : <?= $_SESSION['USER'] ?></span>
    ===========================================
</div>
<table id="print-table" class="w-100 mt-3 mb-2">
    <thead>
        <tr>
            <th class="w-auto">Barang</th>
            <th class="w-auto">Qty</th>
            <th class="w-auto">Harga</th>
            <th class="w-auto t-r">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($order->items as $i => $item) {
            $element = "<tr>
                <td>".$item->name."</td>
                <td class='t-r'>".$item->qty."</td>
                <td class='t-r'>".number_format($item->price, 0, ",", ",")."</td>
                <td class='t-r'>".number_format($item->subtotal, 0, ",", ",")."</td>
            </tr>";
            echo $element;
        } ?>
    </tbody>
</table>
<div>
    ===========================================
</div>
<table class="w-100">
    <tbody>
        <tr>
            <td>Total Item</td>
            <td><?= $order->total_item ?></td>
            <td class="w-25 t-r"></td>
        </tr>
        <tr>
            <td>Total Belanja</td>
            <td colspan="2" class='t-r'><?= number_format($order->total_price, 0, ",", ",") ?></td>
        </tr>
        <tr>
            <td>Tunai</td>
            <td colspan="2" class='t-r'><?= number_format($order->paid, 0, ",", ",") ?></td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td colspan="2" class='t-r'><?= number_format($order->change, 0, ",", ",") ?></td>
        </tr>
    </tbody>
</table>