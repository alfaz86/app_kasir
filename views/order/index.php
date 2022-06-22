<div class="container mt-5">
    <h1 class="text-left mt-5 mb-5">Data Order</h1>
    
    <button type="button" class="btn btn-primary mb-3" onclick="openCreateView()"><i class="bi bi-plus-square"></i></button>
    <button type="button" class="btn btn-danger mb-3" onclick="setOrderDeleteModal()"><i class="bi bi-x-square"></i></button>
    <button type="button" class="btn btn-success mb-3" onclick="openPrint()"><i class="bi bi-printer"></i></button>

    <div class="table-responsive">
        <table id="order-table" class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th class="align-middle" width="1" rowspan="2">No</th>
                    <th class="align-middle" width="1" rowspan="2">No Transaksi</th>
                    <th class="w-50 text-center" colspan="4">Barang</th>
                    <th class="align-middle" width="1" rowspan="2">Total Item</th>
                    <th class="align-middle" rowspan="2">Total Harga</th>
                    <th class="align-middle" rowspan="2">Dibayar</th>
                    <th class="align-middle" rowspan="2">Kembalian</th>
                </tr>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
    
            </tbody>
        </table>
    </div>
</div>

<div id="modalOrderDelete"></div>
<div id="printableArea"></div>