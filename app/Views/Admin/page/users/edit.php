<?= $this->extend('Admin/Layouts/masterLayout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <h1 class="dash-title">Trang chủ / Tài khoản / Thay đổi thông tin user</h1>
  <div class="row">
    <div class="col-xl-12">
      <div class="card easion-card">
                    <?php
                    if (session()->getFlashdata('status')) {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "<h4>" . session()->getFlashdata('status') . "</h4>";
                        echo "</div>";
                      }
                    ?>
                    
        <div class="card-header">
          <div class="easion-card-icon">
            <i class="fas fa-chart-bar"></i>
          </div>
          <div class="easion-card-title"> Thông tin tài khoản </div>
        </div>
        <div class="card-body ">
          <form action="<?= base_url('admin/users/edit-user/' . $users['id'])  ?>" method="post" novalidate>
            <?= csrf_field() ?>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmai">User name</label>
                <input name="user_name" type="text" class="form-control" value="<?= $users['user_name'] ?>" placeholder="User name" required>
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmai">Email</label>
                <input name="email" type="email" class="form-control" value="<?= $users['email'] ?>" id="inputEmai" placeholder="Email" required>
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">Quyền</label>
                <select name="role" id="inputState" class="form-control" required>
                  <option>---Chọn Quyền---</option>
                  <option value="1" <?= ($users['role'] == 1) ? 'selected="selected"' : '' ?>>ADMIN</option>
                  <option value="2" <?= ($users['role'] == 2) ? 'selected="selected"' : '' ?>>GUEST</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Tên hiển thị</label>
              <input name="full_name" type="text" class="form-control" value="<?= $users['full_name'] ?>" placeholder="Tên hiển thị người dùng" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="password">Mật khẩu</label>
                <input name="password" type="password" class="form-control" value="<?= $users['password'] ?>" placeholder="Nhập vào mật khẩu">
              </div>
              <div class="form-group col-md-6">
                <label for="password-confirm">Xác nhận mật khẩu</label>
                <input name="password_confirm" type="password" class="form-control" value="<?= $users['password'] ?>" placeholder="Xác nhận lại mật khẩu">
              </div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="admin/users/user-list" class="btn btn-danger">Back</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>