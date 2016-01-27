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
 * Class DataCallback
 *
 * @copyright  Daniel Kiesel 2013-2014
 * @author     Daniel Kiesel <https://github.com/icodr8>
 * @package    barqrcodewizard
 */
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
            return $arrData['data_callback']($this);
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
