<?php

/**
 * @copyright   Copyright (c) 2015 ublaboo <ublaboo@paveljanda.com>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Ublaboo
 */

namespace Ublaboo\Controls\Controls;

use Nette;

class TextInputCustomLabel extends Nette\Forms\Controls\TextInput
{

	/**
	 * Register TextInputCustomLabel
	 * @param  string $control_name string
	 * @return void
	 */
	public static function register($control_name = 'addTextCustomLabel') {
		Nette\Forms\Container::extensionMethod($control_name, function ($form, $name, $label = NULL, array $items = NULL) {
			$control = new self($label, $items);

			return $form[$name] = $control;
		});
	}


	/**
	 * Generates label's HTML element.
	 * @param  string
	 * @return Html|string
	 */
	public function getLabel($caption = NULL)
	{
		$label = clone $this->label;
		$label->for = $this->getHtmlId();

		if (!$label->getHtml()) {
			$label->setText($this->translate($caption === NULL ? $this->caption : $caption));
		}

		return $label;
	}

}
