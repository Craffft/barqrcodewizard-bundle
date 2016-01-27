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
 * Class QRcodeWizard
 *
 * @copyright  Daniel Kiesel 2013-2014
 * @author     Daniel Kiesel <https://github.com/icodr8>
 * @package    barqrcodewizard
 */
class QRcodeWizard extends \Widget
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_widget';


    /**
     * Trim values
     * @param mixed
     * @return mixed
     */
    protected function validator($varInput)
    {
        return parent::validator(trim(DataCallback::getInstance()->getData($this)));
    }


    /**
     * Generate the widget and return it as string
     * @return string
     */
    public function generate()
    {
        // Get data
        $this->varValue = DataCallback::getInstance()->getData($this);

        // Set qrcode class
        $this->strClass = (($this->strClass != '') ? ' ' : '') . 'qrcode';

        return sprintf('<div id="ctrl_%s"%s>%s</div>%s',
            $this->strId,
            (($this->strClass != '') ? ' class="' . $this->strClass . '"' : ''),
            QRcodeGenerator::generateHtml($this->varValue, null, 4, 2),
            $this->wizard);
    }
}
