class RthAttributePriceUpdate {

    constructor(options) {
        this.moduleName = 'rth-attribute-price-update';
        this.moduleSelector = '[rth-attribute-price-update]';
        this.dataName = 'rth-attribute-price-update-option-json';
        this.dataSelector = '[data-rth-attribute-price-update-option-json]';

        this.cssSelectorPriceStd = options.cssSelectorPriceStd; //'.pd_summarybox .pd_price .standard_price';
        this.cssSelectorPriceNew = options.cssSelectorPriceNew; //'.pd_summarybox .pd_price .new_price';
        this.cssSelectorPriceOld = options.cssSelectorPriceOld; //'.pd_summarybox .pd_price .old_price';
        this.cssSelectorPriceVpe = options.cssSelectorPriceVpe; //'.pd_summarybox .pd_vpe';

        this.init(options);
    }

    init(options) {
        var self = this;
        this.calcAll(options);
        $(this.moduleSelector).on('click change', function () {
            self.invoke($(self.dataSelector, this), options);
        });
    }

    calcAll(options) {
        var self = this;
        $(this.moduleSelector).each(function () {
            self.invoke($(self.dataSelector, this), options);
        });
    }

    invoke(element, options) {
        var data = element.data(this.dataName);

        var optionSums = this.calcOptionSums();
        var productPrices = this.calcProductPrices(optionSums, data);

        var formatedCurrentPrice = this.formatPrice(productPrices.currentPrice, data.currencyLeft, data.currencyRight);
        var formatedOriginalPrice = this.formatPrice(productPrices.originalPrice, data.currencyLeft, data.currencyRight);
        var formatedVpePrice = this.formatVpe(productPrices.vpePrice, data.currencyLeft, data.currencyRight, data.productVpeUnitName, data.vpeGlue);

        if (options.priceShowExtra) {
            this.renderExtraPrice(formatedCurrentPrice, formatedOriginalPrice, formatedVpePrice);
        }

        if (options.priceUpdateMain) {
            this.renderPrice(formatedCurrentPrice, formatedOriginalPrice, formatedVpePrice);
        }
    }

    /**
     * Calculates the sums of option prices and vpe values 
     */
    calcOptionSums() {
        var selectors = [
            this.moduleSelector + ' ' + this.dataSelector + ':checked',
            this.moduleSelector + ' ' + this.dataSelector + ':selected'
        ]

        var optionPriceSum = 0;
        var optionVpeValueSum = 0;
        var selector = selectors.join(',');
        var self = this;

        $(selector).each(function() {
            var data = $(this).data(self.dataName);
            
            if (data.optionPriceAddon == 0) {
                return;
            }

            if (data.optionPricePrefix == '-') {
                optionPriceSum -= data.optionPriceAddon;
            } else if (data.optionPricePrefix == '+') {
                optionPriceSum += data.optionPriceAddon;
            }

            optionVpeValueSum += data.optionVpeValue;
        });

        return {
            'optionPriceSum': optionPriceSum,
            'optionVpeValueSum': optionVpeValueSum
        };
    }

    /**
     * Berechnet den neuen Produktpreis
     */
    calcProductPrices(optionSums, optionData) {
        var originalPrice = optionSums.optionPriceSum + optionData.productPriceOriginal;
        var currentPrice = optionSums.optionPriceSum + optionData.productPriceCurrent;
        var vpePrice = currentPrice / (optionData.productVpeValue + optionSums.optionVpeValueSum);

        return {
            'originalPrice': originalPrice,
            'currentPrice': currentPrice,
            'vpePrice': vpePrice
        };
    }

    /**
     * Formats a price
     * Example: 1.666 becomes 1.67
     */
    roundPrice(price) {
        var roundedPrice = Math.round(price * 100) / 100;
        return roundedPrice.toFixed(2);
    }

    /**
     * Rounds price, convert . to , and add left or right symbol
     * 
     * @param int price
     * @param string symbolLeft Examples 'Euro', '€', ...
     * @param string symbolRight Examples 'Euro', '€', ...
     * 
     * @return string Example '8,33 Euro'
     */
    formatPrice(price, symbolLeft, symbolRight) {
        if (symbolLeft) {
            symbolLeft = symbolLeft + '&nbsp;';
        }
        
        if (symbolRight) {
            symbolRight = '&nbsp;' + symbolRight;
        }

        var roundedPrice = this.roundPrice(price);
        var formatedPrice = roundedPrice.toString().replace('.', ',');
        return symbolLeft + formatedPrice + symbolRight;
    }

    /**
     * @param int vpePrice
     * @param string symbolLeft Examples 'Euro', '€', ...
     * @param string symbolRight Examples 'Euro', '€', ...
     * @param string vpeUnitName Examples 'kg', 'Pice', ...
     * @param string vpeGlue word between value and unit. Examples 'pro', 'per', 'la', ...
     * 
     * @return string Example '8,33 Euro pro kg'
     */
    formatVpe(vpePrice, symbolLeft, symbolRight, vpeUnitName, vpeGlue = '') {
        if (!isFinite(vpePrice) || vpePrice < 0) {
            return '';
        }

        if (!vpeUnitName) {
            return '';
        }

        var formatedVpe = this.formatPrice(vpePrice, symbolLeft, symbolRight);
        formatedVpe += vpeGlue + vpeUnitName
        return formatedVpe 
    }

    renderPrice(formatedCurrentPrice, formatedOriginalPrice, formatedVpePrice) {
        var addOns = {
            textOnly: '',
            textInstead: ''
        };

        $(this.cssSelectorPriceStd).html(formatedCurrentPrice);
        $(this.cssSelectorPriceNew).html(addOns.textOnly + formatedCurrentPrice);
        $(this.cssSelectorPriceOld).html(addOns.textInstead + formatedOriginalPrice);
        $(this.cssSelectorPriceVpe).html(formatedVpePrice);
    }

    renderExtraPrice(formatedCurrentPrice, formatedOriginalPrice, formatedVpePrice) {
        $('.rth-attribute-price-update-extra .current-price').html(formatedCurrentPrice);
        $('.rth-attribute-price-update-extra .current-price-vpe').html(formatedVpePrice);
    }
}
