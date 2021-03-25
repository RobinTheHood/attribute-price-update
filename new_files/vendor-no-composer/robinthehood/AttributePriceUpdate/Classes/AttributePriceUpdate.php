<?php

namespace RobinTheHood\AttributePriceUpdate\Classes;

class AttributePriceUpdate
{
    public static function addJson(&$optionDataColumn, $product, $products_price, $option, $optionPrice)
    {
        global $xtPrice;

        $productId = (int) $product->data['products_id'];
        $productPriceOriginal = $xtPrice->getPprice($productId);
        $productPriceOriginalTaxRate = $xtPrice->TAX[$product->data['products_tax_class_id']];
        $productPriceOriginalWithTax = $xtPrice->xtcAddTax($productPriceOriginal, $productPriceOriginalTaxRate);
        $productPriceOriginalWithTaxFormated = $xtPrice->xtcFormat($productPriceOriginalWithTax, false);

        $vpeUnitName = xtc_get_vpe_name($product->data['products_vpe']);

        $showVpeValue = $product->data['products_vpe_status'] && $product->data['products_vpe_value'];
        $hasOptionVpeValue = $product->data['products_vpe_status'] && (double) $option['attributes_vpe_value'];

        $optionValues = [
            'productId' => $productId,
            'productPriceCurrent' => $products_price,
            'productPriceOriginal' => $productPriceOriginalWithTaxFormated,
            'productVpeValue' => $showVpeValue ? (double) $product->data['products_vpe_value'] : false,
            'productVpeUnitName' => $vpeUnitName ? $vpeUnitName : '',

            'optionPricePrefix' => $option['price_prefix'],
            'optionPriceAddon' => $xtPrice->xtcFormat($optionPrice, false),
            'optionVpeValue' => $hasOptionVpeValue ? (double) $option['attributes_vpe_value'] : false,
            
            'currencyLeft' => $xtPrice->currencies[$_SESSION['currency']]['symbol_left'],
            'currencyRight' => $xtPrice->currencies[$_SESSION['currency']]['symbol_right'],
            'vpeGlue' => TXT_PER,
        ];

        $optionValuesJson = json_encode($optionValues);
        $optionValuesJsonQuoted = str_replace('"', '&quot;', $optionValuesJson);
        $dataAttributWithJson = 'data-rth-attribute-price-update-option-json="' . $optionValuesJsonQuoted . '"';
       
        $optionDataColumn['rthAttributePriceUpdate'] = $dataAttributWithJson;
        $optionDataColumn['rthAttributePriceUpdateJson'] = $optionValuesJson;
    }
}
