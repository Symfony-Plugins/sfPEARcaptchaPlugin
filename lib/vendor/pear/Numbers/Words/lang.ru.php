<?php
/**
 * Numbers_Words
 *
 * PHP version 5
 *
 * Copyright (c) 1997-2006 The PHP Group
 *
 * This source file is subject to version 3.0 of the PHP license,
 * that is bundled with this package in the file LICENSE, and is
 * available at through the world-wide-web at
 * http://www.php.net/license/3_0.txt.
 * If you did not receive a copy of the PHP license and are unable to
 * obtain it through the world-wide-web, please send a note to
 * license@php.net so we can mail you a copy immediately.
 *
 * @category Numbers
 * @package  Numbers_Words
 * @author   Piotr Klaban <makler@man.torun.pl>
 * @author   Andrey Demenev <demenev@gmail.com>
 * @license  PHP 3.0 http://www.php.net/license/3_0.txt
 * @version  CVS: $Id: lang.ru.php 269612 2008-11-24 15:11:52Z clockwerx $
 * @link     http://pear.php.net/package/Numbers_Words
 */

/**
 * Class for translating numbers into Russian.
 *
 * @category Numbers
 * @package  Numbers_Words
 * @author   Piotr Klaban <makler@man.torun.pl>
 * @author   Andrey Demenev <demenev@gmail.com>
 * @license  PHP 3.0 http://www.php.net/license/3_0.txt
 * @link     http://pear.php.net/package/Numbers_Words
 */
class Numbers_Words_ru
{

    // {{{ properties

    /**
     * Locale name
     * @var string
     * @access public
     */
    public $locale = 'ru';

    /**
     * Language name in English
     * @var string
     * @access public
     */
    public $lang = 'Russian';

    /**
     * Native language name
     * @var string
     * @access public
     */
    public $lang_native = 'аѓёёъшщ';
    
    /**
     * The word for the minus sign
     * @var string
     * @access private
     */
    private $_minus = 'ьшэѓё'; // minus sign
    
