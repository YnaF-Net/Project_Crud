<?php
$select = mysqli_query($koneksi, "SELECT products.*, categories.category_name FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY id DESC");
$rowProducts = mysqli_fetch_all($select, MYSQLI_ASSOC);
// var_dump($rowProducts)
if (isset($_GET['delete'])) {
    $id = $_GET['delete'] ?? 0;
    $cekFoto = mysqli_query($koneksi, "SELECT product_image FROM products WHERE id='$id'");
    $rowFoto = mysqli_fetch_assoc($cekFoto);
    if ($rowFoto) {
        $foto = $rowFoto['product_image'];
        if (file_exists("assets/uploads/" . $foto) && !empty($foto)) {
            unlink("assets/uploads/" . $foto);
        }
    }

    $delete = mysqli_query($koneksi, "DELETE FROM products WHERE id='$id'");
    if ($delete) {
        header("location:?page=product");
        exit();
    }
}
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-header">
            Manage Product
        </h3>
    </div>
    <div class="card-body">
        <div class="mb-2 d-flex justify-content-end">
            <a href="?page=create-product" class="btn btn-primary">Create Product</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                $status = "Data Berhasil ditambah!";
                $location = "?page=product";
                echo statusSuccess($status, $location);
            }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rowProducts as $index => $v) {
                        ?>
                        <tr>
                            <td><?php echo $index + 1 ?></td>
                            <td><img src="assets/uploads/<?php echo $v['product_image'] ?>" alt="" width="150"></td>
                            <td><?php echo $v['product_name'] ?></td>
                            <td><?php echo $v['category_name'] ?></td>
                            <td><?php echo $v['qty'] ?></td>
                            <td>Rp. <?php echo number_format($v['price'], 2, ',', '.') ?></td>
                            <td><?php echo $v['unit'] ?></td>
                            <td><?php echo getStatus($v['is_active']) ?></td>
                            <td>
                                <a href="?page=create-product&edit=<?php echo $v['id'] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=product&delete=<?php echo $v['id'] ?>" method="post" class="d-inline">
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin hapus ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>