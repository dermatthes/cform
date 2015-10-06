<?php

/**
 * Created by PhpStorm.
 * User: alina
 * Date: 05.10.15
 * Time: 09:29
 */
class CFormBootstrapRenderer implements CFormRenderer {

    private $mToClose = [];

    /**
     * @param $action
     * @param $method
     * @param array $items
     * @return string
     */
    public function render($action, $method, array $items) {
        $form = "<form class=\"form-horizontal\" action=\"{$action}\" method=\"{$method}\">\n";
        array_push($this->mToClose, "</form>\n");
        foreach ($items as $item) {
            $tag = $item->tag;
            $text = $item->displayValue;

            $label = "";
            if ($item->label != null) {
                $lab = $item->label;
                $label = "<label ";
                if (array_key_exists('id', $item->attributes)) {
                    $label .= "for=\"{$item->attributes['id']}\"";
                }
                $label .= "class=\"control-label col-md-3\">{$lab}</label>\n";
            }
            $sublabel = "";
            if ($item->sublabel != null) {
                $sublab = $item->sublabel;
                $sublabel = "<label ";
                if (array_key_exists('id', $item->attributes)) {
                    $sublabel .= "for=\"{$item->attributes['id']}\"";
                }
                $sublabel .= "class=\"control-label col-md-3\">{$sublab}</label>\n";
            }

            $options = "";
            if (count($opts = $item->options) != 0) {
                foreach ($opts as $key => $value) {
                    $options .= "<option value=\"{$key}\">{$value}</option>\n";
                }
            }

            $element = "<{$tag}";
            foreach ($item->attributes as $key => $value) {
                $element .= " {$key}=\"{$value}\"";
            }

            if ($tag == "button") {
                $container = "<div class=\"navbar\">\n";
                array_push($this->mToClose, "</div>\n");

                $elemcon = "<div class=\"navbar-form navbar-right\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= " class=\"btn btn-success pull-right\">";
                array_push($this->mToClose, "</{$tag}>\n");
            } elseif ($tag == "datalist") {
                $container = "<div class=\"form-group\">\n";
                array_push($this->mToClose, "</div>\n");

                $elemcon = "<div class=\"col-md-6\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= ">";
                array_push($this->mToClose, "</{$tag}>\n");
            } else {
                $container = "<div class=\"form-group\">\n";
                array_push($this->mToClose, "</div>\n");

                $elemcon = "<div class=\"col-md-6\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= " class=\"form-control\">";
                array_push($this->mToClose, "</{$tag}>\n");
            }

            $form .= $container . $label . $elemcon . $element . $options . $text . array_pop($this->mToClose) . array_pop($this->mToClose) . $sublabel . array_pop($this->mToClose);
        }
        return $form . array_pop($this->mToClose);
    }

}