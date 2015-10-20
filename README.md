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


## Available Renderers

| Framework   | ClassName                | Example Output |
|-------------|--------------------------|----------------|
| Bootstrap   | `CFormBootstrapRenderer` |                |
| Plain Table | `CFormTableRenderer`     |                |
|             |                          |                |
