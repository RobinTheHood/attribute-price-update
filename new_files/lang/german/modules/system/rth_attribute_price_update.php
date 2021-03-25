<?php

$moduleType = 'MODULE';
$moduleName = 'RTH_ATTRIBUTE_PRICE_UPDATE';
$prefix = $moduleType . '_' . $moduleName  . '_';

define($prefix . 'TITLE', 'Dynamische Produktpreisberechnung © by <a href="https://robinwieschendorf.de" target="_blank" style="color: #4DCDFF; font-weight: bold;">Robin Wieschendorf</a>');

define($prefix . 'LONG_DESCRIPTION', 'Aktualisiert den Produktpreis im Frontend dynamisch je nach ausgewählter Kombination der Optionen.');

define($prefix . 'STATUS_TITLE', 'Dynamische Produktpreisberechnung Modul aktivieren?');
define($prefix . 'STATUS_DESC', '');

define($prefix . 'PRICE_SHOW_EXTRA_TITLE', 'Zusätzlichen dynamischen Preis anzeigen?');
define($prefix . 'PRICE_SHOW_EXTRA_DESC', 'Ist diese Option aktiv, wird ein weiterer dynamischer Preis angezeigt. Die Option kann verwendet werden, wenn der Hauptpreis nicht aktualisiert angezeigt werden soll.');

define($prefix . 'PRICE_UPDATE_MAIN_TITLE', 'Hauptpreis dynmisch anzeigen?');
define($prefix . 'PRICE_UPDATE_MAIN_DESC', 'Ist diese Option aktiv, wir auch der Hauptpreis dynamisch neu berechnet.');

define($prefix . 'CSS_SELECTOR_PRICE_STD_TITLE', 'CSS Selektor für den Standard Preis');
define($prefix . 'CSS_SELECTOR_PRICE_STD_DESC', 'Standard Selektor ist: .pd_summarybox .pd_price .standard_price');

define($prefix . 'CSS_SELECTOR_PRICE_NEW_TITLE', 'CSS Selektor für den rabattierten Preis');
define($prefix . 'CSS_SELECTOR_PRICE_NEW_DESC', 'Standard Selektor ist: .pd_summarybox .pd_price .new_price');

define($prefix . 'CSS_SELECTOR_PRICE_OLD_TITLE', 'CSS Selektor für den original Preis');
define($prefix . 'CSS_SELECTOR_PRICE_OLD_DESC', 'Standard Selektor ist: .pd_summarybox .pd_price .old_price');

define($prefix . 'CSS_SELECTOR_PRICE_VPE_TITLE', 'CSS Selektor für die VPE');
define($prefix . 'CSS_SELECTOR_PRICE_VPE_DESC', 'Standard Selektor ist: .pd_summarybox .pd_vpe');
