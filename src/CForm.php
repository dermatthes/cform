<?php

/**
 * Created by PhpStorm.
 * User: matthes
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

    public function addInput(array $vals = null) {
        $this->addItem("input", $vals);
        return $this;
    }

    public function addSelect(array $vals = null) {
        $this->addItem("select", $vals);
        return $this;
    }

    public function addTextarea(array $vals = null, $displayVal = null) {
        $this->addItem("textarea", $vals, $displayVal);
        return $this;
    }

    public function addButton(array $vals = null, $displayVal = null) {
        $this->addItem("button", $vals, $displayVal);
        return $this;
    }

    public function addOutput(array $vals = null, $displayVal = null) {
        $this->addItem("output", $vals, $displayVal);
        return $this;
    }

    public function addHTMLCode($code) {
        $this->addItem("html", [], $code);
        return $this;
    }

    public function setAttr($name, $val) {
        if ($this->mCurElement == null) {
            throw new Exception("No element to add attribute to.");
        }
        $this->mCurElement->setAttribute($name, $val);
        return $this;
    }

    public function reset() {
        $this->mCurElement = null;
        $this->mItems = [];
    }

    public function out() {
        echo $this->mRenderer->render($this->mAction, $this->mMethod, $this->mItems);
    }

    public function outPart() {
        echo $this->mRenderer->render_standalone($this->mItems);
        $this->reset();
    }

} ?>

<html>
<head>

</head>
<body>

</body>
</html>
