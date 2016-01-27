<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package    barqrcodewizard
 * @author     Daniel Kiesel <https://github.com/icodr8>
 * @license    http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @copyright  Daniel Kiesel 2014
 */


/**
 * Namespace
 */
namespace BarQRcode;


/**
 * Load the qrcode library
 */
require_once(TL_ROOT . '/' . BARQRCODEWIZARD_PATH . '/vendor/phpqrcode/qrlib.php');


/**
 * Class QRcodeGenerator
 *
 * @copyright  Daniel Kiesel 2013-2014
 * @author     Daniel Kiesel <https://github.com/icodr8>
 * @package    barqrcodewizard
 */
class QRcodeGenerator extends \Controller
{

    /**
     * generate function.
     *
     * @access public
     * @static
     * @param string $strContent
     * @param mixed $intEclevel (default: QR_ECLEVEL_L)
     * @param int $intSize (default: 3)
     * @param int $intMargin (default: 4)
     * @return string
     */
    public static function generate($strContent, $intEclevel = QR_ECLEVEL_L, $intSize = 3, $intMargin = 4)
    {
        // Handle eclevel
        if (is_string($intEclevel)) {
            switch (strtoupper($intEclevel)) {
                case 'H':
                    $intEclevel = QR_ECLEVEL_H;
                    break;

                case 'Q':
                    $intEclevel = QR_ECLEVEL_Q;
                    break;

                case 'M':
                    $intEclevel = QR_ECLEVEL_M;
                    break;

                default:
                    $intEclevel = QR_ECLEVEL_L;
                    break;
            }
        }

        // Handle size
        if (!is_numeric($intSize) || $intSize < 1 || $intSize > 10) {
            $intSize = 3;
        }

        // Handle margin
        if (!is_numeric($intMargin) || $intMargin < 1 || $intMargin > 10) {
            $intSize = 4;
        }

        // Generate cache key and name
        $strCacheKey = substr(md5($intEclevel . '-' . $intSize . '-' . $intMargin . '-' . $strContent), 0, 8);
        $strCacheName = 'assets/images/' . substr($strCacheKey, -1) . '/' . 'qrcode-' . $strCacheKey . '.png';

        $objFile = \Files::getInstance();
        $objFile->mkdir(dirname($strCacheName));

        // Check, if file doesn't exist already
        if (!file_exists(TL_ROOT . '/' . $strCacheName)) {
            // Generate qrcode png file
            \QRcode::png($strContent, TL_ROOT . '/' . $strCacheName, $intEclevel, $intSize, $intMargin);
        }

        return $strCacheName;
    }


    /**
     * generateHtml function.
     *
     * @access public
     * @static
     * @param string $strContent
     * @param mixed $intEclevel (default: QR_ECLEVEL_L)
     * @param int $intSize (default: 3)
     * @param int $intMargin (default: 4)
     * @return string
     */
    public static function generateHtml($strContent, $intEclevel = QR_ECLEVEL_L, $intSize = 3, $intMargin = 4)
    {
        if ($strContent === null) {
            return '';
        }

        return sprintf('<img src="%s" alt="%s">', self::generate($strContent, $intEclevel, $intSize, $intMargin),
            'QRcode');
    }
}
