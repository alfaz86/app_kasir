<div class="modal fade" id="deleteModalProduct" tabindex="-1" role="dialog" aria-labelledby="deleteModalProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="deleteDataProduct">
                <div class="modal-body mt-3">
                    <input type="hidden" name="id" id="id-delete">
                    <h4 class="text-center m-3">Apakah Anda yakin ingin menghapus data ini?</h4>
                </div>
                <div class="text-center mb-5">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#deleteDataProduct").submit(function(e){
        e.preventDefault();
        let serializedData = $(this).serialize();
        let post = $.post("product/delete?req=ajax", serializedData)
        
        post.done(function(data) {
            $("#deleteModalProduct").modal("hide");
            readDataProduct();
        });
        
        post.fail(function(data) {
            console.log(data.responseText);
            alert(data.responseText);
        });
    });
</script>