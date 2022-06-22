<div class="container mt-5">
    <h1 class="text-left mt-5 mb-5">Data User</h1>
    
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModalUser"><i class="bi bi-plus-square"></i></button>
    <button type="button" class="btn btn-warning mb-3" onclick="setUserEditModal()"><i class="bi bi-pencil-square"></i></button>
    <button type="button" class="btn btn-danger mb-3" onclick="setUserDeleteModal()"><i class="bi bi-x-square"></i></button>

    <div class="table-responsive">
        <table id="user-table" class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th width="1">No</th>
                    <th class="w-50">Username</th>
                    <th class="w-50">Password</th>
                </tr>
            </thead>
            <tbody>
    
            </tbody>
        </table>
    </div>
</div>

<div id="modalUserCreate"></div>
<div id="modalUserUpdate"></div>
<div id="modalUserDelete"></div>