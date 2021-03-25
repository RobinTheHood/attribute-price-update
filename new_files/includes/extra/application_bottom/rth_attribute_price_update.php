<?php

if (!defined('MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_STATUS') || MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_STATUS != 'true') {
    return;
}

if (basename($PHP_SELF) != FILENAME_PRODUCT_INFO) {
    return;
}

echo '<script>';
echo file_get_contents('vendor-no-composer/robinthehood/AttributePriceUpdate/JavaScript/AttributePriceUpdate.js');
echo '</script>';
?>

<script>
    $(document).ready(function () {
        var options = {};
        options.priceUpdateMain = <?= MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_PRICE_UPDATE_MAIN; ?>;
        options.priceShowExtra = <?= MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_PRICE_SHOW_EXTRA; ?>;

        options.cssSelectorPriceStd = '<?= MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_CSS_SELECTOR_PRICE_STD; ?>';
        options.cssSelectorPriceNew = '<?= MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_CSS_SELECTOR_PRICE_NEW; ?>';
        options.cssSelectorPriceOld = '<?= MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_CSS_SELECTOR_PRICE_OLD; ?>';
        options.cssSelectorPriceVpe = '<?= MODULE_RTH_ATTRIBUTE_PRICE_UPDATE_CSS_SELECTOR_PRICE_VPE; ?>';

        rthAttributePriceUpdate = new RthAttributePriceUpdate(options);
    });
</script>