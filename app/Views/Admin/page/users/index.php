<?= $this->extend('Admin/Layouts/masterLayout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="dash-title">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin/dashboard" disabled="disabled">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quản lí tài khoản</li>
            </ol>
        </nav>
    </h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card easion-card">

                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-table"></i>
                    </div>
                    <div class="easion-card-title">Danh sách tài khoản</div>
                </div>
                <div class="card-body ">
                    <?php
                    if (session()->getFlashdata('status')) {
                        echo '<div class="alert alert-success" role = "alert">';
                        echo "<h4>" . session()->getFlashdata('status') . "</h4>";
                        echo "</div>";
                    } elseif (session()->getFlashdata('failed')) {
                        echo '<div class="alert alert-danger" role = "alert">';
                        echo "<h4>" . session()->getFlashdata('failed') . "</h4>";
                        echo "</div>";
                    }
                    ?>
                    <table class="w-100 table table-bordered">
                        <form method="get" action="admin/search" id="searchForm">
                            <input type='text' name='search' value='<?php $search; ?>' placeholder="Search here...">
                            <input type='button' id='btnsearch' value='Submit' onclick='document.getElementById("searchForm").submit();'>
                        </form>
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">User name</th>
                                <th scope="col">Full name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0 ?>
                            <?php foreach ($users as  $users) { ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $users['user_name'] ?></td>
                                    <td><?= $users['full_name'] ?></td>
                                    <td><?= $users['email'] ?></td>
                                    <?php if ($users['role'] == 1) : ?>
                                        <td>Administrator</td>
                                    <?php else : ?>
                                        <td>guest</td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/users/edit-user/' . $users['id']) ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url('admin/users/delete-user/' . $users['id']) ?>" class="btn btn-danger btn-del-confirm" onclick="return confirm('bạn chắc chắn muốn xoá ?')"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="pagination justify-content-center mb-4">
                        <?php if (!empty($pager)) :
                            //echo $pager->simpleLinks('group1', 'bs_simple');
                            echo $pager->links('group1', 'bs_full');
                        endif ?>

                        <!-- Bootstrap 4.5.2 code to show page 1 of 4 total pages using a button. -->
                        <div class="btn-group pagination justify-content-center mb-4" role="group" aria-label="pager counts">
                            &nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-light"><?= 'Page ' . $currentPage . ' of ' . $totalPages; ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection();
