<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" encoding="UTF-8" indent="yes" />
  <xsl:decimal-format name="pl" decimal-separator="," grouping-separator=" " />
  <xsl:template match="/">
    <html lang="pl">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>XML generator</title>
        <link rel="stylesheet" href="style.css" />
      </head>
      <body>
        <div class="container">
            <div class="back">
                <p>Powrót</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#4b7eec" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </div>
            <div class="content">
                <img src="faktura.png" class="form-image"/>
                <div class="form-field invoice-number"><xsl:value-of select="normalize-space(faktura/numer_faktury)"/></div>
                <div class="form-field invoice-place"><xsl:value-of select="normalize-space(faktura/miejsce_wystawienia)"/></div>
                <div class="form-field invoice-date"><xsl:value-of select="normalize-space(faktura/data_wystawienia)"/></div>
                <div class="form-field invoice-payment-term"><xsl:value-of select="normalize-space(faktura/termin_platnosci)"/></div>
                <div class="form-field invoice-payment-method"><xsl:value-of select="normalize-space(faktura/forma_platnosci)"/></div>
                <div class="form-field invoice-issue-date"><xsl:value-of select="normalize-space(faktura/data_wykonania)"/></div>
                <div class="form-column seller">
                    <xsl:for-each select="faktura/sprzedawca/*">
                        <div class="column-item"><xsl:value-of select="normalize-space(.)"/></div>
                    </xsl:for-each>
                </div>
                <div class="form-column buyer">
                    <xsl:for-each select="faktura/nabywca/*">
                        <div class="column-item"><xsl:value-of select="normalize-space(.)"/></div>
                    </xsl:for-each>
                </div>
                
                <div class="form-row bank-account">
                    <xsl:for-each select="faktura/konto/*">
                        <div class="row-item"><xsl:value-of select="normalize-space(.)"/></div>
                    </xsl:for-each>
                </div>
                <div class="services">
                    <xsl:for-each select="faktura/uslugi/usluga">
                        <div class="service">
                            <div class="cell"><xsl:value-of select="normalize-space(nazwa)"/></div>
                            <div class="cell"><xsl:value-of select="normalize-space(ilosc)"/></div>
                            <div class="cell"><xsl:value-of select="normalize-space(cena_jednostkowa)"/></div>
                            <div class="cell"><xsl:value-of select="normalize-space(cena_jednostkowa)"/></div>
                            <div class="cell"><xsl:value-of select="normalize-space(stawka_VAT)"/></div>
                            <div class="cell"><xsl:value-of select="normalize-space(format-number(wartosc - cena_jednostkowa, '0.00'))"/></div>
                            <div class="cell"><xsl:value-of select="normalize-space(wartosc)"/></div>
                        </div>
                    </xsl:for-each>
                </div>
                <div class="form-field invoice-total-netto">
                  <xsl:value-of select="format-number(sum(faktura/uslugi/usluga/cena_jednostkowa), '0.00')" />
                </div>
                <div class="form-field invoice-total-vat">
                  <xsl:value-of select="format-number(sum(faktura/uslugi/usluga/wartosc) - sum(faktura/uslugi/usluga/cena_jednostkowa), '0.00')" />
                </div>
                <div class="form-field invoice-total">
                  <xsl:value-of select="format-number(sum(faktura/uslugi/usluga/wartosc), '0.00')" />
                </div>
                <div class="form-field invoice-notes"><xsl:value-of select="normalize-space(faktura/uwagi)"/></div>
                <div class="form-field invoice-issuer"><xsl:value-of select="normalize-space(faktura/wystawiajacy)"/></div>
            </div>
            <div class="about">
                <h2>Jakub Strzelczak</h2>
                <p>Numer albumu: 227684</p>
                <h4>listopad 2025</h4>
            </div>
        </div>
        <script src="script.js"></script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
