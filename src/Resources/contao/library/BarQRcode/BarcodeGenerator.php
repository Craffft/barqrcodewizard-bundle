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
require_once(TL_ROOT . '/' . BARQRCODEWIZARD_PATH . '/vendor/barcode/BarcodeBase.php');
require_once(TL_ROOT . '/' . BARQRCODEWIZARD_PATH . '/vendor/barcode/Code128.php');


/**
 * Class BarcodeGenerator
 *
 * @copyright  Daniel Kiesel 2013-2014
 * @author     Daniel Kiesel <https://github.com/icodr8>
 * @package    barqrcodewizard
 */
class BarcodeGenerator extends \Controller
{

    /**
     * Returns the barcode url.
     *
     * @access public
     * @static
     * @param string $strContent
     * @param int $intWidth (default: 300)
     * @param int $intHeight (default: 100)
     * @return string
     */
    public static function generate($strContent, $intHeight = 35)
    {
        // Handle height
        if (!is_numeric($intHeight)) {
            $intHeight = 25;
        }

        // Generate cache key and name
        $strCacheKey = substr(md5($intWidth . '-' . $intHeight . '-' . $strContent), 0, 8);
        $strCacheName = 'assets/images/' . substr($strCacheKey, -1) . '/' . 'barcode-' . $strCacheKey . '.png';

        $objFile = \Files::getInstance();
        $objFile->mkdir(dirname($strCacheName));

        // Check, if file doesn't exist already
        if (!file_exists(TL_ROOT . '/' . $strCacheName)) {
            // Generate qrcode png file
            $objCode128 = new \emberlabs\Barcode\Code128();
            $objCode128->setData($strContent);
            $objCode128->setDimensions(0, $intHeight);
            $objCode128->draw();
            $objCode128->save(TL_ROOT . '/' . $strCacheName);
        }

        return $strCacheName;
    }


    /**
     * Returns the html tag to embed the barcode.
     *
     * @access public
     * @static
     * @param string $strContent
     * @param int $intWidth (default: 300)
     * @param int $intHeight (default: 100)
     * @return string
     */
    public static function generateHtml($strContent, $intHeight = 35)
    {
        if ($strContent === null) {
            return '';
        }

        return sprintf('<img src="%s" alt="%s">', self::generate($strContent, $intHeight), 'Barcode');
    }
}
