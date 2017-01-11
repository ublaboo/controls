<?php

/**
 * @copyright   Copyright (c) 2015 ublaboo <ublaboo@paveljanda.com>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Ublaboo
 */

namespace Ublaboo\Controls\Controls;

use Nette,
	Nette\Forms\Controls\BaseControl;

class NotTranslatableSelectBox extends Nette\Forms\Controls\SelectBox
{

	/**
	 * @var array
	 */
	private $options = [];

	/**
	 * We have to repeat that method in our class due to parent::$options property accesibility
	 *  Otherwise we would be working with BaseControl::$options
	 * @param array   $items   [description]
	 * @param boolean $useKeys [description]
	 */
	public function setItems(array $items, $useKeys = TRUE)
	{
		if (!$useKeys) {
			$res = array();
			foreach ($items as $key => $value) {
				unset($items[$key]);
				if (is_array($value)) {
					foreach ($value as $val) {
						$res[$key][(string) $val] = $val;
					}
				} else {
					$res[(string) $value] = $value;
				}
			}
			$items = $res;
		}
		$this->options = $items;
		return parent::setItems(Nette\Utils\Arrays::flatten($items, TRUE));
	}


	/**
	 * Just remove translations from each option
	 * @return Nette\Forms\Helpers
	 */
	public function getControl()
	{
		$items = $this->getPrompt() === FALSE ? array() : array('' => $this->translate($this->getPrompt()));
		foreach ($this->options as $key => $value) {
			$items[is_array($value) ? $key : $key] = $value;
		}

		return Nette\Forms\Helpers::createSelectBox(
			$items,
			array(
				'selected?' => $this->value,
				'disabled:' => is_array($this->disabled) ? $this->disabled : NULL
			)
		)->addAttributes(BaseControl::getControl()->attrs);
	}


	/**
	 * Register NotTranslatableSelectBox
	 * @param  string $control_name string
	 * @return void
	 */
	public static function register($control_name = 'addNotTranslatableSelect') {
		Nette\Object::extensionMethod(
			'Nette\Forms\Container::' . $control_name,
			function ($form, $name, $label = NULL, array $items = NULL, $size = NULL) {
				$control = new self($label, $items);

				if ($size > 1) {
					$control->setAttribute('size', (int) $size);
				}

				return $form[$name] = $control;
			}
		);
	}

}
