<?php


    $rekenRente = 8.9;
    $rekenRente = floatval($rekenRente);
    $prijs = 23716;
    $aanbetaling = 4116;
    $looptijd = 72;
    $slottermijn = 1;

    // Looptijd in maanden
    // rente in percentage 7.99 bijv.

    // HET KREDIET BEDRAG
    $kredietBedrag = $prijs - $aanbetaling;

    // DE NOMINALE MAAND RENTE
    //$nominaleMaandRente = pow(($rente/100)+1,(1/12))-1;
    $nominaleMaandRente = ($rekenRente / 100) / 12;

    // SLOT TERMIJN
    $maandelijkseRenteSlottermijn = $nominaleMaandRente * $slottermijn;

    // VARIABEL KREDIET

    $variabelKrediet = $kredietBedrag - $slottermijn;

    $variabelTermijn = ($nominaleMaandRente / (1 - pow(1 + $nominaleMaandRente, -$looptijd))) * $variabelKrediet;

    // SLOT TERMIJN RENTE PLUS VARIABELTERMIJN
    $leaseBedrag = $variabelTermijn + $maandelijkseRenteSlottermijn;
    $leaseBedrag = $leaseBedrag < 0 ? '&euro; 0' : '&euro; ' . round($leaseBedrag, 2) . ' p/m';

    echo $leaseBedrag;

    ?>