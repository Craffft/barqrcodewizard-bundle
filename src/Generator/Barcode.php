<?php

/*
 * This file is part of the Barqrcodewizard Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\BarqrcodewizardBundle\Generator;

use BG\BarcodeBundle\Util\Base1DBarcode;

class Barcode extends \Controller
{
    /**
     * @param $strContent
     * @param int $intHeight
     * @return string
     * @throws \Exception
     */
    public static function generate($strContent, $intHeight = 35)
    {
        // Handle height
        if (!is_numeric($intHeight)) {
            $intHeight = 35;
        }

        $strPath = 'barcode/cache';
        $strAbsolutePath = \System::getContainer()->get('kernel')->getRootDir() . '/../web/' . $strPath . '/';

        $objBarcode = new Base1DBarcode();
        $objBarcode->savePath = $strAbsolutePath;
        $strAbsoluteFilePath = $objBarcode->getBarcodePNGPath($strContent, 'C128', 1.5, $intHeight);

        $strFile = substr($strAbsoluteFilePath, strlen($strAbsolutePath));

        return $strPath . '/' . $strFile;
    }

    /**
     * @param $strContent
     * @param int $intHeight
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
