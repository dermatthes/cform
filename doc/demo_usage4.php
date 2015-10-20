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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<form action="#" method="post">
    <h1>Example</h1><?php
    $form->addInput(["name" => "input", "id" => "1234", "type" => "text", "value" => "Insert Name"])
            ->setLabel("Name")
         ->outPart();
    $form->addSelect(["@label" => "Age", "name" => "select", "id" => "abcd", "options" => ["young" => "21-35", "middle" => "36-55", "old" => "59-80"]])
            ->setValue("middle")
         ->addHTMLCode("<br /><br /><br /><h1>Code between...</h1>")
         ->addButton(["name" => "btn", "type" => "submit"], "Display")
         ->outPart() ?>
</form>
</body>
</html>
