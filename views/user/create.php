<div class="modal fade" id="addModalUser" tabindex="-1" role="dialog" aria-labelledby="addModalUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalUserLabel">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createDataUser">
                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label for="username" class="col-sm-3">User Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="password" class="col-sm-3">Password</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="password" id="password" autocomplete="off">
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
    $("#createDataUser").submit(function (e) {
        e.preventDefault();
        let serializedData = $(this).serialize();
        let post = $.post("/user/create?req=ajax", serializedData);

        post.done(function (data) {
            $("#createDataUser").trigger("reset");
            $("#addModalUser").modal("hide");
            readDataUser();
        });

        post.fail(function (data) {
            console.log(data.responseText);
            alert(data.statusText);
        });
    });
</script>