# Installation
Für die Installation benötigst Du ca. 5 bis 10 Minuten.

## Inhalt
- Das Modul im Adminbereich installieren
- Anpassungen am Template vornehmen
- CSS Selektoren einstellen

## Das Modul im Adminbereich installieren
1. Melde Dich im Adminbereich an.
2. Gehe im Menü zu **Module > System Module**.
3. Wähle dort das Modul **Dynamische Produktpreisberechnung** aus und klicke auf installieren.
4. Lies die Installationsanleitungen der abhängigen Module unter Details (falls vorhanden).

## Anpassungen am Template vornehmen
Dieses Modul benötigt manuelle Änderungen an den folgenden Templatedateien. *(Befinden sich in einem
Verzeichnis mehrere Dateien die Du anpassen kannst, werden diese Dateien in der Liste mit ... aufgelistet.)*

- /templates/*TEMPLATE*/module/product_options/...

### Template: /templates/*TEMPLATE*/module/product_options/...
Damit das Modul auf der Produktdetailseite funktioniert, müssen einige kleine Anpassungen an deinem Template für die Produkt-Optionen gemacht werden.

 - Du musst einmal das Tag-Attribute `rth-attribute-price-update` hinzufügen, damit das Modul deine Attribute/Optionen/Varianten findet.
 - Mit `{$item_data.rthAttributePriceUpdate}` werden die Attribute mit weiteren Informationen im JSON Format angereichert, die der JavaScript-Code im Modul für die Preisberechnung benötigt.

#### Beispiel für ein Option-Template mit Radio-Inputs
In diesem Beispiel bauen wir `rth-attribute-price-update` und `{$item_data.rthAttributePriceUpdate}` in ein Option-Template mit Inputs vom Typ *radio* ein:

##### Vorher
```html
...
{if $options != ''}
    <div ... class="productoptions" ...>
        ...
        <input ... type="radio" ...>
        ...
    </div>
{/if}
...
```

##### Nachher
```html
...
{if $options != ''}
    <div rth-attribute-price-update ... class="productoptions" ...>
        ...
        <input {$item_data.rthAttributePriceUpdate} ... type="radio" ...>
        ...
    </div>
{/if}
...
```

#### Beispiel für ein Option-Template mit einer Select Auswahl
In diesem Beispiel bauen wir `rth-attribute-price-update` und `{$item_data.rthAttributePriceUpdate}` in ein Option-Template mit einer Select Auswahl ein:

##### Vorher
```html
...
{if $options != ''}
    ...
    <select ... name="id[{$options_data.ID}]" ...>
        ...
        <option value="..." ...>
        ...
    </select>
    ...
{/if}
...
```

##### Nachher
```html
...
{if $options != ''}
    ...
    <select rth-attribute-price-update ... name="id[{$options_data.ID}]" ...>
        ...
        <option {$item_data.rthAttributePriceUpdate} value="..." ...>
        ...
    </select>
    ...
{/if}
...
```

Wenn du möchtest, dass noch ein weiteres Extra-Feld angezeigt wird, wo noch einmal der Preis ausgeben wird, kannst du folgendes in die Option-Templates schreiben:

```html
...
{*if $smarty.session.customers_status.customers_status_show_price != 0}
    <div class="rth-attribute-price-update-extra">
        <span>
            {$smarty.const.RTH_ATTRIBUTE_PRICE_UPDATE_TEXT_PRICE_SELECTED}<br>
            {$smarty.const.RTH_ATTRIBUTE_PRICE_UPDATE_TEXT_PRICE_PRO_PRODUCT}
        </span>
        <span class="current-price"></span><br>
        <span class="current-price-vpe"></span>
    </div>
{/if*}
...
```

## CSS Selektoren einstellen
Wenn du kein modified Standard Template verwendest, kann es sein, dass in deinem Template die HTML-Tags für die Preisausgabe im Frontend andere CSS Klassen haben, als die modified Standard Templates. In diesem Fall kannst du in den Einstellungen zum Modul die jeweiligen CSS Selektoren anpassen, damit das Modul die Preisausgabe deines Templates findet und dadurch den Preis dynamisch aktualisieren kann.

---

# Deinstallation
1. Melde Dich im Adminbereich an.
2. Gehe im Menü zu **Module > System Module**.
3. Wähle dort das Modul **Dynamische Produktpreisberechnung** aus und klicke auf deinstallieren.

Bei der Deinstallation werden keine Tabellen in der Datenbank entfernt oder gelöscht und keine Tabellenstrukturen verändert.
