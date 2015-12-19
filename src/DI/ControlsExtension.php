<?php

/**
 * @copyright   Copyright (c) 2015 ublaboo <ublaboo@paveljanda.com>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Ublaboo
 */

namespace Ublaboo\Controls\DI;

use Nette;

class ControlsExtension extends Nette\DI\CompilerExtension
{

	/**
	 * @param  Nette\PhpGenerator\ClassType $class
	 * @return void
	 */
	public function afterCompile(Nette\PhpGenerator\ClassType $class)
	{
		parent::afterCompile($class);

		$init = $class->methods['initialize'];
		$init->addBody('Ublaboo\Controls\Controls\NotTranslatableSelectBox::register();');
		$init->addBody('Ublaboo\Controls\Controls\NotTranslatableRadioList::register();');
		$init->addBody('Ublaboo\Controls\Controls\TextInputCustomLabel::register();');
	}

}
