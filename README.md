# CFORM: HTML Form printing

Printing HTML Forms in various stylesets.

## Programmatisches Beispiel

```
$form = new CForm(new CFormBootstrapRenderer());

$form->setAction("#")->setMethod("post")
     ->addInput()
          ->setLabel("Name")
          ->setName("input")
          ->setId("1234")
          ->setType("text")
          ->setValue("Insert Name")
     ->addSelect()
          ->setLabel("Age")
          ->setName("select")
          ->setId("abcd")
          ->addOption("young","21-35")
          ->addOptionSelected("middle","36-55")
          ->addOption("old","59-80")
     ->addButton([],"Display")
          ->setName("btn")
          ->setType("submit")
->out();
```

## Beispiel: Laden aus Datei

```
$form = new CForm(new CFormBootstrapRenderer());
$form->loadFromFile("form.inc.php")->out();
```

### Beispieldatei 'form.inc.php'
```
return [
        ["input", "type" => "text", "id" => "1234", "@label" => "Name", "value" => "Insert Name"],

        ["select", "id" => "abcd", "@label" => "Age", "value" => "middle", "options" => [
                "young" => "21-35",
                "middle" => "36-55",
                "old" => "56-80"]
        ],

        ["button", "name" => "btn", "type" => "submit", "displayValue" => "Display"]
];
```

## Beispiel: Formular mit Teilausgaben

```
<form action="#" method="post">
<?php
    $form = new CForm(new CFormSimpleRenderer());
    $form->addInput(["name" => "input", "id" => "1234", "type" => "text", "value" => "Insert Name"])
         ->setLabel("Name")->addDiscription("Dies ist ein Test")
         ->outPart();
    $form->addSelect(["@label" => "Age", "name" => "select", "id" => "abcd", "options" => ["young" => "21-35", "middle" => "36-55", "old" => "59-80"]])
         ->setValue("middle")
         ->addHTMLCode("<br /><br /><br /><h1>Code between...</h1>")
         ->addButton(["id" => "button", "name" => "btn", "type" => "submit"], "Display")
         ->outPart(["button"]) ?>
</form>
```
Die Methode 'outPart()' gibt alle erstellten Form-Elemente ohne die umgebenden Form-Tags aus, diese müssen manuell 
geschrieben werden. Anschließend wird die Liste der erstellten Elemente zurückgesetzt.

## Available Renderers

| Framework   | ClassName                | Example Output |
|-------------|--------------------------|----------------|
| Bootstrap   | `CFormBootstrapRenderer` |                |
| Plain Table | `CFormTableRenderer`     |                |
|             |                          |                |

## Weitere Ausgabe-Methoden

Die Methode 'outJavaScript()' sollte am Ende des Dokuments aufgerufen werden. Sie gibt den im Renderer definierten
JavaScript-Code aus, der unter anderem notwendig ist, damit die Info-Buttons zum Anzeigen der Beschreibung eines Feldes
funktionieren.
```
"<script type=\"text/javascript\">$('[data-toggle=\"popover\"]').popover();</script>"
```
Die Methode 'outButtons()' gibt nur die Buttons aus, die bis zu dem Zeitpunkt des Aufrufs der Methode zu dem Formular 
hinzugefügt wurden.
