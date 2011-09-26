<?php

/**
 * sfValidatorCaptcha validates a captcha.
 *
 * @package sfPEARcaptchaPlugin
 * @subpackage validator
 * @author Tomasz Jakub Rup <tomasz.rup@gmail.com>
 */
class sfValidatorCaptcha extends sfValidatorBase {

	/**
	 * Configures the current validator.
	 *
	 * @param array $options   An array of options
	 * @param array $messages  An array of error messages
	 *
	 * @see sfValidatorBase
	 */
	protected function configure($options = array(), $messages = array()) {
		$this->setMessage('invalid', '"%value%" is a bad answer.');
	}

	/**
	 * @see sfValidatorBase
	 */
	public function doClean($value) {
		$phrase = sfContext::getInstance()->getStorage()->read('captcha/phrase');

		if ($phrase != $value) {
			throw new sfValidatorError($this, 'invalid', array('value' => $value));
		}

		return $value;
	}

}
