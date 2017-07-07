<!DOCTYPE html>
<html>
    <head>
        <title>MailPanel</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="assets/css/chosen.min.css"/>
        <link rel="stylesheet" href="assets/css/style.css"/>
        <?php
        include_once 'admin-setup/setup.php';
        include_once 'database.php';
        ?>
    </head>
    <body>
        <div class="vertical-space"></div>
        <div class="row">
            <div class="container">
                <div class="panel panel-info">
                    <div class="panel-heading"><b>Mail Panel</b></div><!--.panel-heading-->
                    <div class="panel-body">
                        <h3>To:</h3>
                        <p>info@asabagh.ir</p>
                        <h3>From:</h3>
                        <p>a.sabagh72@gmail.com</p>
                        <h3>Cc</h3>
                        <p>rangraz54@gmail.com , rangraz_user@yahoo.com , aligh@gmail.com</p>
                        <h3>Bcc:</h3>
                        <p>ashoori_mahdi@gmail.com</p>
                        <h3>Subject:</h3>
                        <p>new project on github</p>
                        <h3>Body:</h3>
                        <p>lorem ipsume dolor script on github and quick install with simple admin panel create with bootstrap</p>
                        <a href="index.php" class="btn btn-info btn-block" >Back To Home</a>
                    </div><!--.panel-body-->
                </div><!--.panel-body-->
            </div><!--.container-->
        </div><!--.row-->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/chosen.jquery.min.js"></script>
        <script src="assets/js/tinymce.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>

