<div class="modal fade" id="editModalProduct" tabindex="-1" role="dialog" aria-labelledby="editModalProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalProductLabel">Edit Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateDataProduct">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id-edit">
                    <div class="form-group row mb-3">
                        <label for="code" class="col-sm-3">Kode Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="code" id="code-edit" autocomplete="off" maxlength="5">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="name" class="col-sm-3">Nama Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name-edit" autocomplete="off" maxlength="25">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="stock" class="col-sm-3">Stok Barang</label>
                        <div class="col-sm-9">
                            <input type="integer" class="form-control" name="stock" id="stock-edit" autocomplete="off" maxlength="3">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="price" class="col-sm-3">Harga Barang</label>
                        <div class="col-sm-9">
                            <input type="integer" class="form-control" name="price" id="price-edit" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#updateDataProduct").submit(function (e) {
        e.preventDefault();
        let serializedData = $(this).serialize();
        let post = $.post("/product/update?req=ajax", serializedData);

        post.done(function (data) {
            $("#updateDataProduct").trigger("reset");
            $("#editModalProduct").modal("hide");
            readDataProduct();
        });

        post.fail(function (data) {
            console.log(data.responseText);
            alert(data.statusText);
        });
    });
</script>