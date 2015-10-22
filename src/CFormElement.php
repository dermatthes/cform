<?php

/**
 * Created by PhpStorm.
 * User: alina
 * Date: 02.10.15
 * Time: 14:34
 */
class CFormElement {

    private $tag;
    private $displayValue;
    private $attributes = [];
    private $label;
    private $discription;
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
     * @return mixed
     */
    public function getDiscription() {
        return $this->discription;
    }

    /**
     * @param mixed $discription
     */
    public function setDiscription($discription) {
        $this->discription = $discription;
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
    public function setAttributes(array $attributes) {
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
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options) {
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
        if (!is_array($val)) {
            $val = htmlspecialchars($val);
        }
        if (substr($key, 0, 1) == "@") {
            $key = substr($key, 1, strlen($key));
            if ($key == "label") {
                $this->label = $val;
            }
        } elseif ($key == "options" || is_array($val)) {
            foreach ($val as $_key => $_value) {
                $this->options[$_key] = $_value;
            }
        } elseif ($key == "displayvalue") {
            $this->displayValue = $val;
        } else {
            if ($key == "value") {
                $this->selected = $val;
            }
            $this->attributes[$key] = $val;
        }
    }

    /**
     * @param $tag
     * @param array $items
     * @param null $displayVal
     */
    public function __construct($tag, array $items = null, $displayVal = null) {
        $this->tag = $tag;
        if ($tag != "html") {
            $this->displayValue = htmlspecialchars($displayVal);
        }
        if ($items != null) {
            foreach ($items as $key => $value) {
                $this->setAttribute($key, $value);
            }
        }
    }

}
