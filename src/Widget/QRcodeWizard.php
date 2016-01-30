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
use Craffft\BarqrcodewizardBundle\Generator\QRcode;
use Craffft\BarqrcodewizardBundle\Util\DataCallback;

class QRcodeWizard extends Widget
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
        $this->strClass = (($this->strClass != '') ? ' ' : '') . 'qrcode';

        return sprintf('<div id="ctrl_%s"%s>%s</div>%s',
            $this->strId,
            (($this->strClass != '') ? ' class="' . $this->strClass . '"' : ''),
            QRcode::generateHtml($this->varValue, QRcode::QRCODE_H, 4),
            $this->wizard);
    }
}
