<!doctype html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <link rel="shortcut icon" href="admin/assets/images/favicon.ico" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tiều đề</title>
    <base href="<?=base_url();?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="admin/assets/css/easion.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
    
</head>

<body>
    <div class="dash">
        <?=$this->include('/Admin/Layouts/sidebar') ?>
        <div class="dash-app">
        <?=$this->include('/Admin/Layouts/header') ?>
            <main class="dash-content"> 
                <?=$this->renderSection('content')?>
            </main>
        </div>
    </div>
    
</body>
<?=$this->include('/Admin/Layouts/script') ?>

</html>