<?php

/**
 * Description of sfWidgetFormCaptchaWord
 *
 * @author Tomasz Jakub Rup
 */
class sfWidgetFormCaptchaWord extends sfWidgetFormInputText {

	/**
	 * Constructor.
	 *
	 * Available options:
	 *
	 *  - template: Captcha description template
	 *  - length:   Phrase length.
	 *  - mode:     Numbers_Words mode. 'single' or 'multiple'
	 *  - locale:   Locale
	 *
	 * @param array  $options     An array of options
	 * @param array  $attributes  An array of default HTML attributes
	 *
	 * @see sfWidgetFormInputText
	 */
	public function __construct($options = array(), $attributes = array()) {
		$this->addOption('template', 'Type a number: "%%captcha%%"');
		$this->addOption('length', 4);
		$this->addOption('mode', 'single');
		$this->addOption('locale', sfContext::getInstance()->getUser()->getCulture());

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
		
		$captcha = Text_CAPTCHA::factory('Word');
		$captcha->init(array(
			'length' => $this->getOption('length'),
			'mode' => $this->getOption('mode'),
			'locale' => $this->getOption('locale'),
		));

		sfContext::getInstance()->getStorage()->write('captcha/phrase', $captcha->getPhrase());

		$template = str_replace('%%captcha%%', $captcha->getCAPTCHA(), __($this->getOption('template')));

		return $this->renderContentTag('label', $template, array_merge($attributes, array('for' => $this->generateId($name)))) . parent::render($name, $value, $attributes, $errors);
	}

}
