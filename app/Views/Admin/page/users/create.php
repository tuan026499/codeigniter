<?= $this->extend('Admin/Layouts/masterLayout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="dash-title">Trang chủ / Tài khoản / Thêm mới</h1>
    <div class="row">
        <div class="col-xl-12">
            <div class="card easion-card">
                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="easion-card-title"> Thông tin tài khoản </div>
                </div>
                <div class="card-body ">
                    <form action="<?=base_url()?>/admin/users/save-user" method="post" >
                        <?= csrf_field() ?>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmai">User name</label>
                                <input name="user_name" type="text" class="form-control"  placeholder="User name" value="<?= set_value('user_name') ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation,'user_name') : ''?></span>

                               
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmai">Email</label>
                                <input name="email" type="email" class="form-control"  placeholder="Email" value="<?= set_value('email') ?>" >
                                <span class="text-danger"><?= isset($validation) ? display_error($validation,'email') : ''?></span>
                               
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Quyền</label>
                                <select name="role" id="inputState" class="form-control"  >
                                    <option>---Chọn Quyền---</option>
                                    <option value="1">ADMIN</option>
                                    <option value="2">GUEST</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Tên hiển thị</label>
                            <input name="full_name" type="text" class="form-control"  placeholder="Tên hiển thị người dùng" value="<?= set_value('full_name') ?>" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation,'full_name') : ''?></span>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Mật khẩu</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Nhập vào mật khẩu" value="<?= set_value('password') ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation,'password') : ''?></span>
                               
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password-confirm">Xác nhận mật khẩu</label>
                                <input name="cpassword" type="password" class="form-control" id="password-confirm" placeholder="Xác nhận lại mật khẩu" value="<?= set_value('cpassword') ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation,'cpassword') : ''?></span>
                               
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Đăng ký</button>
                        <button type="reset" class="btn btn-secondary">Nhập lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>