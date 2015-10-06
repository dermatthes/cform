<?php

/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 02.10.15
 * Time: 14:34
 */
class CFormElement {

    private $tag;
    private $displayValue;
    private $attributes = [];
    private $label;
    private $sublabel;
    private $options = [];


    /**
     * @param $tag
     * @param array $items
     * @param null $displayVal
     */
    public function __construct($tag, array $items, $displayVal = null) {
        $this->tag = $tag;
        $this->displayValue = $displayVal;
        foreach ($items as $key => $value) {
            if (substr($key, 0, 1) == "@") {
                $key = strtolower(substr($key, 1, strlen($key)));
                if ($key == "label") {
                    $this->label = $value;
                } elseif ($key == "sublabel") {
                    $this->sublabel = $value;
                }
                continue;
            } elseif ($key == "options" || is_array($value)) {
                foreach ($value as $_key => $_value) {
                    $this->options[$_key] = $_value;
                }
                continue;
            }
            $this->attributes[$key] = $value;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name) {
        return $this->$name;
    }

}
