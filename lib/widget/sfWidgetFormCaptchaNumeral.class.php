<?php

/**
 * Description of sfWidgetFormCaptchaNumeral
 *
 * @author Tomasz Jakub Rup
 */
class sfWidgetFormCaptchaNumeral extends sfWidgetFormInputText {

	/**
	 * Constructor.
	 *
	 * Available options:
	 *
	 *  - template:  Captcha description template
	 *  - min_value: Minimum range value
	 *  - max_value: Maximum range value
	 *
	 * @param array  $options     An array of options
	 * @param array  $attributes  An array of default HTML attributes
	 *
	 * @see sfWidgetFormInputText
	 */
	public function __construct($options = array(), $attributes = array()) {
		$this->addOption('template', 'Give me the answer to "%%captcha%%" to prove that you are human.');
		$this->addOption('min_value', 1);
		$this->addOption('max_value', 50);

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
	 * @see sfWidgetForm
	 */
	public function render($name, $value = null, $attributes = array(), $errors = array()) {
		sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');
		
		$captcha = Text_CAPTCHA::factory('Numeral');
		$captcha->init(array(
			'minValue' => $this->getOption('min_value'),
			'maxValue' => $this->getOption('max_value'),
		));

		sfContext::getInstance()->getStorage()->write('captcha/phrase', $captcha->getPhrase());
		
		$template = str_replace('%%captcha%%', $captcha->getCAPTCHA(), __($this->getOption('template')));

		return $this->renderContentTag('label', $template, array_merge($attributes, array('for' => $this->generateId($name)))) . parent::render($name, $value, $attributes, $errors);
	}

}
