<?php

/**
 * Created by PhpStorm.
 * User: alina
 * Date: 05.10.15
 * Time: 09:30
 */
interface CFormRenderer {

    /**
     * @param $action
     * @param $method
     * @param array $items
     * @return mixed
     */
    public function render($action, $method, array $items);

    /**
     * @param array $items
     * @return mixed
     */
    public function render_standalone(array $items);

    /**
     * @return mixed
     */
    public function render_js();

}