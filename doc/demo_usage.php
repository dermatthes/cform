<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 02.10.15
 * Time: 13:32
 */

$form = new CForm(new CFormBootstrapRenderer());
$form->loadFromFile ("form.inc.php");

$form->setAction("index.php")->setMethod("POST")
    ->addInputText("name1")
        ->setId("name1")
        ->setValue("wurst")
        ->setPlaceholder("Name eingeben")
        ->setLABEL("wurst")
    ->addSelect("anrede1")
        ->setOptions([])
        ->setLABEL("Anrede bitte")
    ->addInputPassword("name");

$form->out();