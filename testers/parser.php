<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "max";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM wp_postmeta WHERE checked = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $allmeta = unserialize($row['meta_value']);

        unset($allmeta['Voertuig']['Videos']); 

        //var_dump($allmeta);

        //echo htmlspecialchars(json_encode(unserialize($row['meta_value'])));

        $adverteerdernaam_label = htmlspecialchars($allmeta['Adverteerder']['AccountNummer']);
        $adverteerdernummer_label = htmlspecialchars($allmeta['Adverteerder']['AdverteerderNaam']);
        $adverteerderlocatieid_label = htmlspecialchars($allmeta['Adverteerder']['LocatieID']);

        $soortvoertuig_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['SoortVoertuig']);

        $advertentieID_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['SoortVoertuig']);
        $voertuignummer_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['Voertuignummer']);
        $kenteken_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['Kenteken']);
        $merk_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['Merk']);
        $model_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['Model']);

        $Uitvoering_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['Uitvoering']);
        $Type_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['Type']);
        $Brandstof_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['Brandstof']);
        $NieuwVoertuig_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['NieuwVoertuig']);
        $VIN_label = htmlspecialchars($allmeta['Voertuig']['BasisGegevens']['VIN']);

        $Eenheid_label = htmlspecialchars($allmeta['Voertuig']['Historie']['Tellerstand']['Eenheid']);
        $Stand_label = htmlspecialchars($allmeta['Voertuig']['Historie']['Tellerstand']['Stand']);
        $NapWeblabel_label = htmlspecialchars($allmeta['Voertuig']['Historie']['Tellerstand']['NapWeblabel']);

        $Jaar_label = htmlspecialchars($allmeta['Voertuig']['Historie']['Bouwjaar']['Jaar']);
        $DatumDeel1_label = htmlspecialchars($allmeta['Voertuig']['Historie']['Bouwjaar']['DatumDeel1']);
        $DatumDeel1a_label = htmlspecialchars($allmeta['Voertuig']['Historie']['Bouwjaar']['DatumDeel1a']);
        $DatumDeel1b_label = htmlspecialchars($allmeta['Voertuig']['Historie']['Bouwjaar']['DatumDeel1b']);

        $ApkDatum_label = htmlspecialchars($allmeta['Voertuig']['Historie']['ApkDatum']);
        $Onderhoudboekjes_label = htmlspecialchars($allmeta['Voertuig']['Historie']['Onderhoudboekjes']);
        $DatumBinnenkomst_label = htmlspecialchars($allmeta['Voertuig']['Historie']['DatumBinnenkomst']);
        $FabrieksgarantieTot_label = htmlspecialchars($allmeta['Voertuig']['Historie']['FabrieksgarantieTot']);

        $BTW_label = htmlspecialchars($allmeta['Voertuig']['Financieel']['BTW']);
        $VerkoopPrijs_label = htmlspecialchars($allmeta['Voertuig']['Financieel']['VerkoopPrijs']);
        $PrijsInExBTW_label = htmlspecialchars($allmeta['Voertuig']['Financieel']['PrijsInExBTW']);
        $BPMBedrag_label = htmlspecialchars($allmeta['Voertuig']['Financieel']['BPMBedrag']);
        $KostenRijklaar_label = htmlspecialchars($allmeta['Voertuig']['Financieel']['KostenRijklaar']);
        $WegenbelastingKwartaal_min_label = htmlspecialchars($allmeta['Voertuig']['Financieel']['WegenbelastingKwartaal']['Min']);
        $WegenbelastingKwartaal_max_label = htmlspecialchars($allmeta['Voertuig']['Financieel']['WegenbelastingKwartaal']['Max']);
        $BijtellingsPercentage_label = htmlspecialchars($allmeta['Voertuig']['Financieel']['BijtellingsPercentage']);

        $GemiddeldVerbruik_label = htmlspecialchars($allmeta['Voertuig']['Milieu']['GemiddeldVerbruik']);
        $VerbruikStad_label = htmlspecialchars($allmeta['Voertuig']['Milieu']['VerbruikStad']);
        $VerbruikSnelweg_label = htmlspecialchars($allmeta['Voertuig']['Milieu']['VerbruikSnelweg']);
        $CO2Uitstoot_label = htmlspecialchars($allmeta['Voertuig']['Milieu']['CO2Uitstoot']);
        $Emissieklasse_label = htmlspecialchars($allmeta['Voertuig']['Milieu']['Emissieklasse']);
        $EnergieLabel_label = htmlspecialchars($allmeta['Voertuig']['Milieu']['EnergieLabel']);

        $Carrosserie_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Carrosserie']);
        $AantalDeuren_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['AantalDeuren']);
        $AantalZitplaatsen_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['AantalZitplaatsen']);
        $Kleur_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Kleur']);
        $LakSoort_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['LakSoort']);
        $BasisKleur_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['BasisKleur']);
        $Massa_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Massa']);
        $MaxTrekgewicht_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['MaxTrekgewicht']);
        $MaxTrekgewichtOngeremd_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['MaxTrekgewichtOngeremd']);
        $InterieurKleur_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['InterieurKleur']);

        $Bekleding_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Bekleding']);
        $AantalSleutels_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['AantalSleutels']);
        $AantalHandzenders_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['AantalHandzenders']);
        $Wielbasis_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Wielbasis']);
        $Laadvermogen_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Laadvermogen']);
        $Gvw_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Gvw']);
        $AantalAssen_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['AantalAssen']);
        $Lengte_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Lengte']);
        $Breedte_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Breedte']);
        $Hoogte_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['Hoogte']);

        $MaxDakbelasting_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['MaxDakbelasting']);
        $InhoudLaadruimteBankenWeggeklapt_label = htmlspecialchars($allmeta['Voertuig']['CarrosserieGegevens']['InhoudLaadruimteBankenWeggeklapt']);

        $Transmissie_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['Transmissie']);
        $AantalVersnellingen_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['AantalVersnellingen']);
        $CilinderAantal_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['CilinderAantal']);
        $CilinderInhoud_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['CilinderInhoud']);
        $VermogenMotorKW_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['VermogenMotorKW']);
        $VermogenMotorPK_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['VermogenMotorPK']);
        $TopSnelheid_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['TopSnelheid']);
        $TankInhoud_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['TankInhoud']);
        $ActieRadius_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['ActieRadius']);
        $Acceleratie_label = htmlspecialchars($allmeta['Voertuig']['TechischeGegevens']['Acceleratie']);

        if(isset($allmeta['Voertuig']['Accessoires']['comfort'])){
           $Acomfort_label = htmlspecialchars(implode(" , ",$allmeta['Voertuig']['Accessoires']['comfort']));
        }else{
           $Acomfort_label = NULL;
        }

        if(isset($allmeta['Voertuig']['Accessoires']['exterieur'])){
           $Aexterieur_label = htmlspecialchars(implode(" , ",$allmeta['Voertuig']['Accessoires']['exterieur']));
        }else{
           $Aexterieur_label = NULL;
        }

        if(isset($allmeta['Voertuig']['Accessoires']['infotainment'])){
           $Ainfotainment_label = htmlspecialchars(implode(" , ",$allmeta['Voertuig']['Accessoires']['infotainment']));
        }else{
           $Ainfotainment_label = NULL;
        }

        if(isset($allmeta['Voertuig']['Accessoires']['interieur'])){
           $Ainterieur_label = htmlspecialchars(implode(" , ",$allmeta['Voertuig']['Accessoires']['interieur']));
        }else{
           $Ainterieur_label = NULL;
        }

        if(isset($allmeta['Voertuig']['Accessoires']['Milieu'])){
           $AMilieu_label = htmlspecialchars(implode(" , ",$allmeta['Voertuig']['Accessoires']['Milieu']));
        }else{
           $AMilieu_label = NULL;
        }

        if(isset($allmeta['Voertuig']['Accessoires']['Veiligheid'])){
           $AVeiligheid_label = htmlspecialchars(implode(" , ",$allmeta['Voertuig']['Accessoires']['Veiligheid']));
        }else{
           $AVeiligheid_label = NULL;
        }

        if(isset($allmeta['Voertuig']['Accessoires']['Overige'])){
           $AOverige_label = htmlspecialchars(implode(" , ",$allmeta['Voertuig']['Accessoires']['Overige']));
        }else{
           $AOverige_label = NULL;
        }

        if(isset($allmeta['Voertuig']['Accessoires']['Overige'])){
           $AOverige_label = htmlspecialchars(implode(" , ",$allmeta['Voertuig']['Accessoires']['Overige']));
        }else{
           $AOverige_label = NULL;
        }

        if(isset($allmeta['Voertuig']['Afbeeldingen'])){
            $afbeeldingen = implode(" , ",$allmeta['Voertuig']['Afbeeldingen']);
         }else{
            $afbeeldingen = NULL;
         }



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8888/api/v1/data/object',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "voertuig_data": {
    "adverteerder": [
      {
        "naam": "'.$adverteerdernaam_label.'",
        "nummer": "'.$adverteerdernummer_label.'",
        "locatieID": "'.$adverteerderlocatieid_label.'"
      }
    ],
    "voertuig": [
      {
        "advertentieID": "'.$advertentieID_label.'",
        "basisgegevens": {
          "soortvoertuig": "'.$soortvoertuig_label.'",
          "voertuignummer": "'.$voertuignummer_label.'",
          "kenteken": "'.$kenteken_label.'",
          "merk": "'.$merk_label.'",
          "model": "'.$model_label.'",
          "uitvoering": "'.$Uitvoering_label.'",
          "type": "'.$Type_label.'",
          "brandstof": "'.$Brandstof_label.'",
          "nieuwvoertuig": "'.$NieuwVoertuig_label.'",
          "VIN": "'.$VIN_label.'"
        },
        "historie": {
          "tellerstandEenheid": "'.$Eenheid_label.'",
          "tellerstandStand": "'.$Stand_label.'",
          "tellerstandNapWebLabel": "'.$NapWeblabel_label.'",
          "bouwjaarJaar": "'.$Jaar_label.'",
          "bouwjaarDatumdeel1": "'.$DatumDeel1_label.'",
          "bouwjaarDatumdeel1a": "'.$DatumDeel1a_label.'",
          "bouwjaarDatumdeel1b": "'.$DatumDeel1b_label.'",
          "APKDatum": "'.$ApkDatum_label.'",
          "onderhoudboekjes": "'.$Onderhoudboekjes_label.'",
          "datumBinnenkomst": "'.$DatumBinnenkomst_label.'",
          "fabrieksgarantieTot": "'.$FabrieksgarantieTot_label.'"
        },
        "financieel": {
          "BTW": "'.$BTW_label.'",
          "verkoopPrijs": "'.$VerkoopPrijs_label.'",
          "prijsInExBTW": "'.$PrijsInExBTW_label.'",
          "BPMbedrag": "'.$BPMBedrag_label.'",
          "kostenRijklaar": "'.$KostenRijklaar_label.'",
          "wegenbelastingKwartaalMin": "'.$WegenbelastingKwartaal_min_label.'",
          "wegenbelastingKwartaalMax": "'.$WegenbelastingKwartaal_max_label.'",
          "bijtellingspercentage": "'.$BijtellingsPercentage_label.'"
        },
        "milieu": {
          "gemiddeldVerbruik": "'.$GemiddeldVerbruik_label.'",
          "verbruikStad": "'.$VerbruikStad_label.'",
          "verbruikSnelweg": "'.$VerbruikSnelweg_label.'",
          "CO2uitstoot": "'.$CO2Uitstoot_label.'",
          "emissieKlasse": "'.$Emissieklasse_label.'",
          "energielabel": "'.$EnergieLabel_label.'"
        },
        "carrosserieGegevens": {
          "carrosserie": "'.$Carrosserie_label.'",
          "aantalDeuren": "'.$AantalDeuren_label.'",
          "aantalZitplaatsen": "'.$AantalZitplaatsen_label.'",
          "kleur": "'.$Kleur_label.'",
          "lakSoort": "'.$LakSoort_label.'",
          "basisKleur": "'.$BasisKleur_label.'",
          "massa": "'.$Massa_label.'",
          "maxTrekGewicht": "'.$MaxTrekgewicht_label.'",
          "maxTrekGewichtOngeremd": "'.$MaxTrekgewichtOngeremd_label.'",
          "interieurKleur": "'.$InterieurKleur_label.'",
          "bekleding": "'.$Bekleding_label.'",
          "aantalSleutels": "'.$AantalSleutels_label.'",
          "aantalHandzenders": "'.$AantalHandzenders_label.'",
          "wielbasis": "'.$Wielbasis_label.'",
          "laadvermogen": "'.$Laadvermogen_label.'",
          "GVW": "'.$Gvw_label.'",
          "aantalAssen": "'.$AantalAssen_label.'",
          "lengte": "'.$Lengte_label.'",
          "breedte": "'.$Breedte_label.'",
          "hoogte": "'.$Hoogte_label.'",
          "maxDakBelasting": "'.$MaxDakbelasting_label.'",
          "inhoudLaadruimteBankenWeggeklapt": "'.$InhoudLaadruimteBankenWeggeklapt_label.'"
        },
        "techischeGegevens": {
          "transmissie": "'.$Transmissie_label.'",
          "aantalVersnellingen": "'.$AantalVersnellingen_label.'",
          "cilinderAantal": "'.$CilinderAantal_label.'",
          "cilinderInhoud": "'.$CilinderInhoud_label.'",
          "vermogenMotorKW": "'.$VermogenMotorKW_label.'",
          "vermogenMotorPK": "'.$VermogenMotorPK_label.'",
          "topsnelheid": "'.$TopSnelheid_label.'",
          "tankInhoud": "'.$TankInhoud_label.'",
          "actieradius": "'.$ActieRadius_label.'",
          "acceleratie": "'.$Acceleratie_label.'"
        }
      }
    ],
    "accessoires": [
      {
        "comfort": "'.$Acomfort_label.'",
        "exterieur": "'.$Aexterieur_label.'",
        "infotainment": "'.$Ainfotainment_label.'",
        "interieur": "'.$Ainterieur_label.'",
        "Milieu": "'.$AMilieu_label.'",
        "Veiligheid": "'.$AVeiligheid_label.'",
        "Overige": "'.$AOverige_label.'"
      }
    ],
    "media": {
        "afbeeldingen": "'.$afbeeldingen.'"
    }
  }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'AUTH: El0JZuACUYQQNGt4RYhMXnO4INpAn1'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

$sql = "UPDATE wp_postmeta SET checked='1' WHERE meta_id=".$row['meta_id'];

if ($conn->query($sql) === TRUE) {

} else {
  echo "Error updating record: " . $conn->error;
}

    }
} else {
 
}
$conn->close();