    /**
     * The sufixes for exponents (singular)
     * Names partly based on:
     * http://home.earthlink.net/~mrob/pub/math/largenum.html
     * http://mathforum.org/dr.math/faq/faq.large.numbers.html
     * http://www.mazes.com/AmericanNumberingSystem.html
     * @var array
     * @access private
     */
    private $_exponent = array(
        0 => '',
        6 => 'ьшыышюэ',
        9 => 'ьшыышр№ф',
       12 => 'ђ№шыышюэ',
       15 => 'ътрф№шыышюэ',
       18 => 'ътшэђшыышюэ',
       21 => 'ёхъёђшыышюэ',
       24 => 'ёхяђшыышюэ',
       27 => 'юъђшыышюэ',
       30 => 'эюэшыышюэ',
       33 => 'фхішыышюэ',
       36 => 'ѓэфхішыышюэ',
       39 => 'фѓюфхішыышюэ',
       42 => 'ђ№хфхішыышюэ',
       45 => 'ътрђѓю№фхішыышюэ',
       48 => 'ътшэфхішыышюэ',
       51 => 'ёхъёфхішыышюэ',
       54 => 'ёхяђхэфхішыышюэ',
       57 => 'юъђюфхішыышюэ',
       60 => 'эютхьфхішыышюэ',
       63 => 'тшушэђшыышюэ',
       66 => 'ѓэтшушэђшыышюэ',
       69 => 'фѓютшушэђшыышюэ',
       72 => 'ђ№хтшушэђшыышюэ',
       75 => 'ътрђѓю№тшушэђшыышюэ',
       78 => 'ътшэтшушэђшыышюэ',
       81 => 'ёхъётшушэђшыышюэ',
       84 => 'ёхяђхэтшушэђшыышюэ',
       87 => 'юъђютшушэђшыышюэ',
       90 => 'эютхьтшушэђшыышюэ',
       93 => 'ђ№шушэђшыышюэ',
       96 => 'ѓэђ№шушэђшыышюэ',
       99 => 'фѓюђ№шушэђшыышюэ',
       102 => 'ђ№хђ№шушэђшыышюэ',
       105 => 'ътрђю№ђ№шушэђшыышюэ',
       108 => 'ътшэђ№шушэђшыышюэ',
       111 => 'ёхъёђ№шушэђшыышюэ',
       114 => 'ёхяђхэђ№шушэђшыышюэ',
       117 => 'юъђюђ№шушэђшыышюэ',
       120 => 'эютхьђ№шушэђшыышюэ',
       123 => 'ътрф№рушэђшыышюэ',
       126 => 'ѓэътрф№рушэђшыышюэ',
       129 => 'фѓюътрф№рушэђшыышюэ',
       132 => 'ђ№хътрф№рушэђшыышюэ',
       135 => 'ътрђю№ътрф№рушэђшыышюэ',
       138 => 'ътшэътрф№рушэђшыышюэ',
       141 => 'ёхъёътрф№рушэђшыышюэ',
       144 => 'ёхяђхэътрф№рушэђшыышюэ',
       147 => 'юъђюътрф№рушэђшыышюэ',
       150 => 'эютхьътрф№рушэђшыышюэ',
       153 => 'ътшэътрушэђшыышюэ',
       156 => 'ѓэътшэърушэђшыышюэ',
       159 => 'фѓюътшэърушэђшыышюэ',
       162 => 'ђ№хътшэърушэђшыышюэ',
       165 => 'ътрђю№ътшэърушэђшыышюэ',
       168 => 'ътшэътшэърушэђшыышюэ',
       171 => 'ёхъёътшэърушэђшыышюэ',
       174 => 'ёхяђхэътшэърушэђшыышюэ',
       177 => 'юъђюътшэърушэђшыышюэ',
       180 => 'эютхьътшэърушэђшыышюэ',
       183 => 'ёхъёрушэђшыышюэ',
       186 => 'ѓэёхъёрушэђшыышюэ',
       189 => 'фѓюёхъёрушэђшыышюэ',
       192 => 'ђ№хёхъёрушэђшыышюэ',
       195 => 'ътрђю№ёхъёрушэђшыышюэ',
       198 => 'ътшэёхъёрушэђшыышюэ',
       201 => 'ёхъёёхъёрушэђшыышюэ',
       204 => 'ёхяђхэёхъёрушэђшыышюэ',
       207 => 'юъђюёхъёрушэђшыышюэ',
       210 => 'эютхьёхъёрушэђшыышюэ',
       213 => 'ёхяђрушэђшыышюэ',
       216 => 'ѓэёхяђрушэђшыышюэ',
       219 => 'фѓюёхяђрушэђшыышюэ',
       222 => 'ђ№хёхяђрушэђшыышюэ',
       225 => 'ътрђю№ёхяђрушэђшыышюэ',
       228 => 'ътшэёхяђрушэђшыышюэ',
       231 => 'ёхъёёхяђрушэђшыышюэ',
       234 => 'ёхяђхэёхяђрушэђшыышюэ',
       237 => 'юъђюёхяђрушэђшыышюэ',
       240 => 'эютхьёхяђрушэђшыышюэ',
       243 => 'юъђюушэђшыышюэ',
       246 => 'ѓэюъђюушэђшыышюэ',
       249 => 'фѓююъђюушэђшыышюэ',
       252 => 'ђ№хюъђюушэђшыышюэ',
       255 => 'ътрђю№юъђюушэђшыышюэ',
       258 => 'ътшэюъђюушэђшыышюэ',
       261 => 'ёхъёюъђюушэђшыышюэ',
       264 => 'ёхяђюъђюушэђшыышюэ',
       267 => 'юъђююъђюушэђшыышюэ',
       270 => 'эютхьюъђюушэђшыышюэ',
       273 => 'эюэрушэђшыышюэ',
       276 => 'ѓээюэрушэђшыышюэ',
       279 => 'фѓюэюэрушэђшыышюэ',
       282 => 'ђ№хэюэрушэђшыышюэ',
       285 => 'ътрђю№эюэрушэђшыышюэ',
       288 => 'ътшээюэрушэђшыышюэ',
       291 => 'ёхъёэюэрушэђшыышюэ',
       294 => 'ёхяђхээюэрушэђшыышюэ',
       297 => 'юъђюэюэрушэђшыышюэ',
       300 => 'эютхьэюэрушэђшыышюэ',
       303 => 'іхэђшыышюэ'
        );

    /**
     * The array containing the teens' :) names
     * @var array
     * @access private
     */
    private $_teens = array(
        11=>'юфшээрфірђќ',
        12=>'фтхэрфірђќ',
        13=>'ђ№шэрфірђќ',
        14=>'їхђћ№эрфірђќ',
        15=>'яџђэрфірђќ',
        16=>'јхёђэрфірђќ',
        17=>'ёхьэрфірђќ',
        18=>'тюёхьэрфірђќ',
        19=>'фхтџђэрфірђќ'
        );

