<?php

/**
 * Created by PhpStorm.
 * User: alina
 * Date: 26.10.15
 * Time: 10:22
 */
namespace cform;

class CFormSimpleRenderer implements CFormRenderer {

    private $mToClose = [];

    /**
     * @param $action
     * @param $method
     * @param array $items
     * @return mixed
     */
    public function render($action, $method, array $items) {
        $form = "<form action=\"{$action}\" method=\"{$method}\">\n";
        array_push($this->mToClose, "</form>\n");
        return $form . $this->render_standalone($items) . array_pop($this->mToClose);
    }

    /**
     * @param array $items
     * @return mixed
     */
    public function render_standalone(array $items) {
        $form = '';
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
                $label .= " class=\"label\">{$lab}</label>\n";
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
                $infobtn = "<a tabindex='0' role=\"button\" class=\"infobutton\" data-trigger='focus' data-html=\"true\" data-toggle=\"popover\" data-container=\"body\" data-content=\"{$item->discription}\"><span class=\"\"></span></a>";
            }

            $element = "<{$tag}";
            foreach ($item->attributes as $key => $value) {
                $element .= " {$key}=\"{$value}\"";
            }

            if ($tag == "button") {
                $container = "<div class=\"container\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= " class=\"btn\">";
                array_push($this->mToClose, "</{$tag}>\n");
            } elseif ($tag == "datalist") {
                $container = "<div class=\"container\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= ">";
                array_push($this->mToClose, "</{$tag}>\n");
            } elseif ($tag == "input") {
                $container = "<div class=\"container\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= " class=\"formElement\">";
                array_push($this->mToClose, "");
            } else {
                $container = "<div class=\"container\">\n";
                array_push($this->mToClose, "</div>\n");

                $element .= " class=\"formElement\">";
                array_push($this->mToClose, "</{$tag}>\n");
            }
            $form .= $container . $label . $element . $options . $text . array_pop($this->mToClose) . $infobtn . array_pop($this->mToClose);
        }
        return $form;
    }

    /**
     * @return mixed
     */
    public function render_js() {
        $ret = "<script type=\"text/javascript\">$('[data-toggle=\"popover\"]').popover();</script>";
        return $ret;
    }
}