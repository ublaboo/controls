[![Build Status](https://travis-ci.org/ublaboo/controls.svg?branch=master)](https://travis-ci.org/ublaboo/controls)
[![Latest Stable Version](https://poser.pugx.org/ublaboo/controls/v/stable)](https://packagist.org/packages/ublaboo/controls) [![License](https://poser.pugx.org/ublaboo/controls/license)](https://packagist.org/packages/ublaboo/controls)
[![Total Downloads](https://poser.pugx.org/ublaboo/controls/downloads)](https://packagist.org/packages/ublaboo/controls)
[![HHVM Status](https://img.shields.io/hhvm/ublaboo/controls/master.svg)](http://hhvm.h4cc.de/package/ublaboo/controls)

# controls
Extension for Nette Framework: Some of form controls modified (no-translate select box options, checkbox list, changeable label text input, etc)

## 1, Register extension

```php
extensions:
  controls: Ublaboo\Controls\DI\ExtensionsExtension
```

## NotTranslatableRadioList

This control allows translating input names but not datio titles

$form->addNotTranslatableRadioList('Name', $values);

## NotTranslatableSelectBox

The same, but with Selet and it's options

$form->addNotTranslatableSelect('Name', $options);

## TextInputCustomLabel

You know, when you want to change input's label for example in form factory, the label stays unchanged when rendering form in template. This can be changed by using `TextInputCustomLabel`:

$form->addTextCustomLabel('name', 'Name');
