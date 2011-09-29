<?php

/**
 * sfWidgetFormCaptchaImage represents an figlet captcha widget.
 *
 * @package sfPEARcaptchaPlugin
 * @subpackage widget
 * @author Tomasz Jakub Rup <tomasz.rup@gmail.com>
 */
class sfWidgetFormCaptchaFiglet extends sfWidgetFormInputText {

	/**
	 * Constructor.
	 *
	 * Available options:
	 *
	 *  - output:          Output Format. 'text', 'html' or 'javascript'
	 *  - width:           Width of CAPTCHA.
	 *  - length:          Phrase length.
	 *  - font:            Figlet font.
	 *
	 * @param array  $options     An array of options
	 * @param array  $attributes  An array of default HTML attributes
	 *
	 * @see sfWidgetFormInputText
	 */
	public function __construct($options = array(), $attributes = array()) {
		$this->addOption('output', 'html');
		$this->addOption('width', 200);
		$this->addOption('length', 6);
		$this->addOption('font', 'ours/standard.flf');

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
		return $this->renderCaptcha($name, $value, $attributes, $errors) . $this->renderInputField($name, $value, $attributes, $errors);
	}
	
	/**
	 * Renders the input field for widget.
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
	public function renderInputField($name, $value = null, $attributes = array(), $errors = array()) {
		return parent::render($name, $value, $attributes, $errors);
	}
	
	/**
	 * Renders the captcha for widget.
	 *
	 * @param  string $name        The element name
	 * @param  string $value       The this widget is checked if value is not null
	 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
	 * @param  array  $errors      An array of errors for the field
	 *
	 * @return string An HTML tag string
	 */
	public function renderCaptcha($name, $value = null, $attributes = array(), $errors = array()) {
		$captcha = Text_CAPTCHA::factory('Figlet');
		$captcha->init(array(
			'output' => $this->getOption('output'),
			'width' => $this->getOption('width'),
			'length' => $this->getOption('length'),
			'options' => array('font_file' => $this->getOption('font')),
		));

		sfContext::getInstance()->getStorage()->write('captcha/phrase', $captcha->getPhrase());

		return $this->renderContentTag('div', $captcha->getCAPTCHA(), array_merge($attributes, array('id' => $this->generateId($name) . '_captcha', 'class' => 'captcha')));
	}

}
