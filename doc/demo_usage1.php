<?php
/**
 * Created by PhpStorm.
 * User: alina
 * Date: 02.10.15
 * Time: 13:32
 */
require( '../autoload.php' );

$form = new CForm(new CFormBootstrapRenderer());
$form->loadFromFile("form.inc.php")->out();
