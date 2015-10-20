<?php
/**
 * Created by PhpStorm.
 * User: alina
 * Date: 19.10.15
 * Time: 13:51
 */
require( '../autoload.php' );

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
          ->addOption("young","21-35")
          ->addOption("middle","36-55")
          ->addOption("old","59-80")
          ->setValue("middle")
     ->addButton([],"Display")
          ->setName("btn")
          ->setType("submit")
->out();