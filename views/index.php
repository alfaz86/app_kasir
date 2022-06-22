<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_ENV["APP_NAME"] ?></title>
    <link rel="shortcut icon" href="#">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .card-link{
            cursor: pointer;
        }
        #logout {
            display: none;
            position: absolute;
            background-color: #212529;
            padding: 7px 7px;
            z-index: 1;
        }
        #logout:hover {
            background: #2f353a;
        }
        #printableArea {
            position: absolute;
            top: -1000px;
            z-index: -1;
        }
        .t-r{
            text-align: right !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><?= $_ENV["APP_NAME"] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/" id="orderView">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/" id="productView">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/" id="userView">User</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <div id="user-login" style="cursor: pointer;"><i class="bi bi-person-circle"></i> <span id="user-login-name"><?= $_SESSION['USER'] ?></span></div>
                    <a class="text" href="#" id="logout" style="display: none;">Logout</a>
                </span>
            </div>
        </div>
    </nav>

    <div id="content" class="mb-5">
        <div class="container mt-5">
            <div class="row" data-masonry='{"percentPosition": true }'>
                <div class="col-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-plus-circle-fill"></i> Tambah Order Baru</h5>
                            <p class="card-text">Buat transaksi baru disini.</p>
                            <a class="card-link" onclick="openCreateView();">Buat Pesanan</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-bag-check-fill"></i> Order</h5>
                            <span class="card-text d-block">Total Order : <b><?= $total_order ?></b> </span>
                            <p class="card-text d-block">Total Order Hari ini : <b><?= $total_order_today ?></b> </p>
                            <a class="card-link" onclick="orderView();">Lihat Order</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <h5 class="card-title"><i class="bi bi-archive-fill"></i> Produk</h5>
                                    <p class="card-text">Produk Saat ini.</p>
                                </div>
                                <div class="col-6 text-right">
                                    <b style="position: absolute; right:20px; font-size: 50px;"><?= $total_product ?></b>
                                </div>
                            </div>
                            <hr>
                            <h6>3 Produk dengan penjualan terbanyak</h6>
                            <div class="w-100">
                                <table class="table table-bordered">
                                    <?php foreach ($most_products as $i => $product) {
                                        $element = "<tr>
                                            <td>".($i+1)."</td>
                                            <td class='w-50'>".$product->name."</td>
                                            <td class='w-50 t-r'>".$product->qty."</td>
                                        </tr>";
                                        echo $element;
                                    } ?>
                                </table>
                            </div>
                            <a class="card-link" onclick="$('#productView').trigger('click');">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <h5 class="card-title"><i class="bi bi-person-circle"></i> User</h5>
                                    <p class="card-text">Total User saat ini.</p>
                                </div>
                                <div class="col-6 text-right">
                                    <b style="position: absolute; right:20px; font-size: 50px;"><?= $total_user ?></b>
                                </div>
                            </div>
                            <a class="card-link" onclick="$('#userView').trigger('click');">Lihat list User</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

    <script src="views/js/script.js"></script>
</body>
</html>