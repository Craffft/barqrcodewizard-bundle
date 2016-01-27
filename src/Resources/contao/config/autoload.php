<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Barqrcodewizard
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'BarQRcode',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Library
    'BarQRcode\BarcodeGenerator' => 'src/Craffft/BarqrcodewizardBundle/Resources/contao/library/BarQRcode/BarcodeGenerator.php',
    'BarQRcode\DataCallback'     => 'src/Craffft/BarqrcodewizardBundle/Resources/contao/library/BarQRcode/DataCallback.php',
    'BarQRcode\QRcodeGenerator'  => 'src/Craffft/BarqrcodewizardBundle/Resources/contao/library/BarQRcode/QRcodeGenerator.php',

    // Widgets
    'BarQRcode\BarcodeWizard'    => 'src/Craffft/BarqrcodewizardBundle/Resources/contao/widgets/BarcodeWizard.php',
    'BarQRcode\QRcodeWizard'     => 'src/Craffft/BarqrcodewizardBundle/Resources/contao/widgets/QRcodeWizard.php',
));
