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
 * @author   Kouber Saparev <kouber@php.net>
 * @license  PHP 3.0 http://www.php.net/license/3_0.txt
 * @version  CVS: $Id: lang.bg.php 269608 2008-11-24 14:41:17Z clockwerx $
 * @link     http://pear.php.net/package/Numbers_Words
 */

/**
 * Class for translating numbers into Bulgarian.
 *
 * @category Numbers
 * @package  Numbers_Words
 * @author   Kouber Saparev <kouber@php.net>
 * @license  PHP 3.0 http://www.php.net/license/3_0.txt
 * @link     http://pear.php.net/package/Numbers_Words
 */
class Numbers_Words_bg
{

    // {{{ properties

    /**
     * Locale name.
     * @var string
     * @access public
     */
    public $locale = 'bg';

    /**
     * Language name in English.
     * @var string
     * @access public
     */
    public $lang = 'Bulgarian';

    /**
     * Native language name.
     * @var string
     * @access public
     */
    public $lang_native = 'Сњыур№ёъш';

    /**
     * Some miscellaneous words and language constructs.
     * @var string
     * @access private
     */
    private $_misc_strings = array(
        'deset'=>'фхёхђ',           // "ten"
        'edinadeset'=>'хфшэрфхёхђ', // "eleven"
        'na'=>'эр',                 // liaison particle for 12 to 19
        'sto'=>'ёђю',               // "hundred"
        'sta'=>'ёђр',               // suffix for 2 and 3 hundred
        'stotin'=>'ёђюђшэ',         // suffix for 4 to 9 hundred
        'hiliadi'=>'ѕшыџфш'         // plural form of "thousand"
    );


    /**
     * The words for digits (except zero). Note that, there are three genders for them (neuter, masculine and feminine).
     * The words for 3 to 9 (masculine) and for 2 to 9 (feminine) are the same as neuter, so they're filled
     * in the _initDigits() method, which is invoked from the constructor.
     * @var string
     * @access private
     */
    private $_digits = array(
        0=>array(1=>"хфэю", "фтх", "ђ№ш", "їхђш№ш", "яхђ", "јхёђ", "ёхфхь", "юёхь", "фхтхђ"), // neuter
        1=>array(1=>'хфшэ', 'фтр'),                                                           // masculine
       -1=>array(1=>'хфэр')                                                                   // feminine
    );

    /**
     * A flag, that determines if the _digits array is filled for masculine and feminine genders.
     * @var string
     * @access private
     */
    private $_digits_initialized = false;

    /**
     * A flag, that determines if the "and" word is placed already before the last non-empty group of digits.
     * @var string
     * @access private
     */
    private $_last_and = false;

    /**
     * The word for zero.
     * @var string
     * @access private
     */
    private $_zero = 'эѓыр';

    /**
     * The word for infinity.
     * @var string
     * @access private
     */
    private $_infinity = 'схчъ№рщэюёђ';

    /**
     * The word for the "and" language construct.
     * @var string
     * @access private
     */
    private $_and = 'ш';
    
    /**
     * The word separator.
     * @var string
     * @access private
     */
    private $_sep = ' ';

    /**
     * The word for the minus sign.
     * @var string
     * @access private
     */
    private $_minus = 'ьшэѓё'; // minus sign

    /**
     * The plural suffix (except for thousand).
     * @var string
     * @access private
     */
    private $_plural = 'р'; // plural suffix

