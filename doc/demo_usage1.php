<?php
require( '../autoload.php' );
?>
<html>
<head>
    <title>Rabatz</title>
    <link rel="stylesheet" href="//cdn.fuman.de/bootstrapcdn/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.fuman.de/bootstrapcdn/bootstrap/3.3.4/css/bootstrap-theme.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <p>
                        VollBrandEy
                    </p>
                </a>
            </div>
        </div>
    </nav>

    <div class="panel panel-default">
        <div class="panel-heading">My Title</div>
        <div class="panel-body">
            <?php
            $form = new CForm(new CFormBootstrapRenderer());
            $form->loadFromFile("form.inc.php")->out();
            ?>
        </div>
    </div>
</div>

</body>
</html>