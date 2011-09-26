<?php

/**
 * sfPEARcaptcha Utils
 *
 * @package sfPEARcaptchaPlugin
 * @subpackage validator
 * @author Tomasz Jakub Rup <tomasz.rup@gmail.com>
 */
class sfPEARcaptchaUtil {

	/**
	 * 
	 * @param array $options Params
	 * @param string $phrase Phrase
	 * @return string
	 */
	public static function getHash(array $options, $phrase) {
		$hashFunc = sfConfig::get('app_sf_pear_captcha_plugin_hash_callable', 'md5');
		$secret = sfConfig::get('sf_csrf_secret', '');
		
		if (!is_callable($hashFunc)) {
			throw new sfConfigurationException('[sfPEARcaptchaPlugin] hash function is not callable!');
		}

		return call_user_func($hashFunc, $secret . json_encode($options) . $phrase);
	}

}
