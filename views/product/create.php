<div class="modal fade" id="addModalProduct" tabindex="-1" role="dialog" aria-labelledby="addModalProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalProductLabel">Tambah Data Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createDataProduct">
                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label for="code" class="col-sm-3">Kode Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="code" id="code" autocomplete="off" maxlength="5">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="name" class="col-sm-3">Nama Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off" maxlength="25">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="stock" class="col-sm-3">Stok Barang</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="stock" id="stock" autocomplete="off" maxlength="3">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="price" class="col-sm-3">Harga Barang</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="price" id="price" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#createDataProduct").submit(function (e) {
        e.preventDefault();
        let serializedData = $(this).serialize();
        let post = $.post("/product/create?req=ajax", serializedData);

        post.done(function (data) {
            $("#createDataProduct").trigger("reset");
            $("#addModalProduct").modal("hide");
            readDataProduct();
        });

        post.fail(function (data) {
            console.log(data.responseText);
            alert(data.statusText);
        });
    });
</script>