    /**
     * The suffixes for exponents (singular).
     * @var array
     * @access private
     */
    private $_exponent = array(
          0 => '',
          3 => 'ѕшыџфр',
          6 => 'ьшышюэ',
          9 => 'ьшышр№ф',
         12 => 'ђ№шышюэ',
         15 => 'ътрф№шышюэ',
         18 => 'ътшэђшышюэ',
         21 => 'ёхъёђшышюэ',
         24 => 'ёхяђшышюэ',
         27 => 'юъђшышюэ',
         30 => 'эюэрышюэ',
         33 => 'фхърышюэ',
         36 => 'ѓэфхърышюэ',
         39 => 'фѓюфхърышюэ',
         42 => 'ђ№хфхърышюэ',
         45 => 'ътрђю№фхърышюэ',
         48 => 'ътшэђфхърышюэ',
         51 => 'ёхъёфхърышюэ',
         54 => 'ёхяђфхърышюэ',
         57 => 'юъђюфхърышюэ',
         60 => 'эютхьфхърышюэ',
         63 => 'тшушэђшышюэ',
         66 => 'ѓэтшушэђшышюэ',
         69 => 'фѓютшушэђшышюэ',
         72 => 'ђ№хтшушэђшышюэ',
         75 => 'ътрђю№тшушэђшышюэ',
         78 => 'ътшэтшушэђшышюэ',
         81 => 'ёхъётшушэђшышюэ',
         84 => 'ёхяђхэтшушэђшышюэ',
         87 => 'юъђютшушэђшышюэ',
         90 => 'эютхьтшушэђшышюэ',
         93 => 'ђ№шушэђшышюэ',
         96 => 'ѓэђ№шушэђшышюэ',
         99 => 'фѓюђ№шушэђшышюэ',
        102 => 'ђ№хђ№шушэђшышюэ',
        105 => 'ътрђю№ђ№шушэђшышюэ',
        108 => 'ътшэђ№шушэђшышюэ',
        111 => 'ёхъёђ№шушэђшышюэ',
        114 => 'ёхяђхэђ№шушэђшышюэ',
        117 => 'юъђюђ№шушэђшышюэ',
        120 => 'эютхьђ№шушэђшышюэ',
        123 => 'ътрф№рушэђшышюэ',
        126 => 'ѓэътрф№рушэђшышюэ',
        129 => 'фѓюътрф№рушэђшышюэ',
        132 => 'ђ№хътрф№рушэђшышюэ',
        135 => 'ътрђю№ътрф№рушэђшышюэ',
        138 => 'ътшэътрф№рушэђшышюэ',
        141 => 'ёхъёътрф№рушэђшышюэ',
        144 => 'ёхяђхэътрф№рушэђшышюэ',
        147 => 'юъђюътрф№рушэђшышюэ',
        150 => 'эютхьътрф№рушэђшышюэ',
        153 => 'ътшэътрушэђшышюэ',
        156 => 'ѓэътшэърушэђшышюэ',
        159 => 'фѓюътшэърушэђшышюэ',
        162 => 'ђ№хътшэърушэђшышюэ',
        165 => 'ътрђю№ътшэърушэђшышюэ',
        168 => 'ътшэътшэърушэђшышюэ',
        171 => 'ёхъёътшэърушэђшышюэ',
        174 => 'ёхяђхэътшэърушэђшышюэ',
        177 => 'юъђюътшэърушэђшышюэ',
        180 => 'эютхьътшэърушэђшышюэ',
        183 => 'ёхъёрушэђшышюэ',
        186 => 'ѓэёхъёрушэђшышюэ',
        189 => 'фѓюёхъёрушэђшышюэ',
        192 => 'ђ№хёхъёрушэђшышюэ',
        195 => 'ътрђю№ёхъёрушэђшышюэ',
        198 => 'ътшэёхъёрушэђшышюэ',
        201 => 'ёхъёёхъёрушэђшышюэ',
        204 => 'ёхяђхэёхъёрушэђшышюэ',
        207 => 'юъђюёхъёрушэђшышюэ',
        210 => 'эютхьёхъёрушэђшышюэ',
        213 => 'ёхяђрушэђшышюэ',
        216 => 'ѓэёхяђрушэђшышюэ',
        219 => 'фѓюёхяђрушэђшышюэ',
        222 => 'ђ№хёхяђрушэђшышюэ',
        225 => 'ътрђю№ёхяђрушэђшышюэ',
        228 => 'ътшэёхяђрушэђшышюэ',
        231 => 'ёхъёёхяђрушэђшышюэ',
        234 => 'ёхяђхэёхяђрушэђшышюэ',
        237 => 'юъђюёхяђрушэђшышюэ',
        240 => 'эютхьёхяђрушэђшышюэ',
        243 => 'юъђюушэђшышюэ',
        246 => 'ѓэюъђюушэђшышюэ',
        249 => 'фѓююъђюушэђшышюэ',
        252 => 'ђ№хюъђюушэђшышюэ',
        255 => 'ътрђю№юъђюушэђшышюэ',
        258 => 'ътшэюъђюушэђшышюэ',
        261 => 'ёхъёюъђюушэђшышюэ',
        264 => 'ёхяђюъђюушэђшышюэ',
        267 => 'юъђююъђюушэђшышюэ',
        270 => 'эютхьюъђюушэђшышюэ',
        273 => 'эюэрушэђшышюэ',
        276 => 'ѓээюэрушэђшышюэ',
        279 => 'фѓюэюэрушэђшышюэ',
        282 => 'ђ№хэюэрушэђшышюэ',
        285 => 'ътрђю№эюэрушэђшышюэ',
        288 => 'ътшээюэрушэђшышюэ',
        291 => 'ёхъёэюэрушэђшышюэ',
        294 => 'ёхяђхээюэрушэђшышюэ',
        297 => 'юъђюэюэрушэђшышюэ',
        300 => 'эютхьэюэрушэђшышюэ',
        303 => 'іхэђшышюэ'
    );
    // }}}

