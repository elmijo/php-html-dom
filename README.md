# PHP HTML DOM
[![Build Status](https://travis-ci.org/ElMijo/php-html-dom.svg?branch=master)](https://travis-ci.org/ElMijo/php-html-dom) [![Coverage Status](https://coveralls.io/repos/ElMijo/php-html-dom/badge.svg?branch=master)](https://coveralls.io/r/ElMijo/php-html-dom?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ElMijo/php-html-dom/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ElMijo/php-html-dom/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/ElMijo/php-html-dom/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ElMijo/php-html-dom/?branch=master)

Esta Es una Herramienta que permite convertir y manipular una cadena de texto con formato html en un objeto php.

## Instalación

Lo podemos hacer a travéz de [composer](https://getcomposer.org/doc/00-intro.md):
```json
    "require": {
        ...
        "elmijo/php-html-dom": "1.0"
        ...
    }
```
## Como usar la Herramienta

### Inicializar el objeto
```php
$dom = new \PHPTools\PHPHtmlDom\PHPHtmlDom;
```
### Importar HTML desde una url
```php
$dom->importHTML('http://php.net/');
```
### Importar HTML desde un archivo
```php
$dom->importHTML('/ruta/del/archivo.txt');
```
### Importar HTML desde un texto
```php
$dom->importHTML('<div id="content-1"><ul><li class="item">item 1</li><li class="item">item 2</li></ul></div>');
```
### Comprobar que si se importo el HTML
```php
if(!!$dom->importHTML('http://php.net/'))
{
    ...
    //Si se logra importar el contenido devuelve TRUE
    ...
}
```
### El metodo e
Este metodo permite instanciar uno o mas elementos dentro del contenido HTML importado, para instanciar dicho objeto solo tenemos que pasar un selector css.
```php
$domlist = $dom->e('article');
//o
$domlist = $dom->e('.clase-de-los-elementos');
//o
$domlist = $dom->e('#id-del-elemento');
//o
$domlist = $dom->e('article > div > p:first-child');
```
> El resultado es un objeto \PHPTools\PHPHtmlDom\Core\PHPHtmlDomList con una serie de metodos que te permitiran manejar el resultado.

> Cada objeto \PHPTools\PHPHtmlDom\Core\PHPHtmlDomList esta compuestoṕor una serie d elementos \PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement que tambien posee una serie de metodos para manipular dich objeto.

## Un Ejemplo Completo

```php
$dom = new \PHPTools\PHPHtmlDom\PHPHtmlDom;

if(!!$dom->importHTML('http://php.net/'))
{
    var_dump($domlist->count());

    $domlist = $dom->e('article');

    $element = $domlist->eq(0);

    $parentElem = $element->parent();

    $find = $domlist->eq(0)->childs->find('p');

    $find->each(function($inx,$ele){
        echo sprintf("%s : %s","Tiene la clase item",$ele->hasclass('item'));
        echo sprintf("%s : %s","Nombre de la Etiqueta",$ele->tagName);
        echo sprintf("%s : %s","Texto con Forrmato",$ele->textFormatting);
    });
}
```