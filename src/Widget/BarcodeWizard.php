<?php

/*
 * This file is part of the Barqrcodewizard Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\BarqrcodewizardBundle\Widget;

use Contao\Widget;
use Craffft\BarqrcodewizardBundle\Generator\Barcode;
use Craffft\BarqrcodewizardBundle\Util\DataCallback;

class BarcodeWizard extends Widget
{
    protected $strTemplate = 'be_widget';

    /**
     * @param mixed $varInput
     * @return mixed
     */
    protected function validator($varInput)
    {
        return parent::validator(trim(DataCallback::getInstance()->getData($this)));
    }

    /**
     * @return string
     */
    public function generate()
    {
        $this->varValue = DataCallback::getInstance()->getData($this);
        $this->strClass = (($this->strClass != '') ? ' ' : '') . 'barcode';

        return sprintf('<div id="ctrl_%s"%s><div>%s<div>%s</div></div></div>%s',
            $this->strId,
            (($this->strClass != '') ? ' class="' . $this->strClass . '"' : ''),
            Barcode::generateHtml($this->varValue),
            $this->varValue,
            $this->wizard);
    }
}