    // {{{ Numbers_Words_bg()

    /**
     * The class constructor, used for calling the _initDigits method.
     *
     * @return void
     *
     * @access public
     * @author Kouber Saparev <kouber@php.net>
     * @see function _initDigits
     */
    public function __construct()
    {
        $this->_initDigits();
    }
    // }}}

    // {{{ _initDigits()

    /**
     * Fills the _digits array for masculine and feminine genders with
     * corresponding references to neuter words (when they're the same).
     *
     * @return void
     *
     * @access private
     * @author Kouber Saparev <kouber@php.net>
     */
    private function _initDigits()
    {
        if (!$this->_digits_initialized) {
            for ($i=3; $i<=9; $i++) {
                $this->_digits[1][$i] =& $this->_digits[0][$i];
            }
            for ($i=2; $i<=9; $i++) {
                $this->_digits[-1][$i] =& $this->_digits[0][$i];
            }
            $this->_digits_initialized = true;
        }
    }
    // }}}

    // {{{ _splitNumber()

    /**
     * Split a number to groups of three-digit numbers.
     *
     * @param mixed $num An integer or its string representation
     *                   that need to be split
     *
     * @return array  Groups of three-digit numbers.
     *
     * @access private
     * @author Kouber Saparev <kouber@php.net>
     * @since  PHP 4.2.3
     */
    private function _splitNumber($num)
    {
        if (is_string($num)) {
            $ret = array();

            $strlen = strlen($num);
            $first  = substr($num, 0, $strlen%3);

            preg_match_all('/\d{3}/', substr($num, $strlen%3, $strlen), $m);

            $ret =& $m[0];
            if ($first) {
                array_unshift($ret, $first); 
            }
            return $ret;
        }
        
        return explode(' ', number_format($num, 0, '', ' ')); // a faster version for integers
    }
    // }}}

    // {{{ _showDigitsGroup()

    /**
     * Converts a three-digit number to its word representation
     * in Bulgarian language.
     *
     * @param integer $num    An integer between 1 and 999 inclusive.
     * @param integer $gender An integer which represents the gender of
     *                                                     the current digits group.
     *                                                     0 - neuter
     *                                                     1 - masculine
     *                                                    -1 - feminine
     * @param boolean $last   A flag that determines if the current digits group
     *                        is the last one.
     *
     * @return string   The words for the given number.
     *
     * @access private
     * @author Kouber Saparev <kouber@php.net>
     */
    private function _showDigitsGroup($num, $gender = 0, $last = false)
    {
        /* A storage array for the return string.
             Positions 1, 3, 5 are intended for digit words
             and everything else (0, 2, 4) for "and" words.
             Both of the above types are optional, so the size of
             the array may vary.
        */
        $ret = array();
        
        // extract the value of each digit from the three-digit number
        $e = $num%10;                  // ones
        $d = ($num-$e)%100/10;         // tens
        $s = ($num-$d*10-$e)%1000/100; // hundreds
        
        // process the "hundreds" digit.
        if ($s) {
            switch ($s) {
            case 1:
                $ret[1] = $this->_misc_strings['sto'];
                break;
            case 2:
            case 3:
                $ret[1] = $this->_digits[0][$s].$this->_misc_strings['sta'];
                break;
            default:
                $ret[1] = $this->_digits[0][$s].$this->_misc_strings['stotin'];
            }
        }

        // process the "tens" digit, and optionally the "ones" digit.
        if ($d) {
            // in the case of 1, the "ones" digit also must be processed
            if ($d==1) {
                if (!$e) {
                    $ret[3] = $this->_misc_strings['deset']; // ten
                } else {
                    if ($e==1) {
                        $ret[3] = $this->_misc_strings['edinadeset']; // eleven
                    } else {
                        $ret[3] = $this->_digits[1][$e].$this->_misc_strings['na'].$this->_misc_strings['deset']; // twelve - nineteen
                    }
                    // the "ones" digit is alredy processed, so skip a second processment
                    $e = 0;
                }
            } else {
                $ret[3] = $this->_digits[1][$d].$this->_misc_strings['deset']; // twenty - ninety
            }
        }

        // process the "ones" digit
        if ($e) {
            $ret[5] = $this->_digits[$gender][$e];
        }

        // put "and" where needed
        if (count($ret)>1) {
            if ($e) {
                $ret[4] = $this->_and;
            } else {
                $ret[2] = $this->_and;
            }
        }

        // put "and" optionally in the case this is the last non-empty group
        if ($last) {
            if (!$s||count($ret)==1) {
                $ret[0] = $this->_and;
            }
            $this->_last_and = true;
        }

        // sort the return array so that "and" constructs go to theirs appropriate places
        ksort($ret);

        return implode($this->_sep, $ret);
    }
    // }}}

