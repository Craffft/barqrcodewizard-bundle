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

use BG\BarcodeBundle\Util\Base2DBarcode;

class QRcode
{
    /*
    DATAMATRIX : Datamatrix (ISO/IEC 16022)
    PDF417 : PDF417 (ISO/IEC 15438:2006) / a,e,t,s,f,o0,o1,o2,o3,o4,o5,o6
    QRCODE : QRcode Low error correction
    QRCODE, L : QRcode Low error correction
    QRCODE, M : QRcode Medium error correction
    QRCODE, Q : QRcode Better error correction
    QRCODE, H : QR-CODE Best error correction
    QR, RAW : raw mode - comma-separad list of array rows
    QR, RAW2 : raw mode - array rows are surrounded by square parenthesis.
    */
    const DATAMATRIX = 'DATAMATRIX';
    const PDF417 = 'PDF417';
    const QRCODE = 'QRCODE';
    const QRCODE_L = 'QRCODE, L';
    const QRCODE_M = 'QRCODE, M';
    const QRCODE_Q = 'QRCODE, Q';
    const QRCODE_H = 'QRCODE, H';
    const QR_RAW = 'QR, RAW';
    const QR_RAW2 = 'QR, RAW2';

    /**
     * @param $strContent
     * @param string $strType
     * @param int $intSize
     * @return string
     * @throws \Exception
     */
    public static function generate($strContent, $strType = self::QRCODE_H, $intSize = 3)
    {
        // Handle size
        if (!is_numeric($intSize) || $intSize < 1 || $intSize > 10) {
            $intSize = 3;
        }

        $strPath = 'qrcode/cache';
        $strAbsolutePath = \System::getContainer()->get('kernel')->getRootDir() . '/../web/' . $strPath . '/';

        $objQrcode = new Base2DBarcode();
        $objQrcode->savePath = $strAbsolutePath;

        $strAbsoluteFilePath = $objQrcode->getBarcodePNGPath($strContent, $strType, $intSize, $intSize);

        $strFile = substr($strAbsoluteFilePath, strlen($strAbsolutePath));

        return $strPath . '/' . $strFile;
    }

    /**
     * @param $strContent
     * @param string $strType
     * @param int $intSize
     * @return string
     */
    public static function generateHtml($strContent, $strType = self::QRCODE_H, $intSize = 3)
    {
        if ($strContent === null) {
            return '';
        }

        return sprintf('<img src="%s" alt="%s">', self::generate($strContent, $strType, $intSize),
            'QRcode');
    }
}
