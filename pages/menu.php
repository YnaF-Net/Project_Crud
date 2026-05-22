<?php
$query = mysqli_query($koneksi, "SELECT parent.name AS parent_name, menus.* FROM menus LEFT JOIN menus AS parent ON parent.id = menus.parent_id ORDER BY menus.id DESC"); //5,4,3,2,1
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'] ?? 0;
    $delete = mysqli_query($koneksi, "DELETE FROM menus WHERE id='$id'");
    header("location:?page=menu");
}

?>

<div class="card">
    <h3 class="card-header fw-bold">
        Management Menu
    </h3>
    <div class="card-body">
        <div class="mb-2" align="right">
            <a href="?page=menu-create" class="btn btn-primary">+ Create New Menu</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                $status = "menu Create Successfully!";
                $location = "?page=menu";
                echo statusSuccess($status, $location);
            }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Parent</th>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Icon</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $index => $r) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $index + 1 ?>
                            </td>
                            <td>
                                <?php echo $r['parent_name'] ?>
                            </td>
                            <td>
                                <?php echo $r['name'] ?>
                            </td>
                            <td>
                                <?php echo $r['url'] ?>
                            </td>
                            <td>
                                <?php echo $r['icon'] ?>
                            </td>
                            <td>
                                <?php echo $r['sort_order'] ?>
                            </td>
                            <td>
                                <?php echo getStatus($r['is_active']) ?>
                            </td>
                            <td>
                                <a href="?page=menu-create&edit=<?= $r['id'] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=menu&delete=<?= $r['id'] ?> ?>" method="post" class="d-inline">
                                    <button class="btn btn-danger"
                                        onclick="return confirm('YAKIN LU MBUD?')">Delete</button>
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