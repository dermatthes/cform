<?php

/**
 * Created by PhpStorm.
 * User: alina
 * Date: 02.10.15
 * Time: 14:34
 */

class CForm {

    /**
     * @var CFormRenderer
     */
    protected $mRenderer;

    /**
     * @var string
     */
    protected $mAction;

    /**
     * @var  string
     */
    protected $mMethod;

    /**
     * @var array
     */
    protected $mItems;

    /**
     * @var CFormElement
     */
    protected $mCurElement;


    /**
     * @param CFormRenderer $renderer
     */
    public function __construct(CFormRenderer $renderer) {
        $this->mRenderer = $renderer;
    }


    /**
     * @param $action
     * @return $this
     */
    public function setAction($action) {
        $this->mAction = $action;
        return $this;
    }

    /**
     * @param $method
     * @return $this
     * @throws \Exception
     */
    public function setMethod($method) {
        $method = strtoupper($method);
        if ($method == "POST" || $method == "GET") {
            $this->mMethod = $method;
        } else {
            throw new \Exception ("Invalid method committed");
        }
        return $this;
    }

    /**
     * @param $file
     * @return $this
     */
    public function loadFromFile($file) {
        $arr = require $file;
        foreach ($arr as $item) {
            $tag = $item[0];
            unset( $item[0] );
            $this->mItems[] = new CFormElement($tag, $item);
        }
        return $this;
    }

    /**
     * @param $tag
     * @param array $vals
     * @param null $displayVal
     * @return $this
     */
    public function addItem($tag, array $vals = null, $displayVal = null) {
        $this->mCurElement = new CFormElement($tag, $vals, $displayVal);
        $this->mItems[] = $this->mCurElement;
        return $this;
    }

    /**
     * @param array|null $vals
     * @return $this
     */
    public function addInput(array $vals = null) {
        $this->addItem("input", $vals);
        return $this;
    }

    /**
     * @param array|null $vals
     * @return $this
     */
    public function addSelect(array $vals = null) {
        $this->addItem("select", $vals);
        return $this;
    }

    /**
     * @param array|null $vals
     * @param null $displayVal
     * @return $this
     */
    public function addTextarea(array $vals = null, $displayVal = null) {
        $this->addItem("textarea", $vals, $displayVal);
        return $this;
    }

    /**
     * @param array|null $vals
     * @param null $displayVal
     * @return $this
     */
    public function addButton(array $vals = null, $displayVal = null) {
        $this->addItem("button", $vals, $displayVal);
        return $this;
    }

    /**
     * @param array|null $vals
     * @param null $displayVal
     * @return $this
     */
    public function addOutput(array $vals = null, $displayVal = null) {
        $this->addItem("output", $vals, $displayVal);
        return $this;
    }

    /**
     * @param $value
     * @param $display
     * @return $this
     * @throws Exception
     */
    public function addOption($value, $display) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $arr = $this->mCurElement->getOptions();
        $arr[$value] = $display;
        $this->mCurElement->setOptions($arr);
        return $this;
    }

    /**
     * Adds option which is triaged
     *
     * @param $value
     * @param $display
     * @return $this
     * @throws Exception
     */
    public function addOptionSelected($value, $display) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available");
        }
        $this->addOption($value, $display);
        $this->mCurElement->setSelected($value);
        return $this;
    }

    /**
     * Inserts HTML code between form-elements
     *
     * @param $code
     * @return $this
     */
    public function addHTMLCode($code) {
        $this->addItem("html", [], $code);
        return $this;
    }

    /**
     * Adds a label-element in front of HTML element
     *
     * @param $value
     * @return $this
     * @throws Exception
     */
    public function setLabel($value) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("@label", $value);
        return $this;
    }

    /**
     * Adds a label-element behind the HTML element
     *
     * @param $value
     * @return $this
     * @throws Exception
     */
    public function setSubLabel($value) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("@sublabel", $value);
        return $this;
    }

    /**
     * Adds an attribute to the HTML element
     *
     * @param $name
     * @param $val
     * @return $this
     * @throws Exception
     */
    public function setAttr($name, $val) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute($name, $val);
        return $this;
    }

    /**
     * @param $id
     * @return $this
     * @throws Exception
     */
    public function setId($id) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("id", $id);
        return $this;
    }

    /**
     * @param $name
     * @return $this
     * @throws Exception
     */
    public function setName($name) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("name", $name);
        return $this;
    }

    /**
     * @param $type
     * @return $this
     * @throws Exception
     */
    public function setType($type) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("type", $type);
        return $this;
    }

    /**
     * @param $value
     * @return $this
     * @throws Exception
     */
    public function setValue($value) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("value", $value);
        return $this;
    }

    /**
     * Resets the list of form elements
     */
    private function reset() {
        $this->mCurElement = null;
        $this->mItems = [];
    }

    /**
     * Prints form
     */
    public function out() {
        echo $this->mRenderer->render($this->mAction, $this->mMethod, $this->mItems);
        $this->reset();
    }

    /**
     * Prints all form elements in List without surrounding <form> tags
     */
    public function outPart() {
        echo $this->mRenderer->render_standalone($this->mItems);
        $this->reset();
    }

}
