<?php

/**
 * @copyright   Copyright (c) 2015 ublaboo <ublaboo@paveljanda.com>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Ublaboo
 */

namespace Ublaboo\Controls\Controls;

use Nette,
	Nette\Forms\Controls\ChoiceControl;

class NotTranslatableRadioList extends Nette\Forms\Controls\RadioList
{

	/**
	 * @var array
	 */
	private $options = [];

	/**
	 * @var mixed
	 */
	private $prompt = FALSE;


	/**
	 * Just remove translations from each option
	 * @return Nette\Forms\Helpers
	 */
	public function getControl(): Nette\Utils\Html
	{
		$input = ChoiceControl::getControl();
		$items = $this->getItems();
		$ids = array();
		if ($this->generateId) {
			foreach ($items as $value => $label) {
				$ids[$value] = $input->id . '-' . $value;
			}
		}

		return $this->container->setHtml(
			Nette\Forms\Helpers::createInputList(
				$items,
				array_merge($input->attrs, array(
					'id:' => $ids,
					'checked?' => $this->value,
					'disabled:' => $this->disabled,
					'data-nette-rules:' => array(key($items) => $input->attrs['data-nette-rules']),
				)),
				array('for:' => $ids) + $this->itemLabel->attrs,
				$this->separator
			)
		);
	}


	/**
	 * Register NotTranslatableRadioList
	 * @param  string $control_name string
	 * @return void
	 */
	public static function register($control_name = 'addNotTranslatableRadioList') {
		Nette\Object::extensionMethod(
			'Nette\Forms\Container::' . $control_name,
			function ($form, $name, $label = NULL, array $items = NULL) {
				$control = new self($label, $items);

				return $form[$name] = $control;
			}
		);
	}

}