    /**
     * The array containing the tens' names
     * @var array
     * @access private
     */
    private $_tens = array(
        2=>'фтрфірђќ',
        3=>'ђ№шфірђќ',
        4=>'ёю№юъ',
        5=>'яџђќфхёџђ',
        6=>'јхёђќфхёџђ',
        7=>'ёхьќфхёџђ',
        8=>'тюёхьќфхёџђ',
        9=>'фхтџэюёђю'
        );

    /**
     * The array containing the hundreds' names
     * @var array
     * @access private
     */
    private $_hundreds = array(
        1=>'ёђю',
        2=>'фтхёђш',
        3=>'ђ№шёђр',
        4=>'їхђћ№хёђр',
        5=>'яџђќёюђ',
        6=>'јхёђќёюђ',
        7=>'ёхьќёюђ',
        8=>'тюёхьќёюђ',
        9=>'фхтџђќёюђ'
        );

    /**
     * The array containing the digits 
     * for neutral, male and female
     * @var array
     * @access private
     */
    private $_digits = array(
        array('эюыќ', 'юфэю', 'фтр', 'ђ№ш', 'їхђћ№х', 'яџђќ', 'јхёђќ', 'ёхьќ', 'тюёхьќ', 'фхтџђќ'),
        array('эюыќ', 'юфшэ', 'фтр', 'ђ№ш', 'їхђћ№х', 'яџђќ', 'јхёђќ', 'ёхьќ', 'тюёхьќ', 'фхтџђќ'),
        array('эюыќ', 'юфэр', 'фтх', 'ђ№ш', 'їхђћ№х', 'яџђќ', 'јхёђќ', 'ёхьќ', 'тюёхьќ', 'фхтџђќ')
    );

    /**
     * The word separator
     * @var string
     * @access private
     */
    private $_sep = ' ';

