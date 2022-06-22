<!DOCTYPE html>
<html lang="de-CH">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="templates/style.css">
  <?php
  if(file_exists('templates/'. CLIENT_TEMPLATE .'/style.css')) {
    echo '<link rel="stylesheet" href="templates/'. CLIENT_TEMPLATE .'/style.css">';
  }
  ?>

  <title>eFattura - Prevista fattura <?php echo INV_NUMBER; ?></title>
</head>
<body>
  
<a href="index.php" class="btn">Ritorna</a>
<div class="content">
  <div class="sender sp-y-s">
    <p class="sender__postal-address">
      <?php echo USER_DISPLAY_NAME .'<br>'. USER_STREET .', '. USER_STREET_NR .'<br>'. USER_CAP .' '. USER_CITY .'('. USER_STATE .')'; ?>
    </p>
    <p class="sender__contact">
      <?php echo USER_TEL .'<br>'. USER_EMAIL; ?>
    </p>
    <div class="sender__tax-number flex flex--pos-x-start">
      <p class="col2">
        Partita IVA:<br>
        Codice Fiscale:
      </p>
      <p>
        <?php echo USER_VAT_NR .'<br>'. USER_CF; ?>
      </p>
    </div>
  </div>
  <div class="recipient sp-y-s">
    <p class="recipient__postal-address">
      <strong><?php echo CLIENT_DISPLAY_NAME; ?></strong><br>
      <?php echo CLIENT_STREET .' '. CLIENT_STREET_NR; ?><br>
      <?php echo CLIENT_COUNTRY_CODE .' - '. CLIENT_CAP .' '. CLIENT_CITY; ?>
    </p>
    <p class="recipient__tax-number">
      UID: <?php echo CLIENT_VAT_NR; ?>
    </p>
  </div>
  <div class="invoice">
    <div class="invoice__date flex flex--pos-x-start">
      <p class="col2">
        Datum/Data:
      </p>
      <p>
        <?php echo date('d.m.Y', strtotime(INV_DATE)); ?>
      </p>
    </div>
    <div class="invoice__number flex flex--pos-x-start sp-y-s">
      <p class="col2">
      Rechnung/Fattura:
      </p>
      <p>
        <?php echo INV_NUMBER; ?>
      </p>
    </div>
    <div class="invoice__content">
      <h1>Rechnung/Fattura</h1>
      <table class="table sp-y-m">
        <thead>
          <tr>
            <th colspan="2" align="left">Beschreibung der Tätigkeit/Descrizione prestazione</th>
            <th colspan="2" align="right">Betrag/Importo</th>
          </tr>
          <tr class="table__header-subtitle">
            <th colspan="2"></th>
            <th align="right" class="text-small"><?php echo '['. INV_CURRENCY .']'; ?></th>
            <th align="right" class="text-small">[EUR]</th>
          </tr>
        </thead>
        <tbody>
          <!-- list of items -->
          <?php
          $i = 0;
          while($i < count(ITEMS_QUERY)):
            $i = $i + 1;
            $item_query = ITEMS_QUERY[$i-1];
            ?>
            <tr>
              <td colspan="2"><?php echo $item_query['item_description']; ?></td>
              <td align="right"><?php echo INV_CURRENCY .' '. number_format($item_query['item_total'], 2, '.', ''); ?></td>
              <td align="right"><?php echo 'EUR '. number_format(($item_query['item_total'] * INV_EXCHANGE_RATE), 2, '.', ''); ?></td>
            </tr>
          <?php endwhile; ?>
          <tr class="sp-row-1">
            <td colspan="2">Summe/Imponibile</td>
            <td align="right" class="border-bottom"><?php echo INV_CURRENCY .' '. number_format(INV_SUBTOTAL, 2, '.', ''); ?></td>
            <td align="right" class="border-bottom"><?php echo 'EUR '. number_format((INV_SUBTOTAL * INV_EXCHANGE_RATE), 2, '.', ''); ?></td>
          </tr>
          <tr class="sp-row-05">
            <td>Sozialversicherung/Rivalsa INPS</td>
            <td><?php echo INV_PROVISION .'%'; ?></td>
            <td align="right"><?php echo INV_CURRENCY .' '. number_format((INV_SUBTOTAL / 100 * INV_PROVISION), 2, '.', ''); ?></td>
            <td align="right"><?php echo 'EUR '. number_format(((INV_SUBTOTAL / 100 * INV_PROVISION) * INV_EXCHANGE_RATE), 2, '.', ''); ?></td>
          </tr>
          <tr class="sp-row-05">
            <td colspan="2"><strong>Totalbetrag/Importo totale</strong></td>
            <td align="right" class="border-bottom-double"><strong><?php echo INV_CURRENCY .' '. number_format(INV_TOTAL_ROUNDED, 0, '.', ''); ?></strong></td>
            <td align="right" class="border-bottom-double"><strong><?php echo 'EUR '. number_format((INV_TOTAL_ROUNDED * INV_EXCHANGE_RATE), 0, '.', ''); ?></strong></td>
          </tr>
          <tr class="text-grey text-small sp-row-05">
            <td>Wechselkurs/Tasso di cambio CHF > EUR</td>
            <td><?php echo number_format(INV_EXCHANGE_RATE, 4, '.', ''); ?></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <div class="invoice__payment">
        <p>Banküberweisung per IBAN: IT34 P 05018 11800 000017081209 (Banca Popolare Etica)</p>
      </div>
      <div class="invoice__regime">
        <div class="msg msg--grey">
          <p class="text-center">Operazione in franchigia da Iva art. 1 cc. 54-89 L. 190/2014 – Non soggetta a ritenuta d&apos;acconto ai sensi del c. 67 L. 190/2014</p>
        </div>
      </div>
    </div>
  </div>
  <footer class="flex">
    <p class="text-grey text-small"><?php echo USER_DISPLAY_NAME .' // '. USER_STREET .', '. USER_STREET_NR .' // '. USER_CAP .' '. USER_CITY .' // '. USER_TEL .' // '. USER_EMAIL .' // '. USER_WEB; ?></p>
    <p><span data-page="cur">1</span>/<span data-page="total">1</span></p>
  </footer>
</div>
</body>
</html>