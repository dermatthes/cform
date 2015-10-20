<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 02.10.15
 * Time: 13:33
 */

return [
        ["input", "type" => "text", "id" => "1234", "@label" => "Name", "placeholder" => "Insert Name"],

        ["select", "id" => "abcd", "@label" => "Age", "selected" => "middle", "options" => [
                "young" => "21-35",
                "middle" => "36-55",
                "old" => "56-80"]
        ],

        ["button", "name" => "btn", "type" => "submit", "displayValue" => "Display"]
];