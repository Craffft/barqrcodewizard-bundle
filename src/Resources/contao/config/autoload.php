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
    // Widgets
    'BarQRcode\BarcodeWizard'    => 'vendor/craffft/barqrcodewizard-bundle/src/Resources/contao/widgets/BarcodeWizard.php',
    'BarQRcode\QRcodeWizard'     => 'vendor/craffft/barqrcodewizard-bundle/src/Resources/contao/widgets/QRcodeWizard.php',
));
