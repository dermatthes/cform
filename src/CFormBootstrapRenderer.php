<?php

/**
 * Created by PhpStorm.
 * User: alina
 * Date: 05.10.15
 * Time: 09:29
 */
namespace cform;

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
        return $form . $this->render_standalone($items) . array_pop($this->mToClose);
    }

    /**
     * @return string
     */
    public function render_js() {
        $ret = "<script type=\"text/javascript\">$('[data-toggle=\"popover\"]').popover();</script>";
        return $ret;
    }

    /**
     * @param array $items
     * @return string
     */
    public function render_standalone(array $items) {
        $form = "";
        foreach ($items as $item) {
            $tag = strtolower($item->tag);
            $text = $item->displayValue;

            if ($tag == "html") {
                $form .= $text;
                continue;
            }

            $label = "";
            if ($item->label != null) {
                $lab = $item->label;
                $label = "<label ";
                if (array_key_exists('id', $item->attributes)) {
                    $label .= "for=\"{$item->attributes['id']}\"";
                }
                $label .= " class=\"control-label col-md-3\">{$lab}</label>\n";
            }

            $options = "";
            if (count($opts = $item->options) != 0) {
                foreach ($opts as $key => $value) {
                    if ($item->selected == $key) {
                        $options .= "<option value=\"{$key}\" selected=\"selected\">{$value}</option>\n";
                    } else {
                        $options .= "<option value=\"{$key}\">{$value}</option>\n";
                    }
                }
            }

            $infobtn = "";
            if ($item->discription != null) {
                $infobtn = "<a tabindex='0' role=\"button\" class=\"btn btn-default\" data-trigger='focus' data-html=\"true\" data-toggle=\"popover\" data-container=\"body\" data-content=\"{$item->discription}\"><span class=\"glyphicon glyphicon-info-sign\"></span></a>";
            }

            $element = "<{$tag}";
            foreach ($item->attributes as $key => $value) {
                $element .= " {$key}=\"{$value}\"";
            }

            if ($tag == "button") {
                $container = "<div class=\"navbar\">\n<div class=\"container-fluid\">\n";
                array_push($this->mToClose, "</div>\n</div>\n");

                $elemcon = "<div class=\"navbar-form navbar-right\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= " class=\"btn btn-success pull-right\">";
                array_push($this->mToClose, "</{$tag}>\n");
            } elseif ($tag == "datalist") {
                $container = "<div class=\"form-group\">\n";
                array_push($this->mToClose, "</div>\n");

                $elemcon = "<div class=\"col-md-8\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= ">";
                array_push($this->mToClose, "</{$tag}>\n");
            } elseif ($tag == "input") {
                $container = "<div class=\"form-group\">\n";
                array_push($this->mToClose, "</div>\n");

                $elemcon = "<div class=\"col-md-8\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= " class=\"form-control\">";
                array_push($this->mToClose, "");
            } else {
                $container = "<div class=\"form-group\">\n";
                array_push($this->mToClose, "</div>\n");

                $elemcon = "<div class=\"col-md-8\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= " class=\"form-control\">";
                array_push($this->mToClose, "</{$tag}>\n");
            }

            $form .= $container . $label . $elemcon . $element . $options . $text . array_pop($this->mToClose) . array_pop($this->mToClose) . $infobtn . array_pop($this->mToClose);
        }
        return $form;
    }
}
