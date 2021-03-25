<?php

if (!defined('MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_STATUS') || MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_STATUS != 'true') {
    return;
}

function rthAttributePriceUpdate()
{
    global $module_smarty;

    $smarty = new Smarty();
    //$smarty->assign('X', '');

    if (MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_PRICE_SHOW_EXTRA != 'false') {
        $content = $smarty->fetch(CURRENT_TEMPLATE . '/module/rth_attribute_price_update.smarty');
    } else {
        $content = '';
    }

    $module_smarty->assign('RTH_ATTRIBUTE_PRICE_UPDATE', $content);
}

rthAttributePriceUpdate();
