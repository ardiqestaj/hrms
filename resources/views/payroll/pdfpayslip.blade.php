<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <style>
        body {
            font-family: sans-serif;
        }

        .company-info {
            display: flex;
            justify-content: space-between;
        }

        ul {
            list-style: none;
            line-height: 1.3;
            padding: 0;
        }

        .general-info-item {
            width: 200px;
        }

        .salery {
            margin-top: 10px;
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;

        }

        table.salery tr {
            border-bottom: 1px solid #ddd;
        }


        .total {
            border-top: 1px solid #111;
        }

        .salery-row-item:not(:first-child) {
            text-align: center;
            line-height: 1.5;
        }



        .salery-header-item {
            text-transform: uppercase;
        }

        .salery-header-item:first-child {
            text-align: start;
            width: 25%;
        }

        tr.salery-row-1>td {
            padding-top: 2em;
        }



        .salery-row-item-2:not(:first-child) {
            text-align: center;
            line-height: 1.5;
        }

    </style>


    <div class="company-info">
        <ul class="company-info-ul">
            <li class="company-info-item">StoreProtect GmbH</li>
            <li class="company-info-item">Walheimstrasse 16</li>
            <li class="company-info-item">3012 Bern</li>
            <li class="company-info-item">031 302 59 56</li>
            <li class="company-info-item">info@storeprotect.ch</li>
        </ul>

        <ul class="employee-info-ul">
            <li class="employee-info-item">Herr</li>
            <li class="employee-info-item">Ivica Trajkovic</li>
            <li class="employee-info-item">Unterer Strassackerweg 27 a</li>
            <li class="employee-info-item">3067 Boll</li>
        </ul>

    </div>

    <div class="general-info">
        <table class="general-info-table">
            <tr class="general-info-tr">
                <td class="general-info-item">Ansterllungskategorie </td>
                <td class="general-info-item">KAT-C 900-</td>
            </tr>
            <tr class="general-info-tr">
                <td class="general-info-item">Ansterllungsort </td>
                <td class="general-info-item">Bern HAO</td>
            </tr>
            <tr class="general-info-tr">
                <td class="general-info-item">Datum </td>
                <td class="general-info-item">22.09.2021</td>
            </tr>
            <tr class="general-info-tr">
                <td class="general-info-item">Personalnr. </td>
                <td class="general-info-item">1399</td>
            </tr>
            <tr class="general-info-tr">
                <td class="general-info-item">Bruto-Std.-Ansatz </td>
                <td class="general-info-item">24.75</td>
            </tr>

            <tr class="general-info-tr">
                <td class="general-info-item"><strong>Lohnabrechnung </strong></td>
                <td class="general-info-item"><strong>August 2021 </strong></td>
            </tr>
            <tr class="general-info-tr">
                <td class="general-info-item"><strong>Periode </strong></td>
                <td class="general-info-item"><strong>01.08.2021 bis 31.08.2021 </strong></td>
            </tr>
        </table>
    </div>


    <div class="salery-calc-table">
        <table class="salery">
            <tr class="salery-header">
                <th class="salery-header-item">Text</th>
                <th class="salery-header-item">Nr.</th>
                <th class="salery-header-item">Anzahl</th>
                <th class="salery-header-item">% +/-</th>
                <th class="salery-header-item">Ansatz</th>
                <th class="salery-header-item">Betrag</th>
            </tr>
            <tr class="salery-row">
                <td class="salery-row-item">Stundenlohn</td>
                <td class="salery-row-item">101</td>
                <td class="salery-row-item">12</td>
                <td class="salery-row-item">100.00</td>
                <td class="salery-row-item">22.85</td>
                <td class="salery-row-item">274.20</td>
            </tr>
            <tr class="salery-row">
                <td class="salery-row-item">Natch- Sonntagszulage</td>
                <td class="salery-row-item">103</td>
                <td class="salery-row-item">20.75</td>
                <td class="salery-row-item">100.00</td>
                <td class="salery-row-item">20.85</td>
                <td class="salery-row-item">474.15</td>
            </tr>
            <tr class="salery-row">
                <td class="salery-row-item">Ferienentschadigung</td>
                <td class="salery-row-item">105</td>
                <td class="salery-row-item"></td>
                <td class="salery-row-item">8.33</td>
                <td class="salery-row-item">748.35</td>
                <td class="salery-row-item">62.35</td>
            </tr>
            <tr class="salery-row">
                <td class="salery-row-item">Ferienentschadigung minus</td>
                <td class="salery-row-item">107</td>
                <td class="salery-row-item">1</td>
                <td class="salery-row-item"></td>
                <td class="salery-row-item"></td>
                <td class="salery-row-item">-62.35</td>
            </tr>
            <tr class="salery-row">
                <td class="salery-row-item">Zeitzuschlag Nacht/Sonntag</td>
                <td class="salery-row-item">117</td>
                <td class="salery-row-item">2.07</td>
                <td class="salery-row-item">100.00</td>
                <td class="salery-row-item">22.85</td>
                <td class="salery-row-item">47.30</td>
            </tr>
            <tr class="salery-row last">
                <td class="salery-row-item">Bruttolohn</td>
                <td class="salery-row-item"></td>
                <td class="salery-row-item"></td>
                <td class="salery-row-item"></td>
                <td class="salery-row-item"></td>
                <td class="salery-row-item total">795.65</td>
            </tr>





            <tr class="salery-row-1">
                <td class="salery-row-item-2">AHW Abzug</td>
                <td class="salery-row-item-2">101</td>
                <td class="salery-row-item-2">12</td>
                <td class="salery-row-item-2">100.00</td>
                <td class="salery-row-item-2">22.85</td>
                <td class="salery-row-item-2">274.20</td>
            </tr>


            <tr class="salery-row-2">
                <td class="salery-row-item-2">ALV Abzug</td>
                <td class="salery-row-item-2">103</td>
                <td class="salery-row-item-2">20.75</td>
                <td class="salery-row-item-2">100.00</td>
                <td class="salery-row-item-2">20.85</td>
                <td class="salery-row-item-2">474.15</td>
            </tr>
            <tr class="salery-row-2">
                <td class="salery-row-item-2">NBU Abzug</td>
                <td class="salery-row-item-2">105</td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2">8.33</td>
                <td class="salery-row-item-2">748.35</td>
                <td class="salery-row-item-2">62.35</td>
            </tr>
            <tr class="salery-row-2">
                <td class="salery-row-item-2">UVG Erganzung Grobfahrlassigkeit</td>
                <td class="salery-row-item-2">107</td>
                <td class="salery-row-item-2">1</td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2">-62.35</td>
            </tr>
            <tr class="salery-row-2">
                <td class="salery-row-item-2">Krankentaggeld</td>
                <td class="salery-row-item-2">117</td>
                <td class="salery-row-item-2">2.07</td>
                <td class="salery-row-item-2">100.00</td>
                <td class="salery-row-item-2">22.85</td>
                <td class="salery-row-item-2">47.30</td>
            </tr>

            <tr class="salery-row-2">
                <td class="salery-row-item-2">GAV Abzug</td>
                <td class="salery-row-item-2">315</td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2">0.015</td>
                <td class="salery-row-item-2">795.65</td>
                <td class="salery-row-item-2">-0.10</td>
            </tr>

            <tr class="salery-row-2 last">
                <td class="salery-row-item-2">Total Abzug</td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2">-69.75</td>
            </tr>

            <tr class="salery-row-2 last">
                <td class="salery-row-item-2">Nettolohn</td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2">795.65</td>
            </tr>
            <tr class="salery-row-2 ">
                <td class="salery-row-item-2">Telefon- und Versandspesen</td>
                <td class="salery-row-item-2">294</td>
                <td class="salery-row-item-2">1</td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2">10.00</td>
                <td class="salery-row-item-2">10.00</td>
            </tr>

            <tr class="salery-row-2 last">
                <td class="salery-row-item-2">Total Auszahlung per 03.09.21
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2"></td>
                <td class="salery-row-item-2">735.90</td>
            </tr>
        </table>

    </div>
</body>

</html>
