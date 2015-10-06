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
    public function addItem($tag, array $vals, $displayVal = null) {
        $this->mItems[] = new CFormElement($tag, $vals, $displayVal);
        return $this;
    }

    public function addInput(array $vals) {
        $this->addItem("input", $vals);
        return $this;
    }

    public function addSelect(array $vals) {
        $this->addItem("select", $vals);
        return $this;
    }

    public function addTextarea(array $vals, $displayVal = null) {
        $this->addItem("textarea", $vals, $displayVal);
        return $this;
    }

    public function addButton(array $vals, $displayVal = null) {
        $this->addItem("button", $vals, $displayVal);
        return $this;
    }

    public function addOutput(array $vals, $displayVal = null) {
        $this->addItem("output", $vals, $displayVal);
        return $this;
    }

    public function out() {
        echo $this->mRenderer->render($this->mAction, $this->mMethod, $this->mItems);
    }
} ?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="row">
    <div class="col-lg-8">
        <?php $cform = new CForm(new CFormBootstrapRenderer());
        $cform->setAction("#")->setMethod("get")->loadFromFile("../doc/form.inc.php")
              ->addButton(["type" => "submit"], "Senden")
              ->addSelect(["@label" => "Noch ein Select", "id" => "123", "options" => ["1" => "Wahl 1", "2" => "Wahl 2", "3" => "Wahl 3"]])
              ->addTextarea(["id" => "textarea", "rows" => "4", "cols" => "2", "@label" => "Textbereich"])
              ->addOutput(["name" => "x", "for" => "cb 1234", "@label" => "Output"])
              ->addInput(["type" => "radio", "id" => "rad", "value" => "Radiobutton", "@label" => "Radio"])
              ->addItem("keygen", ["name" => "security", "@label" => "Keygen"])
              ->addItem("datalist", ["id" => "datalist", "options" => ["val1" => "Name 1", "val2" => "Name 2"]])
              ->addInput(["type" => "checkbox", "id" => "cb", "@label" => "Checken"]);
        $cform->out(); ?>
    </div>
</div>
</body>
</html>