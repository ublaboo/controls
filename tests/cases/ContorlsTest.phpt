<?php

namespace Ublaboo\Mailing\Tests\Cases;

use Tester\TestCase,
	Tester\Assert,
	Nette,
	Mockery,
	Ublaboo;

require __DIR__ . '/../bootstrap.php'; 

final class ContorlsTest extends TestCase
{

	public function testNotTranslatableSelectBox()
	{
		$translator = Mockery::mock('Nette\Localization\ITranslator');
		$translator->shouldReceive('translate')->andReturn('translated');

		$radio_list = new Ublaboo\Controls\Controls\NotTranslatableRadioList(
			'',
			['option1' => 'option1']
		);
		$radio_list->setParent(new Nette\Forms\Form);
		$radio_list->setTranslator($translator);

		Assert::same(
			'<label><input type="radio" name="" value="option1">option1</label>',
			(string) $radio_list->getControl()
		);
	}


	public function testNotTranslatableRadioList()
	{
		$translator = Mockery::mock('Nette\Localization\ITranslator');
		$translator->shouldReceive('translate')->andReturn('translated');

		$select = new Ublaboo\Controls\Controls\NotTranslatableSelectBox(
			'',
			['option1' => 'option1']
		);
		$select->setParent(new Nette\Forms\Form);
		$select->setTranslator($translator);

		Assert::same(
			'<select name="" id="frm-"><option value="option1">option1</option></select>',
			(string) $select->getControl()
		);
	}


	public function testTextInputCustomLabel()
	{
		$input = new Ublaboo\Controls\Controls\TextInputCustomLabel();
		$input->setParent(new Nette\Forms\Form);

		$input->getLabelPrototype()->setText('<span class="icon"></span>');
		$html = (string) $input->getLabel();

		Assert::same(
			'<label for="frm-"><span class="icon"></span></label>',
			htmlspecialchars_decode($html)
		);
	}

}


$test_case = new ContorlsTest;
$test_case->run();
