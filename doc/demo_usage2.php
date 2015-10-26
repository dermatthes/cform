<!doctype html><?php
/**
 * Created by PhpStorm.
 * User: alina
 * Date: 19.10.15
 * Time: 13:51
 */
require( '../autoload.php' );
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//cdn.fuman.de/bootstrapcdn/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.fuman.de/bootstrapcdn/bootstrap/3.3.4/css/bootstrap-theme.min.css">

</head><?php

$form = new CForm(new CFormBootstrapRenderer());

$form->setAction("#")->setMethod("post")
     ->addInput()
     ->setLabel("Name")
     ->setName("input")
     ->setId("1234")
     ->setType("text")
     ->setValue("Insert Name")
     ->addSelect()
     ->setLabel("Age")
     ->setName("select")
     ->setId("abcd")
     ->addOption("young", "21-35")
     ->addOption("middle", "36-55")
     ->addOption("old", "59-80")
     ->setValue("middle")
     ->addButton([], "Display")
     ->setName("btn")
     ->setType("submit")
     ->out();
?>
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