    /**
     * The currency names (based on the below links,
     * informations from central bank websites and on encyclopedias)
     *
     * @var array
     * @link http://www.jhall.demon.co.uk/currency/by_abbrev.html World currencies
     * @link http://www.rusimpex.ru/Content/Reference/Refinfo/valuta.htm Foreign currencies names
     * @link http://www.cofe.ru/Finance/money.asp Currencies names
     * @access private
     */
    private $_currency_names = array(
      'ALL' => array(
                array(1, 'ыхъ', 'ыхър', 'ыхъют'), 
                array(2, 'ъшэфр№ър', 'ъшэфр№ъш', 'ъшэфр№юъ')
               ),
      'AUD' => array(
                array(1, 'ртёђ№рышщёъшщ фюыыр№', 'ртёђ№рышщёъшѕ фюыыр№р', 'ртёђ№рышщёъшѕ фюыыр№ют'),
                array(1, 'іхэђ', 'іхэђр', 'іхэђют')
               ),
      'BGN' => array(
                array(1, 'ыхт', 'ыхтр', 'ыхтют'), 
                array(2, 'ёђюђшэър', 'ёђюђшэъш', 'ёђюђшэюъ')
               ),
      'BRL' => array(
                array(1, 'с№рчшыќёъшщ №хры', 'с№рчшыќёъшѕ №хрыр', 'с№рчшыќёъшѕ №хрыют'), 
                array(1, 'ёхэђртю', 'ёхэђртю', 'ёхэђртю')
               ),
      'BYR' => array(
                array(1, 'схыю№ѓёёъшщ №ѓсыќ', 'схыю№ѓёёъшѕ №ѓсыџ', 'схыю№ѓёёъшѕ №ѓсыхщ'), 
                array(2, 'ъюяхщър', 'ъюяхщъш', 'ъюяххъ')
               ),
      'CAD' => array(
                array(1, 'ърэрфёъшщ фюыыр№', 'ърэрфёъшѕ фюыыр№р', 'ърэрфёъшѕ фюыыр№ют'),
                array(1, 'іхэђ', 'іхэђр', 'іхэђют')
               ),
      'CHF' => array(
                array(1, 'јтхщір№ёъшщ є№рэъ', 'јтхщір№ёъшѕ є№рэър', 'јтхщір№ёъшѕ є№рэъют'),
                array(1, 'ёрэђшь', 'ёрэђшьр', 'ёрэђшьют')
               ),
      'CYP' => array(
                array(1, 'ъшя№ёъшщ єѓэђ', 'ъшя№ёъшѕ єѓэђр', 'ъшя№ёъшѕ єѓэђют'),
                array(1, 'іхэђ', 'іхэђр', 'іхэђют')
               ),
      'CZK' => array(
                array(2, 'їхјёърџ ъ№юэр', 'їхјёъшѕ ъ№юэћ', 'їхјёъшѕ ъ№юэ'),
                array(1, 'урыш№ц', 'урыш№цр', 'урыш№цхщ')
               ),
      'DKK' => array(
                array(2, 'фрђёърџ ъ№юэр', 'фрђёъшѕ ъ№юэћ', 'фрђёъшѕ ъ№юэ'),
                array(1, '§№х', '§№х', '§№х')
               ),
      'EEK' => array(
                array(2, '§ёђюэёърџ ъ№юэр', '§ёђюэёъшѕ ъ№юэћ', '§ёђюэёъшѕ ъ№юэ'),
                array(1, 'ёхэђш', 'ёхэђш', 'ёхэђш')
               ),
      'EUR' => array(
                array(1, 'хт№ю', 'хт№ю', 'хт№ю'),
                array(1, 'хт№юіхэђ', 'хт№юіхэђр', 'хт№юіхэђют')
               ),
      'CYP' => array(
                array(1, 'єѓэђ ёђх№ышэуют', 'єѓэђр ёђх№ышэуют', 'єѓэђют ёђх№ышэуют'),
                array(1, 'яхэё', 'яхэёр', 'яхэёют')
               ),
      'CAD' => array(
                array(1, 'уюэъюэуёъшщ фюыыр№', 'уюэъюэуёъшѕ фюыыр№р', 'уюэъюэуёъшѕ фюыыр№ют'),
                array(1, 'іхэђ', 'іхэђр', 'іхэђют')
               ),
      'HRK' => array(
                array(2, 'ѕю№трђёърџ ъѓэр', 'ѕю№трђёъшѕ ъѓэћ', 'ѕю№трђёъшѕ ъѓэ'),
                array(2, 'ышяр', 'ышяћ', 'ышя')
               ),
      'HUF' => array(
                array(1, 'тхэух№ёъшщ єю№шэђ', 'тхэух№ёъшѕ єю№шэђр', 'тхэух№ёъшѕ єю№шэђют'),
                array(1, 'єшыых№', 'єшыых№р', 'єшыых№ют')
               ),
      'ISK' => array(
                array(2, 'шёырэфёърџ ъ№юэр', 'шёырэфёъшѕ ъ№юэћ', 'шёырэфёъшѕ ъ№юэ'),
                array(1, '§№х', '§№х', '§№х')
               ),
      'JPY' => array(
                array(2, 'шхэр', 'шхэћ', 'шхэ'),
                array(2, 'ёхэр', 'ёхэћ', 'ёхэ')
               ),
      'LTL' => array(
                array(1, 'ышђ', 'ышђр', 'ышђют'),
                array(1, 'іхэђ', 'іхэђр', 'іхэђют')
               ),
      'LVL' => array(
                array(1, 'ырђ', 'ырђр', 'ырђют'),
                array(1, 'ёхэђшь', 'ёхэђшьр', 'ёхэђшьют')
               ),
      'MKD' => array(
                array(1, 'ьръхфюэёъшщ фшэр№', 'ьръхфюэёъшѕ фшэр№р', 'ьръхфюэёъшѕ фшэр№ют'),
                array(1, 'фхэш', 'фхэш', 'фхэш')
               ),
      'MTL' => array(
                array(2, 'ьрыќђшщёърџ ыш№р', 'ьрыќђшщёъшѕ ыш№ћ', 'ьрыќђшщёъшѕ ыш№'),
                array(1, 'ёхэђшь', 'ёхэђшьр', 'ёхэђшьют')
               ),
      'NOK' => array(
                array(2, 'эю№тхцёърџ ъ№юэр', 'эю№тхцёъшѕ ъ№юэћ', 'эю№тхцёъшѕ ъ№юэ'),
                array(0, '§№х', '§№х', '§№х')
               ),
      'PLN' => array(
                array(1, 'чыюђћщ', 'чыюђћѕ', 'чыюђћѕ'),
                array(1, 'у№юј', 'у№юјр', 'у№юјхщ')
               ),
      'ROL' => array(
                array(1, '№ѓьћэёъшщ ыхщ', '№ѓьћэёъшѕ ыхщ', '№ѓьћэёъшѕ ыхщ'),
                array(1, 'срэш', 'срэш', 'срэш')
               ),
       // both RUR and RUR are used, I use RUB for shorter form
      'RUB' => array(
                array(1, '№ѓсыќ', '№ѓсыџ', '№ѓсыхщ'),
                array(2, 'ъюяхщър', 'ъюяхщъш', 'ъюяххъ')
               ),
      'RUR' => array(
                array(1, '№юёёшщёъшщ №ѓсыќ', '№юёёшщёъшѕ №ѓсыџ', '№юёёшщёъшѕ №ѓсыхщ'),
                array(2, 'ъюяхщър', 'ъюяхщъш', 'ъюяххъ')
               ),
      'SEK' => array(
                array(2, 'јтхфёърџ ъ№юэр', 'јтхфёъшѕ ъ№юэћ', 'јтхфёъшѕ ъ№юэ'),
                array(1, '§№х', '§№х', '§№х')
               ),
      'SIT' => array(
                array(1, 'ёыютхэёъшщ ђюыр№', 'ёыютхэёъшѕ ђюыр№р', 'ёыютхэёъшѕ ђюыр№ют'),
                array(2, 'ёђюђшэр', 'ёђюђшэћ', 'ёђюђшэ')
               ),
      'SKK' => array(
                array(2, 'ёыютріърџ ъ№юэр', 'ёыютріъшѕ ъ№юэћ', 'ёыютріъшѕ ъ№юэ'),
                array(0, '', '', '')
               ),
      'TRL' => array(
                array(2, 'ђѓ№хіърџ ыш№р', 'ђѓ№хіъшѕ ыш№ћ', 'ђѓ№хіъшѕ ыш№'),
                array(1, 'яшрёђ№', 'яшрёђ№р', 'яшрёђ№ют')
               ),
      'UAH' => array(
                array(2, 'у№штэр', 'у№штэћ', 'у№штхэ'),
                array(1, 'іхэђ', 'іхэђр', 'іхэђют')
               ),
      'USD' => array(
                array(1, 'фюыыр№ биР', 'фюыыр№р биР', 'фюыыр№ют биР'),
                array(1, 'іхэђ', 'іхэђр', 'іхэђют')
               ),
      'YUM' => array(
                array(1, 'ўуюёыртёъшщ фшэр№', 'ўуюёыртёъшѕ фшэр№р', 'ўуюёыртёъшѕ фшэр№ют'),
                array(1, 'яр№р', 'яр№р', 'яр№р')
               ),
      'ZAR' => array(
                array(1, '№рэф', '№рэфр', '№рэфют'),
                array(1, 'іхэђ', 'іхэђр', 'іхэђют')
               )
    );

