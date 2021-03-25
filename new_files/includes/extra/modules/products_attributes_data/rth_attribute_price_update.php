<?php

if (!defined('MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_STATUS') || MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_STATUS != 'true') {
    return;
}

use RobinTheHood\AttributePriceUpdate\Classes\AttributePriceUpdate;

require_once DIR_FS_DOCUMENT_ROOT . '/vendor-no-composer/autoload.php';

AttributePriceUpdate::addJson(
    $products_options_data[$row]['DATA'][$col],
    $product,
    $products_price,
    $products_options,
    $price
);
