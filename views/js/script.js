// Auth
let msg = new URLSearchParams(window.location.search).get('msg');
if (msg == "logout") {
    $("#alert-value").html("Anda berhasil logout");
} else {
    $("#alert").hide();
}

$("#login").submit(function (e) {
    e.preventDefault();
    let serializedData = $(this).serialize();
    let post = $.post("/auth?req=ajax", serializedData)

    post.done(function (data) {
        if (data == "success") {
            window.location.href = "/";
        } else if (data == "failed") {
            $("#alert").show();
            $("#alert-value").html("Username dan Password salah!");
        }
    });

    post.fail(function (data) {
        alert("error");
    });
});

$("#user-login").click(function () {
    $("#logout").toggle();
});

$("#logout").click(function (e) {
    let get = $.get("/auth?req=ajax");

    get.done(function (data) {
        window.location.href = "/login?msg=logout";
    });

    get.fail(function (data) {
        alert("error");
    });
});
// End Auth


// Order
let number;

$("#orderView").click(function (event) {
    event.preventDefault();
    orderView();
});


function orderView() {
    console.clear()
    $.get("/order?req=ajax", function (data) {
        $("#content").html(data);
        readDataOrder();

        $.get("/order/deleteView?req=ajax", function (data) {
            $("#modalOrderDelete").html(data);
        });
    });
}

let datasetOrder = null;

function readDataOrder(){
    $.get("/order/read?req=ajax", function (data) {
        $("#order-table > tbody").children().remove();
        $("#order-table > tbody").append(data);
        $("#order-table > tbody").children().children().addClass("align-middle");
    });
    datasetOrder = null;
}

function setdataOrder(e, id){
    datasetOrder = id;
    $("tbody > tr").removeClass("table-secondary");
    $(e).addClass("table-secondary");
}

function openCreateView(){
    $.get("/order/createView?req=ajax", function (data) {
        $("#content").html(data);
    });
}

let with_print = false;

function openPrint(){
    if (datasetOrder == null) return false;
    $.get("/order/print", { id: datasetOrder }, function (data) {
        $("#printableArea").html(data);
        printDiv("printableArea");
    });
}

function printDiv(divName) {
    let printContents = document.getElementById(divName).innerHTML;
    let originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

function setOrderDeleteModal(){
    if (datasetOrder == null) return false;
    $("#deleteModalOrder").modal('show');
    $("#id-delete").val(datasetOrder);
}

$(document).click(function (e) {
    if (!$(e.target).closest('tbody > tr').length) {
        $("tbody > tr").removeClass("table-secondary");
        datasetOrder = null;
    }
});
// End Order


// Product
$("#productView").click(function (event) {
    event.preventDefault();
    console.clear()
    $.get("/product?req=ajax", function (data) {
        $("#content").html(data);
        readDataProduct();
        
        $.get("/product/createView?req=ajax", function (data) {
            $("#modalProductCreate").html(data);
        });
        $.get("/product/updateView?req=ajax", function (data) {
            $("#modalProductUpdate").html(data);
        });
        $.get("/product/deleteView?req=ajax", function (data) {
            $("#modalProductDelete").html(data);
        });
    });
});

let datasetProduct = null;

function readDataProduct(){
    $.get("/product/read?req=ajax", function (data) {
        $("#product-table > tbody").children().remove();
        $("#product-table > tbody").append(data);
        $("#product-table > tbody").children().children().addClass("align-middle");
    });
    datasetProduct = null;
}

function setdataProduct(e, data) {
    datasetProduct = data;
    $("tbody > tr").removeClass("table-secondary");
    $(e).addClass("table-secondary");
}

function setProductEditModal() {
    if (datasetProduct == null) return false;
    $("#editModalProduct").modal('show');
    $("#id-edit").val(datasetProduct.id);
    $("#code-edit").val(datasetProduct.code);
    $("#name-edit").val(datasetProduct.name);
    $("#stock-edit").val(datasetProduct.stock);
    $("#price-edit").val(datasetProduct.price);
}

function setProductDeleteModal() {
    if (datasetProduct == null) return false;
    $("#deleteModalProduct").modal('show');
    $("#id-delete").val(datasetProduct.id);
}

$(document).click(function (e) {
    if (!$(e.target).closest('tbody > tr').length) {
        $("tbody > tr").removeClass("table-secondary");
        datasetProduct = null;
    }
});
// End Product


// User
$("#userView").click(function (event) {
    event.preventDefault();
    console.clear()
    $.get("/user?req=ajax", function (data) {
        $("#content").html(data);
        readDataUser();

        $.get("/user/createView?req=ajax", function (data) {
            $("#modalUserCreate").html(data);
        });
        $.get("/user/updateView?req=ajax", function (data) {
            $("#modalUserUpdate").html(data);
        });
        $.get("/user/deleteView?req=ajax", function (data) {
            $("#modalUserDelete").html(data);
        });
    });
});

let datasetUser = null;

function readDataUser() {
    $.get("/user/read?req=ajax", function (data) {
        $("#user-table > tbody").children().remove();
        $("#user-table > tbody").append(data);
        $("#user-table > tbody").children().children().addClass("align-middle");
    });
    datasetUser = null;
}

function setdataUser(e, data) {
    datasetUser = data;
    $("tbody > tr").removeClass("table-secondary");
    $(e).addClass("table-secondary");
}

function setUserEditModal() {
    if (datasetUser == null) return false;
    $("#editModalUser").modal('show');
    $("#id-edit").val(datasetUser.id);
    $("#username-edit").val(datasetUser.username);
    $("#password-edit").val(datasetUser.password);
}

function setUserDeleteModal() {
    if (datasetUser == null) return false;
    $("#deleteModalUser").modal('show');
    $("#id-delete").val(datasetUser.id);
}

$(document).click(function (e) {
    if (!$(e.target).closest('tbody > tr').length) {
        $("tbody > tr").removeClass("table-secondary");
        datasetUser = null;
    }
});
// End User
