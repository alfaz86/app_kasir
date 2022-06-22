<div class="container mt-5">
    <h1 class="text-left mt-5 mb-5">Transaksi Order</h1>

    <div class="container w-50 mb-5">
        <h5>Masukan Barang</h5>
        <select id="search">
            <option value="" disabled selected></option>
            <?php if (mysqli_num_rows($products) > 0) {
                while($product = mysqli_fetch_array($products)){
                    echo "<option value='$product[id]' data-product='".json_encode($product)."'>$product[name]</option>";
                }
            } ?>
        </select>
    </div>

    <form id="createOrder">
        <div class="table-responsive">
            <table id="list-product-table" class="table table-bordered mb-5">
                <thead>
                    <tr>
                        <th width="1">No</th>
                        <th class="w-25">Nama Barang</th>
                        <th class="w-auto">Jumlah Barang</th>
                        <th class="w-25">Harga Barang</th>
                        <th class="w-25">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">TOTAL</th>
                        <th><input type="number" class="form-control" name="total" id="total" value="0" readonly></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="container w-50 mb-5">
            <h5>Tunai</h5>
            <input type="number" class="form-control mb-3" name="paid" id="paid" value="0" min="0" autocomplete="off" onchange="calculateChange(this.value)" required>
            <h5>Kembalian</h5>
            <input type="number" class="form-control" name="change" id="change" value="0" readonly>
        </div>

        <button type="submit" class="btn btn-success" onclick="with_print = true">Tambah dan Print</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a class="btn btn-secondary" href="/order" id="backToOrderView">Kembali</a>
    </form>
</div>

<script>
    number  = $(".row-product").length ?? 0;

    $("#search").select2({
        width: "100%"
    });
    
    $("#search").on("select2:select", function(e) {
        let product = JSON.parse(e.params.data.element.dataset.product);
        if (checkIsExistProduct(product.id) == true) return false;
        let element = `
            <tr class="row-product" data-id="${product.id}">
                <th>${number+=1}</th>
                <th>
                    <input type="text" class="form-control" name="name[]" value="${product.name}" readonly>
                    <input type="hidden" class="form-control" name="product_id[]" value="${product.id}" readonly>
                </th>
                <th><input type="number" class="form-control" name="qty[]" min="1" value="1" autocomplete="off" onchange="calculateOrder(this.value, ${product.id}, ${product.price})"></th>
                <th><input type="number" class="form-control" name="price[]" value="${product.price}" readonly></th>
                <th><input type="number" class="form-control subtotal" name="subtotal[]" id="subtotal-${product.id}" value="${product.price}" readonly></th>
            </tr>
        `;
        $("#list-product-table > tbody ").append(element);
        calculateOrderTotal();
    });

    function checkIsExistProduct(id){
        let ids = [];
        $.each($(".row-product"), function( index, value ) {
            ids.push(value.dataset.id);
        });
        if (ids.includes(id)) {
            return true;
        } else {
            return false;
        }
    }

    function calculateOrder(qty, id, price){
        let subtotal = qty * price;
        $(`#subtotal-${id}`).val(subtotal);
        calculateOrderTotal();
    }

    function calculateOrderTotal(){
        let total = 0;
        $.each($(".subtotal"), function( i , v ) {
            total += Number(v.value);
        });
        $(`#total`).val(total);
        $(`#paid`).val(null);
    }

    function calculateChange(value, return_value = false){
        let total   = $("#total").val();
        let change  = Number(value) - Number(total);
        if (return_value) {
            return change;
        }
        if (isPaid(change)) {
            $("#change").val(change);
        } else {
            alert("Pembayaran masih kurang!");
            $("#change").val(0);
        }
    }

    function isPaid(change){
        if (change < 0) {
            return false;
        } else {
            return true;
        }
    }

    $("#backToOrderView").click(function (event) {
        event.preventDefault();
        orderView();
    });

    $("#createOrder").submit(function (e) {
        e.preventDefault();
        let serializedData = $(this).serialize();
        if ($(".row-product").length == 0) {
            alert("Barang masih kosong!");
            return false;
        }
        let getChange = calculateChange($("#paid").val(), true);
        if (!isPaid(getChange)) {
            alert("Pembayaran masih kurang!");
            return false;
        }
        
        let post = $.post("/order/create?req=ajax", serializedData);

        post.done(function (data) {
            if(!alert('Data behasil ditambahkan!')){
                orderView();
                if (with_print) {
                    datasetOrder = data;
                    openPrint();
                }
            }
        });

        post.fail(function (data) {
            console.log(data.responseText);
            alert(data.statusText);
        });
    });
</script>