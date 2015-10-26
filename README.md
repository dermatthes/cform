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

## Beispiel Laden aus Datei

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


## Available Renderers

| Framework   | ClassName                | Example Output |
|-------------|--------------------------|----------------|
| Bootstrap   | `CFormBootstrapRenderer` |                |
| Plain Table | `CFormTableRenderer`     |                |
|             |                          |                |
