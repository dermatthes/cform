<?php
/**
 * Created by PhpStorm.
 * User: alina
 * Date: 19.10.15
 * Time: 14:50
 */
require ('../autoload.php');

$form = new CForm(new CFormBootstrapRenderer());
$form->setAction("#")->setMethod("get");

$form->addItem("input", ["@label" => "Name", "name" => "input", "id" => "1234", "type" => "text", "value" => "Insert Name"])
     ->addItem("select", ["@label" => "Age", "name" => "select", "id" => "abcd", "options" => ["young" => "21-35", "middle" => "36-55", "old" => "59-80"]])
          ->setAttr("value", "middle")
     ->addItem("button", ["name" => "btn", "type" => "submit"], "Display")
->out();