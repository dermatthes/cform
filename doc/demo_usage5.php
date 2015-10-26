<!doctype html>
<?php
/**
 * Created by PhpStorm.
 * User: alina
 * Date: 26.10.15
 * Time: 11:36
 */
require( '../autoload.php' ); ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head> <?php

$form = new CForm(new CFormSimpleRenderer());
$form->setAction("#")->setMethod("get");

$form->addItem("input", ["@label" => "Name", "name" => "input", "id" => "1234", "type" => "text", "value" => "Insert Name"])
     ->addItem("select", ["@label" => "Age", "name" => "select", "id" => "abcd", "options" => ["young" => "21-35", "middle" => "36-55", "old" => "59-80"]])
     ->setAttr("value", "middle")
     ->addItem("button", ["name" => "btn", "type" => "submit"], "Display")
     ->out(); ?>

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