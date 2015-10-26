<!doctype html>
<?php
/**
 * Created by PhpStorm.
 * User: alina
 * Date: 19.10.15
 * Time: 15:04
 */
require( '../autoload.php' );

$form = new CForm(new CFormBootstrapRenderer());
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//cdn.fuman.de/bootstrapcdn/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.fuman.de/bootstrapcdn/bootstrap/3.3.4/css/bootstrap-theme.min.css">

</head>
<body>
<form action="#" method="post">
    <h1>Example</h1><?php
    $form->addInput(["name" => "input", "id" => "1234", "type" => "text", "value" => "Insert Name"])
         ->setLabel("Name")->addDiscription("Dies ist ein Test")
         ->outPart();
    $form->addSelect(["@label" => "Age", "name" => "select", "id" => "abcd", "options" => ["young" => "21-35", "middle" => "36-55", "old" => "59-80"]])
         ->setValue("middle")
         ->addHTMLCode("<br /><br /><br /><h1>Code between...</h1>")
         ->addButton(["id" => "button", "name" => "btn", "type" => "submit"], "Display")
         ->outPart(["button"]) ?>
</form>
</body>
<script type="text/javascript">
    $('[data-toggle="popover"]').popover();
    (function () {
        var s = document.createElement("script");
        s.onload = function () {
            bootlint.showLintReportForCurrentDocument([]);
        };
        s.src = "https://maxcdn.bootstrapcdn.com/bootlint/latest/bootlint.min.js";
        document.body.appendChild(s)
    })();
</script>
</html>
