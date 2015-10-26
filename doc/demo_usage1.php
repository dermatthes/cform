<!doctype html>
<?php
require( '../autoload.php' );
?>
<html>
<head>
    <title>Rabatz</title>
    <script language="JavaScript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <link rel="stylesheet" href="//cdn.fuman.de/bootstrapcdn/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.fuman.de/bootstrapcdn/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

<script language="JavaScript">

    (function () {
        var s = document.createElement("script");
        s.onload = function () {
            bootlint.showLintReportForCurrentDocument([]);
        };
        s.src = "https://maxcdn.bootstrapcdn.com/bootlint/latest/bootlint.min.js";
        document.body.appendChild(s)
    })();
</script>
</body>
</html>