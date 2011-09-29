<?php

/**
 * sfWidgetFormCaptchaImage represents an image captcha widget.
 *
 * @package sfPEARcaptchaPlugin
 * @subpackage widget
 * @author Tomasz Jakub Rup <tomasz.rup@gmail.com>
 */
class sfWidgetFormCaptchaImage extends sfWidgetFormInputText {

	/**
	 * Constructor.
	 *
	 * Available options:
	 *
	 *  - width:            Width of CAPTCHA.
	 *  - height:           Height of CAPTCHA.
	 *  - output:           CAPTCHA output format: 'resource', 'png', 'jpg', 'jpeg', 'gif'
	 *  - font_size:        Font size.
	 *  - font_file:        Font file name. The file must be located in the directory sfConfig::get('sf_data_dir') . '/font' or you must specify the full path.
	 *  - text_color:       Captcha color.
	 *  - lines_color:      Lines color.
	 *  - background_color: Background color.
	 *  - antialias:        Antialiasing on/off.
	 *
	 * @param array  $options     An array of options
	 * @param array  $attributes  An array of default HTML attributes
	 *
	 * @see sfWidgetFormInputText
	 */
	public function __construct($options = array(), $attributes = array()) {
		$this->addRequiredOption('font_file');

		$this->addOption('width', 200);
		$this->addOption('height', 80);
		$this->addOption('output', 'resource');
		$this->addOption('font_size', 24);
		$this->addOption('text_color', '#000000');
		$this->addOption('lines_color', '#CACACA');
		$this->addOption('background_color', '#555555');
		$this->addOption('antialias', false);

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
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');

		$fontPath = realpath($this->getOption('font_file'));
		if ($fontPath === false) {
			$fontPath = sfConfig::get('sf_data_dir') . '/font';
		}

		$options = array(
			'width' => $this->getOption('width'),
			'height' => $this->getOption('height'),
			'output' => $this->getOption('output'),
			'imageOptions' => array(
				'font_size' => $this->getOption('font_size'),
				'font_path' => $fontPath,
				'font_file' => basename($this->getOption('font_file')),
				'text_color' => $this->getOption('text_color'),
				'lines_color' => $this->getOption('lines_color'),
				'background_color' => $this->getOption('background_color'),
				'antialias' => $this->getOption('antialias'),
			),
		);
		$captcha = Text_CAPTCHA::factory('Image');
		$captcha->init($options);

		@session_start();
		sfContext::getInstance()->getStorage()->write('captcha/options', $options);
		sfContext::getInstance()->getStorage()->write('captcha/phrase', $captcha->getPhrase());

		$imgAttributes = array_merge($attributes, array(
			'id' => $this->generateId($name) . '_captcha',
			'class' => 'captcha',
			'src' => url_for('captcha_image', array('hash' => sfPEARcaptchaUtil::getHash($options, $captcha->getPhrase())))
				));

		return $this->renderTag('img', $imgAttributes);
	}

}
