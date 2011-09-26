<?php

/**
 * sfWidgetFormCaptchaImage represents an equation captcha widget.
 *
 * @package sfPEARcaptchaPlugin
 * @subpackage widget
 * @author Tomasz Jakub Rup <tomasz.rup@gmail.com>
 */
class sfWidgetFormCaptchaEquation extends sfWidgetFormInputText {

	/**
	 * Constructor.
	 *
	 * Available options:
	 *
	 *  - template:        Captcha description template
	 *  - min:             Minimal number to use in an equation.
	 *  - max:             Maximum number to use in an equation.
	 *  - numbers_to_text: Whether numbers shall be converted to text
	 *  - severity:        Complexity of the generated equations. 1 - simple ones such as "1 + 10", 2 - harder ones such as "(3-2)*(min(5,6))"
	 *
	 * @param array  $options     An array of options
	 * @param array  $attributes  An array of default HTML attributes
	 *
	 * @see sfWidgetFormInputText
	 */
	public function __construct($options = array(), $attributes = array()) {
		$this->addOption('template', 'Give me the answer to "%%captcha%%" to prove that you are human.');
		$this->addOption('min', 1);
		$this->addOption('max', 10);
		$this->addOption('numbers_to_text', false);
		$this->addOption('severity', 1);

		parent::__construct($options, $attributes);
	}

	/**
	 * Renders the widget.
	 *
	 * @param  string $name        The element name
	 * @param  string $value       The this widget is checked if value is not null
	 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
	 * @param  array  $errors      An array of errors for the field
	 *
	 * @return string An HTML tag string
	 *
	 * @see sfWidgetFormInputText
	 */
	public function render($name, $value = null, $attributes = array(), $errors = array()) {
		sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');
		
		$captcha = Text_CAPTCHA::factory('Equation');
		$captcha->init(array(
			'min' => $this->getOption('min'),
			'max' => $this->getOption('max'),
			'numbersToText' => $this->getOption('numbers_to_text'),
			'severity' => $this->getOption('severity'),
		));

		sfContext::getInstance()->getStorage()->write('captcha/phrase', $captcha->getPhrase());

		$template = str_replace('%%captcha%%', $captcha->getCAPTCHA(), __($this->getOption('template')));

		return $this->renderContentTag('label', $template, array_merge($attributes, array('for' => $this->generateId($name)))) . parent::render($name, $value, $attributes, $errors);
	}

}
