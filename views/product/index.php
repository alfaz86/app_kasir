<div class="container mt-5">
    <h1 class="text-left mt-5 mb-5">Data Produk</h1>
    
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModalProduct"><i class="bi bi-plus-square"></i></button>
    <button type="button" class="btn btn-warning mb-3" onclick="setProductEditModal()"><i class="bi bi-pencil-square"></i></button>
    <button type="button" class="btn btn-danger mb-3" onclick="setProductDeleteModal()"><i class="bi bi-x-square"></i></button>

    <div class="table-responsive">  
        <table id="product-table" class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th width="1">No</th>
                    <th class="w-25">Kode Barang</th>
                    <th class="w-25">Nama Barang</th>
                    <th class="w-25">Stok Barang</th>
                    <th class="w-25">Harga Barang</th>
                </tr>
            </thead>
            <tbody>
    
            </tbody>
        </table>
    </div>
</div>

<div id="modalProductCreate"></div>
<div id="modalProductUpdate"></div>
<div id="modalProductDelete"></div>