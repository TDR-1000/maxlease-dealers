<?php
include dirname(__FILE__) . '/../../backoffice/MAXEngine/MAX.php';

$db = app('db');

if (app('login')->isLoggedIn()) {
  $currentUser = app('current_user');
} else {
  redirect('login');
}

$result = $db->select(
  "SELECT * FROM `as_offerte` WHERE `offerte_id` = :id",
  array ("id" => $_GET['id'])
);
$datum_aanvraag = date("d-m-Y", strtotime($result[0]['timestamp']));
$aanvraag_nr = $result[0]['offerte_id'];

$aanvraag_nr = $result[0]['offerte_id'];
$aanvraag_nr = $result[0]['offerte_id'];
$aanvraag_nr = $result[0]['offerte_id'];
$aanvraag_nr = $result[0]['offerte_id'];
$aanvraag_nr = $result[0]['offerte_id'];
$aanvraag_nr = $result[0]['offerte_id'];

if($result[0]['aanhef'] == 1){
  $aanhef = 'Dhr';
}else if($result[0]['aanhef'] == 2){
  $aanhef = 'Mevr';
}

if($result[0]['voertuig_id'] == 0){
  $merk = $result[0]['merk'];
  $model = $result[0]['model'];
  $kenteken = $result[0]['kenteken'];
  $carrosserie = '';
  $bouwjaar = '';
  $kmstand = '';

  $afbeelding = 'https://cdn.imagin.studio/getImage?customer=img&make='.$result[0]['merk'].'&modelFamily='.$result[0]['model'].'&width=1024&zoomtype=relative&countryCode=NL&licenseplateNumber=MAX&aspectRatio=4:3&margins=0&zoomLevel=60&groundplaneadjustment=0&v3=true&fileType=png&angle=23';
}else{
  $voertuig = $db->select(
    "SELECT * FROM `as_voertuig`,`as_voertuig_media` WHERE `as_voertuig`.`voertuig_basisgegevens_ID` = `as_voertuig_media`.`voertuig_id` AND `as_voertuig_media`.`media_first_photo` = 1 AND `as_voertuig`.`voertuig_basisgegevens_ID` = :id",
    array ("id" => $result[0]['voertuig_id'])
  );

  $merk = $voertuig[0]['voertuig_basisgegevens_merk'];
  $model = $voertuig[0]['voertuig_basisgegevens_model'];
  $kenteken = $voertuig[0]['voertuig_basisgegevens_kenteken'];
  $carrosserie = $voertuig[0]['voertuig_carrosseriegegevens_carrosserie'];
  $bouwjaar = $voertuig[0]['voertuig_historie_bouwjaar_jaar'];
  $kmstand = $voertuig[0]['voertuig_historie_tellerstand_stand'];

  $afbeelding = $voertuig[0]['media_thumbnail_url'];
}

  $prijstotaal = number_format((float)$result[0]['aankoopsom'], 2, ',', '.');
  $berekeningleasebedrag = $result[0]['aankoopsom'] - $result[0]['aanbetaling'];
  
  $aanbetaling = number_format((float)$result[0]['aanbetaling'], 2, ',', '.');
  $slottermijn = number_format((float)$result[0]['slottermijn'], 2, ',', '.');
  
  $berekeningleasebedrag = number_format((float)$result[0]['aankoopsom'], 2, ',', '.');

  $looptijd = $result[0]['looptijd_maanden'].' maanden';
  $afinruil = number_format((float)0, 2, ',', '.');
  $inlossingcontract = number_format((float)0, 2, ',', '.');

  $maandbedrag = number_format((float)$result[0]['maandbedrag'], 2, ',', '.');

$mpdf = new \Mpdf\Mpdf();

$stylesheet = file_get_contents('css/offerte.css');

