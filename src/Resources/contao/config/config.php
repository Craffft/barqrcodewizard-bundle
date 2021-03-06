<?php

/*
 * This file is part of the Barqrcodewizard Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Add css file
 */
$GLOBALS['TL_CSS'][] = 'bundles/craffftbarqrcodewizard/barqrcodewizard.css';

/**
 * BACK END FORM FIELDS
 *
 * Back end form fields are stored in a global array called "BE_FFL". You can
 * add your own form fields by adding them to the array.
 *
 * $GLOBALS['BE_FFL'] = array
 * (
 *    'input'  => 'FieldClass1',
 *    'select' => 'FieldClass2'
 * );
 *
 * The keys (like "input") are the field names, which are e.g. stored in the
 * database and used to find the corresponding translations. The values (like
 * "FieldClass1") are the names of the classes, which will be loaded when the
 * field is rendered. The class "FieldClass1" has to be stored in a file named
 * "FieldClass1.php" in your module folder.
 */
$GLOBALS['BE_FFL']['qrcodewizard'] = '\\Craffft\\BarqrcodewizardBundle\\Widget\\QRcodeWizard';
$GLOBALS['BE_FFL']['barcodewizard'] = '\\Craffft\\BarqrcodewizardBundle\\Widget\\BarcodeWizard';
