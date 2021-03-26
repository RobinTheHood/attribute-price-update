<?php

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

use RobinTheHood\ModifiedStdModule\Classes\StdModule;

require_once DIR_FS_DOCUMENT_ROOT . '/vendor-no-composer/autoload.php';

class rth_attribute_price_update extends StdModule
{
    public const VERSION = '1.0.0';

    public function __construct()
    {
        $this->init('MODULE_RTH_ATTRIBUTE_PRICE_UPDATE');

        $this->addKey('PRICE_SHOW_EXTRA');
        $this->addKey('PRICE_UPDATE_MAIN');

        $this->addKey('CSS_SELECTOR_PRICE_STD');
        $this->addKey('CSS_SELECTOR_PRICE_NEW');
        $this->addKey('CSS_SELECTOR_PRICE_OLD');
        $this->addKey('CSS_SELECTOR_PRICE_VPE');

        //$this->addAction('update', 'Update');
        $this->checkForUpdate(true);
    }

    public function display()
    {
        return $this->displaySaveButton();
    }

    public function install()
    {
        parent::install();

        $this->addConfigurationSelect('PRICE_SHOW_EXTRA', 'false', 6, 1);
        $this->addConfigurationSelect('PRICE_UPDATE_MAIN', 'false', 6, 1);

        $this->addConfiguration('CSS_SELECTOR_PRICE_STD', '.pd_summarybox .pd_price .standard_price', 6, 1);
        $this->addConfiguration('CSS_SELECTOR_PRICE_NEW', '.pd_summarybox .pd_price .new_price', 6, 1);
        $this->addConfiguration('CSS_SELECTOR_PRICE_OLD', '.pd_summarybox .pd_price .old_price', 6, 1);
        $this->addConfiguration('CSS_SELECTOR_PRICE_VPE', '.pd_summarybox .pd_vpe', 6, 1);
    }

    public function remove()
    {
        parent::remove();
        
        $this->deleteConfiguration('PRICE_SHOW_EXTRA');
        $this->deleteConfiguration('PRICE_UPDATE_MAIN');

        $this->deleteConfiguration('CSS_SELECTOR_PRICE_STD');
        $this->deleteConfiguration('CSS_SELECTOR_PRICE_NEW');
        $this->deleteConfiguration('CSS_SELECTOR_PRICE_OLD');
        $this->deleteConfiguration('CSS_SELECTOR_PRICE_VPE');
    }


    protected function updateSteps()
    {
        $currentVersion = $this->getVersion();
        
        if (!$currentVersion) {
            $this->setVersion('1.0.0');
            return self::UPDATE_SUCCESS;
        }

        // if ($currentVersion == '1.0.0') {
        //     $this->setVersion('1.1.0');
        //     return self::UPDATE_SUCCESS;
        // }
        
        return self::UPDATE_NOTHING;
    }
}
