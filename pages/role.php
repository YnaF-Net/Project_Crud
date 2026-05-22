<?php
$selectUser = mysqli_query($koneksi, "SELECT * FROM roles ORDER BY id DESC "); //5,4,3,2,1
$rows = mysqli_fetch_all($selectUser, MYSQLI_ASSOC);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'] ?? 0;
    $delete = mysqli_query($koneksi, "DELETE FROM roles WHERE id='$id'");
    header("location:?page=role");
}

?>

<div class="card">
    <h3 class="card-header fw-bold">
        Management Roles
    </h3>
    <div class="card-body">
        <div class="mb-2" align="right">
            <a href="?page=role-create" class="btn btn-primary">+ Create New User</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                $status = "Role Create Successfully!";
                $location = "?page=role";
                echo statusSuccess($status, $location);
            }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
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
                                <?php echo $r['name'] ?>
                            </td>
                            <td>
                                <?php echo $r['description'] ?>
                            </td>
                            <td>
                                <?php echo getStatus($r['is_active']) ?>
                            </td>
                            <!-- <td>
                                <?php echo ($r['is_active'] == 1) ? 'Active' : 'Non-Active'; ?>
                            </td> -->
                            <td>
                                <a href="?page=role-create&edit=<?= $r['id'] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=user&delete=<?= $r['id'] ?> ?>" method="post" class="d-inline">
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