<?php

/*
 * This file is part of the Barqrcodewizard Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\BarqrcodewizardBundle\Util;

class DataCallback extends \Controller
{
    /**
     * Object instance (Singleton)
     * @var \DataCallback
     */
    protected static $objInstance;

    /**
     * Calls the data_callback.
     *
     * @access public
     * @param object $objWidget
     * @return string
     */
    public function getData(\Widget $objWidget)
    {
        $arrData = $GLOBALS['TL_DCA'][$objWidget->strTable]['fields'][$objWidget->strField];

        // Trigger the data_callback
        if (is_array($arrData['data_callback'])) {
            $this->import($arrData['data_callback'][0]);

            return $this->$arrData['data_callback'][0]->$arrData['data_callback'][1]($objWidget);
        } elseif (is_callable($arrData['data_callback'])) {
            return $arrData['data_callback']($objWidget);
        }

        return null;
    }

    /**
     * Prevent direct instantiation (Singleton)
     *
     * @return void
     */
    protected function __construct()
    {
    }

    /**
     * Prevent cloning of the object (Singleton)
     *
     * @return void
     */
    final public function __clone()
    {
    }

    /**
     * Instantiate the cache object (Factory)
     *
     * @return \DataCallback The object instance
     */
    public static function getInstance()
    {
        if (static::$objInstance === null) {
            static::$objInstance = new static();
        }

        return static::$objInstance;
    }
}
