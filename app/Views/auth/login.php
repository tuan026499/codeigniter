<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/easion.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="assets/js/chart-js-config.js"></script>
    <title>Easion - Bootstrap Dashboard Template</title>
</head>

<body>
    <div class="form-screen">
        <a href="index.html" class="easion-logo"><i class="fas fa-sun"></i> <span>Easion</span></a>
        <div class="card account-dialog">
            <div class="card-header bg-primary text-white"> Please sign in </div>
            <div class="card-body">
                    <?php if(session()->getFlashdata('msg_failed')):?>
                        <div class="alert alert-danger">
                        <?= session()->getFlashdata('msg_failed') ?>
                        </div>
                    <?php elseif(session()->getFlashdata('msg_success')) :?>
                        <div class="alert alert-success">
                        <?= session()->getFlashdata('msg_success') ?>
                        </div>
                    <?php endif;?>
                <form action="<?= base_url()?>/admin/check" method="POST">
                <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_name"  placeholder="Enter your usename" value="<?= set_value('user_name') ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation,'user_name') : ''?></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password"  placeholder="Enter your password" value="<?= set_value('password') ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation,'password') : ''?></span>
                        
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                        </div>
                    </div>
                    <div class="account-dialog-actions">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                        <a class="account-dialog-link" href="<?=base_url()?>/admin/register">Create a new account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/easion.js"></script>
</body>

</html>