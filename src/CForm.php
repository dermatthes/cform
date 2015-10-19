<?php

/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 02.10.15
 * Time: 14:34
 */

require( '../autoload.php' );

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

    public function addOption($value, $display) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $arr = $this->mCurElement->getOptions();
        $arr[$value] = $display;
        $this->mCurElement->setOptions($arr);
        return $this;
    }

    public function addHTMLCode($code) {
        $this->addItem("html", [], $code);
        return $this;
    }

    public function addOptionSelected($value, $display) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available");
        }
        $this->addOption($value, $display);
        $this->mCurElement->setSelected($value);
        return $this;
    }

    public function setLabel($value) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("@label", $value);
        return $this;
    }

    public function setSubLabel($value) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("@sublabel", $value);
        return $this;
    }

    public function setAttr($name, $val) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute($name, $val);
        return $this;
    }

    public function setId($id) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("id", $id);
        return $this;
    }

    public function setName($name) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("name", $name);
        return $this;
    }

    public function setType($type) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("type", $type);
        return $this;
    }

    public function setValue($value) {
        if ($this->mCurElement == null) {
            throw new Exception("No current element available.");
        }
        $this->mCurElement->setAttribute("value", $value);
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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootlint/latest/bootlint.min.js"></script>
</head>
<body>
<div class="container visible-lg-block">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = new CForm(new CFormBootstrapRenderer());
            $form->setAction("#")->setMethod("post")
                 ->addItem("datalist", ["id" => "datalist", "options" => ["name1" => "Nina", "name2" => "Klaus", "name3" => "Bernd", "name4" => "Lisa"]])
                 ->addSelect(["name" => "gender", "options" => ["m" => "Herr", "w" => "Frau"]])
                 ->addOptionSelected("mw", "Herr und Frau")->addOption("m", "Herren")
                 ->setLabel("Anrede")->addInput(["name" => "name", "@sublabel" => "Benutzername"])
                 ->setAttr("type", "text")->setLabel("Name")->setAttr("list", "datalist")
                 ->addInput(["type" => "password", "name" => "password"])->setLabel("Passwort")
                 ->addTextarea(["name" => "textarea"], "Eingabe")->setLabel("Textarea")
                 ->addButton(["type" => "submit", "name" => "button"], "Senden")
                 ->out(); ?>
        </div>
    </div>
</div>
</body>
</html>
