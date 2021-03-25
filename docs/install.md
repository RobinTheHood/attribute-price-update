# Installation
Für die Installation benötigst Du ca. 5 bis 10 Minuten.

## Inhalt
- Das Modul im Adminbereich installieren
- Anpassungen am Template vornehmen
- Änderungen und neue Dateien

## Das Modul im Adminbereich installieren
1. Melde Dich im Adminbereich an.
2. Gehe im Menü zu **Module > System Module**.
3. Wähle dort das Modul **Dynamische Produktpreisberechnung** aus und klicke auf installieren.
4. Lies die Installationsanleitungen der abhängigen Module unter Details (falls vorhanden).

## Anpassungen am Template vornehmen
Dieses Modul benötigt manuelle Änderungen an den folgenden Templatedateien. *(Befinden sich in einem
Verzeichnis mehrere Dateien die Du anpassen kannst, werden diese Dateien in der Liste mit ... aufgelistet.)*

- /templates/*TEMPLATE*/module/product_options/...

### /templates/*TEMPLATE*/module/product_options/...
Damit das Modul auf der Produktdetailseite funktioniert, müsseb einige kleine Anpassungen an deinem Templates für die Produkt-Optionen gemacht werden. Du musst einmal das Tag-Attribute `rth-attribute-price-update` hinzufügen, damit das Modul deine Varianten findet und mit `{$item_data.rthAttributePriceUpdate}` deine Attribute mit weiteren Informationen anreichern, die das Modul für die Preisberechnung verwenden kann. Das machst du wie folgt:

#### Beispiel 1
In diesem Beispiel bauen wir `rth-attribute-price-update` und `{$item_data.rthAttributePriceUpdate}` in ein Option-Template mit Radio-Inputs ein:

**Vorher**
```html
...
{if $options != ''}
    <div class="productoptions">
        ...
        <input type="radio" ...>
        ...
    </div>
{/if}
...
```

**Nachher**
```html
...
{if $options != ''}
    <div rth-attribute-price-update class="productoptions">
        ...
        <input {$item_data.rthAttributePriceUpdate} type="radio" ...>
        ...
    </div>
{/if}
...
```

#### Beispiel 2
In diesem Beispiel bauen wir `rth-attribute-price-update` und `{$item_data.rthAttributePriceUpdate}` in ein Option-Template mit einer Select Auswahl ein:

**Vorher**
```html
...
{if $options != ''}
    ...
    <select name="id[{$options_data.ID}]">
        ...
        <option value="..." ...>
        ...
    </select>
    ...
{/if}
...
```

**Nachher**
```html
...
{if $options != ''}
    ...
    <select rth-attribute-price-update name="id[{$options_data.ID}]">
        ...
        <option {$item_data.rthAttributePriceUpdate} value="..." ...>
        ...
    </select>
    ...
{/if}
...
```

---

# Deinstallation
1. Melde Dich im Adminbereich an.
2. Gehe im Menü zu **Module > System Module**.
3. Wähle dort das Modul **Dynamische Produktpreisberechnung** aus und klicke auf deinstallieren.

Bei der Deinstallation werden keine Tabellen in der Datenbank entfernt oder gelöscht und keine Tabellenstrukturen verändert.