    /**
     * The default currency name
     * @var string
     * @access public
     */
    public $def_currency = 'RUB'; // Russian rouble

    // }}}
    // {{{ toWords()

    /**
     * Converts a number to its word representation
     * in Russian language
     *
     * @param integer $num    An integer between -infinity and infinity inclusive :)
     *                        that need to be converted to words
     * @param integer $gender Gender of string, 0=neutral, 1=male, 2=female.
     *                        Optional, defaults to 1.
     *
     * @return string  The corresponding word representation
     *
     * @access private
     * @author Andrey Demenev <demenev@on-line.jar.ru>
     */
    public function toWords($num, $gender = 1) 
    {
        return $this->_toWordsWithCase($num, $dummy, $gender);
    }

    /**
     * Converts a number to its word representation
     * in Russian language and determines the case of string.
     *
     * @param integer $num    An integer between -infinity and infinity inclusive :)
     *                        that need to be converted to words
     * @param integer &$case  A variable passed by reference which is set to case
     *                        of the word associated with the number
     * @param integer $gender Gender of string, 0=neutral, 1=male, 2=female.
     *                        Optional, defaults to 1.
     *
     * @return string  The corresponding word representation
     *
     * @access private
     * @author Andrey Demenev <demenev@on-line.jar.ru>
     */
    private function _toWordsWithCase($num, &$case, $gender = 1)
    {
        $ret  = '';
        $case = 3;
      
        $num = trim($num);
      
        $sign = "";
        if (substr($num, 0, 1) == '-') {
            $sign = $this->_minus . $this->_sep;
            $num  = substr($num, 1);
        }

        while (strlen($num) % 3) {
            $num = '0' . $num;
        }

        if ($num == 0 || $num == '') {
            $ret .= $this->_digits[$gender][0];
        } else {
            $power = 0;

            while ($power < strlen($num)) {
                if (!$power) {
                    $groupgender = $gender;
                } elseif ($power == 3) {
                    $groupgender = 2;
                } else {
                    $groupgender = 1;
                }

                $group = $this->_groupToWords(substr($num, -$power-3, 3), $groupgender, $_case);
                if (!$power) {
                    $case = $_case;
                }

                if ($power == 3) {
                    if ($_case == 1) {
                        $group .= $this->_sep . 'ђћёџїр';
                    } elseif ($_case == 2) {
                        $group .= $this->_sep . 'ђћёџїш';
                    } else {
                        $group .= $this->_sep . 'ђћёџї';
                    }
                } elseif ($group && $power>3 && isset($this->_exponent[$power])) {
                    $group .= $this->_sep . $this->_exponent[$power];
                    if ($_case == 2) {
                        $group .= 'р';
                    } elseif ($_case == 3) {
                        $group .= 'ют';
                    }
                }

                if ($group) {
                    $ret = $group . $this->_sep . $ret;
                }

                $power += 3;
            }
        }

        return $sign . $ret;
    }