    // {{{ toWords()

    /**
     * Converts a number to its word representation
     * in Bulgarian language.
     *
     * @param integer $num An integer between 9.99*-10^302 and 9.99*10^302 (999 centillions)
     *                     that need to be converted to words
     *
     * @return string  The corresponding word representation
     *
     * @access public
     * @author Kouber Saparev <kouber@php.net>
     */
    public function toWords($num = 0)
    {
        $ret = array();

        $ret_minus = '';

        // check if $num is a valid non-zero number
        if (!$num || preg_match('/^-?0+$/', $num) || !preg_match('/^-?\d+$/', $num)) {
            return $this->_zero;
        }

        // add a minus sign
        if (substr($num, 0, 1) == '-') {
            $ret_minus = $this->_minus . $this->_sep;

            $num = substr($num, 1);
        }

        // if the absolute value is greater than 9.99*10^302, return infinity
        if (strlen($num) > 306) {
            return $ret_minus . $this->_infinity;
        }

        // strip excessive zero signs
        $num = ltrim($num, '0');

        // split $num to groups of three-digit numbers
        $num_groups = $this->_splitNumber($num);

        $sizeof_numgroups = count($num_groups);

        // go through the groups in reverse order, so that the last group could be determined
        for ($i=$sizeof_numgroups-1, $j=1; $i>=0; $i--, $j++) {
            if (!isset($ret[$j])) {
                $ret[$j] = '';
            }

            // what is the corresponding exponent for the current group
            $pow = $sizeof_numgroups-$i;

            // skip processment for empty groups
            if ($num_groups[$i]!='000') {
                if ($num_groups[$i]>1) {
                    if ($pow==1) {
                        $ret[$j] .= $this->_showDigitsGroup($num_groups[$i], 0, !$this->_last_and && $i).$this->_sep;
                        $ret[$j] .= $this->_exponent[($pow-1)*3];
                    } elseif ($pow==2) {
                        $ret[$j] .= $this->_showDigitsGroup($num_groups[$i], -1, !$this->_last_and && $i).$this->_sep;
                        $ret[$j] .= $this->_misc_strings['hiliadi'].$this->_sep;
                    } else {
                        $ret[$j] .= $this->_showDigitsGroup($num_groups[$i], 1, !$this->_last_and && $i).$this->_sep;
                        $ret[$j] .= $this->_exponent[($pow-1)*3].$this->_plural.$this->_sep;
                    }
                } else {
                    if ($pow==1) {
                        $ret[$j] .= $this->_showDigitsGroup($num_groups[$i], 0, !$this->_last_and && $i).$this->_sep;
                    } elseif ($pow==2) {
                        $ret[$j] .= $this->_exponent[($pow-1)*3].$this->_sep;
                    } else {
                        $ret[$j] .= $this->_digits[1][1].$this->_sep.$this->_exponent[($pow-1)*3].$this->_sep;
                    }
                }
            }
        }

        return $ret_minus . rtrim(implode('', array_reverse($ret)), $this->_sep);
    }
    // }}}
}
