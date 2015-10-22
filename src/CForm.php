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


    public function addDiscription($text) {
        $this->mCurElement->setDiscription(htmlspecialchars($text));
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
     * @param array $opts
     * @return $this
     * @throws Exception
     */
    public function addOptions(array $opts) {
        foreach ($opts as $k => $v) {
            $this->addOption($k, $v);
        }
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
        $this->setAttr("id", $id);
        return $this;
    }

    /**
     * @param $name
     * @return $this
     * @throws Exception
     */
    public function setName($name) {
        $this->setAttr("name", $name);
        return $this;
    }

    /**
     * @param $type
     * @return $this
     * @throws Exception
     */
    public function setType($type) {
        $this->setAttr("type", $type);
        return $this;
    }

    /**
     * @param $value
     * @return $this
     * @throws Exception
     */
    public function setValue($value) {
        $this->setAttr("value", $value);
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
     * Prints all form elements in list without surrounding <form> tags
     * Resets all elements in list
     */
    public function outPart() {
        echo $this->mRenderer->render_standalone($this->mItems);
        $this->reset();
    }

}
