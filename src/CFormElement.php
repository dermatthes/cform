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
    private $selected;

    /**
     * @return mixed
     */
    public function getSelected() {
        return $this->selected;
    }

    /**
     * @param mixed $selected
     */
    public function setSelected($selected) {
        $this->selected = $selected;
    }

    /**
     * @return mixed
     */
    public function getTag() {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag) {
        $this->tag = $tag;
    }

    /**
     * @return null
     */
    public function getDisplayValue() {
        return $this->displayValue;
    }

    /**
     * @param null $displayValue
     */
    public function setDisplayValue($displayValue) {
        $this->displayValue = $displayValue;
    }

    /**
     * @return array
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes($attributes) {
        $this->attributes = $attributes;
    }

    /**
     * @return mixed
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getSublabel() {
        return $this->sublabel;
    }

    /**
     * @param mixed $sublabel
     */
    public function setSublabel($sublabel) {
        $this->sublabel = $sublabel;
    }

    /**
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options) {
        $this->options = $options;
    }

    public function __get($name) {
        return $this->$name;
    }

    /**
     * @param $key
     * @param $val
     */
    public function setAttribute($key, $val) {
        $key = strtolower($key);
        if (substr($key, 0, 1) == "@") {
            $key = substr($key, 1, strlen($key));
            if ($key == "label") {
                $this->label = $val;
            } elseif ($key == "sublabel") {
                $this->sublabel = $val;
            }
        } elseif ($key == "options" || is_array($val)) {
            foreach ($val as $_key => $_value) {
                $this->options[$_key] = $_value;
            }
        } elseif ($key == "selected") {
            $this->selected = $val;
        } else {
            $this->attributes[$key] = $val;
        }
    }

    /**
     * @param $tag
     * @param array $items
     * @param null $displayVal
     */
    public function __construct($tag, array $items, $displayVal) {
        $this->tag = $tag;
        $this->displayValue = $displayVal;
        if ($items != null) {
            foreach ($items as $key => $value) {
                $this->setAttribute($key, $value);
            }
        }
    }

}
