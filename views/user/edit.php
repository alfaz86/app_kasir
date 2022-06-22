<div class="modal fade" id="editModalUser" tabindex="-1" role="dialog" aria-labelledby="editModalUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalUserLabel">Edit Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateDataUser">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id-edit">
                    <div class="form-group row mb-3">
                        <label for="username" class="col-sm-3">User Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username-edit" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="password" class="col-sm-3">Password</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="password" id="password-edit" autocomplete="off">
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
    $("#updateDataUser").submit(function (e) {
        e.preventDefault();
        let serializedData = $(this).serialize();
        let username = $(this).serializeArray()[1].value;
        let post = $.post("/user/update?req=ajax", serializedData);

        post.done(function (data) {
            if (data == "session_update") {
                $("#user-login-name").html(username);
            }
            $("#updateDataUser").trigger("reset");
            $("#editModalUser").modal("hide");
            readDataUser();
        });

        post.fail(function (data) {
            console.log(data.responseText);
            alert(data.statusText);
        });
    });
</script>