$mpdf->dpi = 300;
$mpdf->img_dpi = 150;

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/custom/font/directory',
    ]),
    'fontdata' => $fontData + [ 
        'Inter' => [
            'R' => 'fonts/inter.ttf',
            'I' => 'fonts/inter.ttf',
        ]
    ],
    'default_font' => 'Inter'
]);

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->WriteHTML('<div style="position: absolute; right:50px; top: 50px; bottom: 0;">
    <img src="../../images/logo.png"
         style="width: 80px; margin: 0; margin-top:10px; margin-right:10px;" />
</div>');


$mpdf->WriteHTML('<div style="position: absolute; right:50px; top: 140px; bottom: 0; background-color:#ffffff;">
    <img src="https://maxlease.nl/images/uploads/voertuigen/'.$afbeelding.'" style="width: 315px; margin: 0; float:0; background-color:#ffffff;" />
</div>');

$mpdf->WriteHTML('<h4 style="color:#133f8d; margin-bottom:0px;">Offerte</h4><table>
<tr>
<td style="width:150px; margin-left:20px">Kenmerk:</td>
<td>ML'.$aanvraag_nr.'-521 ('.$datum_aanvraag.')</td>
</tr>

</table>');

$mpdf->WriteHTML('<h4 style="color:#133f8d; margin-bottom:0px; margin-top:20px;">Gegevens Voertuig</h4><table>
<tr>
  <td style="width:150px;">Auto:</td>
  <td style="width:180px;"> '.$merk.'</td>
</tr>
<tr>
  <td>Model & uitvoering:</td>
  <td>'.$model.'</td>
</tr>
<tr>
  <td>Kenteken:</td>
  <td>'.$kenteken.'</td>
</tr>
<tr>
  <td>Carrosserie:</td>
  <td>'.$carrosserie.'</td>
</tr>
<tr>
  <td>Bouwjaar:</td>
  <td>'.$bouwjaar.'</td>
</tr>
<tr>
  <td>Km. Stand:</td>
  <td>'.$kmstand.'</td>
</tr>
</table>');

$prijstotaal = number_format((float)$result[0]['aankoopsom'], 2, ',', '.');
$berekeningleasebedrag = $result[0]['aankoopsom'] - $result[0]['aanbetaling'];

$aanbetaling = number_format((float)$result[0]['aanbetaling'], 2, ',', '.');
$slottermijn = number_format((float)$result[0]['slottermijn'], 2, ',', '.');

$leasebedrag = number_format((float)$berekeningleasebedrag, 2, ',', '.');
$totaalbedrag = number_format((float)$result[0]['aankoopsom'], 2, ',', '.');

$looptijd = $result[0]['looptijd_maanden'].' maanden';
$afinruil = number_format((float)0, 2, ',', '.');
$inlossingcontract = number_format((float)0, 2, ',', '.');

$maandbedrag = number_format((float)$result[0]['maandbedrag'], 2, ',', '.');

$mpdf->WriteHTML('<h4 style="color:#133f8d; margin-bottom:0px; margin-top:20px;">Financiering</h4>
<table style="width:100%; border-bottom:0px;">
<tr>
  <td style="width:130px;">Leasebedrag:</td>
  <td style="width:210px;">&euro; '.$leasebedrag.'</td>

  <td style="border-bottom: none;"></td>

  <td>Prijs totaal:</td>
  <td>&euro; '.$totaalbedrag.' <small>('.$result[0]['MargeBTW'].')</small></td>
</tr>
<tr>
  <td>Aanbetaling:</td>
  <td>&euro; '.$aanbetaling.'</td>

  <td style="border-bottom: none;"></td>

  <td>Af inruil:</td>
  <td>&euro; '.$afinruil.'</td>
</tr>
<tr>
  <td>Slottermijn:</td>
  <td>&euro; '.$slottermijn.'</td>

  <td style="border-bottom: none;"></td>

  <td>Inlossing contract:</td>
  <td>&euro; '.$inlossingcontract.'</td>
</tr>
<tr style="border-bottom:0px;">
  <td>Looptijd:</td>
  <td>'.$looptijd.'</td>
  <td style="border-bottom: none;"></td>
  <td style="color:#133f8d; font-weight:500;"><b>Maandbedrag:</b></td>
  <td style="color:#133f8d; font-weight:500; font-size:23px;"><b>&euro; '.$maandbedrag.'</b></td>
</tr>
</table>');


//$mpdf->WriteHTML('<div style="position: absolute; left:35px; right:35px; bottom: 110px; background-color:#f3f5f9; border-radius:8px; width:91%; height:130px;"></div>');
$mpdf->WriteHTML('<h4 style="color:#133f8d; margin-bottom:0px; margin-top:20px;">Bedrijfsgegevens</h4>
<table style="width:100%; border-bottom:0px;">
<tr>
  <td style="width:130px;">Bedrijfsnaam:</td>
  <td style="width:210px;">'.$result[0]['bedrijfsnaam'].'</td>
  <td style="border-bottom: none;"></td>
  <td>KvK:</td>
  <td>'.$result[0]['kvknr'].'</td>
</tr>
<tr>
  <td>Klant:</td>
  <td>'.$aanhef.' '.$result[0]['voorletters'].' '.$result[0]['tussenvoegsel'].' '.$result[0]['achternaam'].'</td>
  <td style="border-bottom: none;"></td>
  <td>E-mail:</td>
  <td>'.$result[0]['email'].'</td>
</tr>

<tr>
  <td>Adres:</td>
  <td>'.$result[0]['straatnaam'].' '.$result[0]['huisnummer'].'</td>
  <td style="border-bottom: none;"></td>
  <td>Telefoonnr:</td>
  <td>'.$result[0]['telefoonnummer'].'</td>
</tr>
<tr>
  <td>Postcode:</td>
  <td>'.$result[0]['postcode'].' - '.$result[0]['plaatsnaam'].'</td>
  <td style="border-bottom: none;"></td>
  <td>Mobiel:</td>
  <td></td>
</tr>
</table>');


$mpdf->WriteHTML('<div style="position: absolute; left:0px; right:0px; bottom: 0px; bottom: 0; background-color:#133f8d; width:90%; padding:30px 30px 30px 50px; color:white; text-align:center;">Max Lease B.V.  •  085 068 5 620  •  info@maxlease.nl  •  Lloydsweg 41, 9641KJ Veendam  •  KVK 85762539</div>');

$mpdf->Output();