    // }}}
    // {{{ _groupToWords()

    /**
     * Converts a group of 3 digits to its word representation
     * in Russian language.
     *
     * @param integer $num    An integer between -infinity and infinity inclusive :)
     *                        that need to be converted to words
     * @param integer $gender Gender of string, 0=neutral, 1=male, 2=female.
     * @param integer &$case  A variable passed by reference which is set to case
     *                        of the word associated with the number
     *
     * @return string  The corresponding word representation
     *
     * @access private
     * @author Andrey Demenev <demenev@on-line.jar.ru>
     */
    private function _groupToWords($num, $gender, &$case)
    {
        $ret  = '';        
        $case = 3;

        if ((int)$num == 0) {
            $ret = '';
        } elseif ($num < 10) {
            $ret = $this->_digits[$gender][(int)$num];
            if ($num == 1) {
                $case = 1;
            } elseif ($num < 5) {
                $case = 2; 
            } else {
                $case = 3;
            }

        } else {
            $num = str_pad($num, 3, '0', STR_PAD_LEFT);

            $hundreds = (int)$num{0};
            if ($hundreds) {
                $ret = $this->_hundreds[$hundreds];
                if (substr($num, 1) != '00') {
                    $ret .= $this->_sep;
                }

                $case = 3;
            }

            $tens = (int)$num{1};
            $ones = (int)$num{2};
            if ($tens || $ones) {
                if ($tens == 1 && $ones == 0) {
                    $ret .= 'фхёџђќ';
                } elseif ($tens == 1) {
                    $ret .= $this->_teens[$ones+10];
                } else {
                    if ($tens > 0) {
                        $ret .= $this->_tens[(int)$tens];
                    }

                    if ($ones > 0) {
                        $ret .= $this->_sep
                                . $this->_digits[$gender][$ones];

                        if ($ones == 1) {
                            $case = 1;
                        } elseif ($ones < 5) {
                            $case = 2;
                        } else {
                            $case = 3;
                        }
                    }
                }
            }
        }

        return $ret;
    }
    // }}}
    // {{{ toCurrencyWords()

    /**
     * Converts a currency value to its word representation
     * (with monetary units) in Russian language
     *
     * @param integer $int_curr         An international currency symbol
     *                                  as defined by the ISO 4217 standard (three characters)
     * @param integer $decimal          A money total amount without fraction part (e.g. amount of dollars)
     * @param integer $fraction         Fractional part of the money amount (e.g. amount of cents)
     *                                  Optional. Defaults to false.
     * @param integer $convert_fraction Convert fraction to words (left as numeric if set to false).
     *                                  Optional. Defaults to true.
     *
     * @return string  The corresponding word representation for the currency
     *
     * @access public
     * @author Andrey Demenev <demenev@on-line.jar.ru>
     */
    public function toCurrencyWords($int_curr, $decimal, $fraction = false, $convert_fraction = true)
    {
        $int_curr = strtoupper($int_curr);
        if (!isset($this->_currency_names[$int_curr])) {
            $int_curr = $this->def_currency;
        }

        $curr_names = $this->_currency_names[$int_curr];

        $ret  = trim($this->_toWordsWithCase($decimal, $case, $curr_names[0][0]));
        $ret .= $this->_sep . $curr_names[0][$case];

        if ($fraction !== false) {
            if ($convert_fraction) {
                $ret .= $this->_sep . trim($this->_toWordsWithCase($fraction, $case, $curr_names[1][0]));
            } else {
                $ret .= $this->_sep . $fraction;
            }

            $ret .= $this->_sep . $curr_names[1][$case];
        }
        return $ret;
    }
    // }}}

}
