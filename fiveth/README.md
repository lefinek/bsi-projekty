# Podgląd XML z XSLT w `fiveth/`

Docelowy układ (po bożemu):

- `invoice.xml` — plik z danymi (root `<faktura>…</faktura>`) + deklaracja `xml-stylesheet`
- `invoice.xsl` — arkusz XSLT, który generuje HTML i dołącza CSS/JS

Jak używać (bez żadnych dodatkowych plików HTML):

1. Otwórz w przeglądarce przez Apache: `http://localhost/bsi-projekty/fiveth/invoice.xml`
2. Przeglądarka zastosuje `invoice.xsl` zdefiniowany w prologu XML:

```xml
<?xml-stylesheet type="text/xsl" href="invoice.xsl"?>
```

3. CSS i JS dodajesz w arkuszu `invoice.xsl` (wygenerowany HTML):

```html
<link rel="stylesheet" href="style.css" />
<script src="script.js" defer></script>
```

Wskazówki do XSL:

- Używaj XPath w `select` (np. `faktura/uslugi/usluga`).
- `normalize-space()` pomaga czyścić białe znaki.
- Buduj wynik przy pomocy `xsl:template`, `xsl:value-of`, `xsl:for-each`, `xsl:if`/`xsl:choose`.

Uwagi:

- Otwieraj przez Apache (`http://localhost/...`), nie przez `file://`.
- Trzymaj pliki razem w `fiveth/` (łatwe ścieżki względne).
