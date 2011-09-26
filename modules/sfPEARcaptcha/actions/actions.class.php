<?php

/**
 * sfPEARcaptcha actions.
 *
 * @package    sfPEARcaptchaPlugin
 * @subpackage modules
 * @author     Tomasz Jakub Rup
 */
class sfPEARcaptchaActions extends sfActions {

	public function executeCaptcha(sfWebRequest $request) {
		$options = sfContext::getInstance()->getStorage()->read('captcha/options');
		$phrase = sfContext::getInstance()->getStorage()->read('captcha/phrase');
		$this->forward404If(sfPEARcaptchaUtil::getHash($options, $phrase) != $request->getParameter('hash'));
		
		if ($options === null) $options = array();
		$options['phrase'] = $phrase;
		
		$captcha = Text_CAPTCHA::factory('Image');
		$captcha->init($options);
		
		if ($options['output'] == 'resource') {
			$this->getResponse()->setContentType('image/png');
			imagepng($captcha->getCAPTCHA());
		} else {
			$this->getResponse()->setContentType('image/' . $options['output']);
			$this->getResponse()->setContent($captcha->getCAPTCHA());
		}

		return sfView::NONE;
	}

}
