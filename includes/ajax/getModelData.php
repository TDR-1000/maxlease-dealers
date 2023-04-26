
<?php 
include dirname(__FILE__) . '/../../backoffice/MAXEngine/MAX.php';

$db = app('db');

if(empty($_POST['auto_merk']) || !isset($_POST['auto_merk']) || $_POST['auto_merk'] == "Alles"){
    echo '<option value="">Selecteer eerst een merk</option>';
}else{
$result = $db->select(
  "SELECT DISTINCT `voertuig_basisgegevens_model` FROM `as_voertuig` WHERE `voertuig_basisgegevens_merk` = :merk ORDER BY `voertuig_basisgegevens_model` ASC",
  array ("merk" => $_POST['auto_merk'])
);
$selectShower = '<div class="dropdown bootstrap-select show-tick"><select class="selectpicker show-tick" name="model"><option value="Alles">Alle modellen</option>';
foreach ($result as $modellen) {
    $selectShower .= '<option value="'.$modellen['voertuig_basisgegevens_model'].'">'.$modellen['voertuig_basisgegevens_model'].'</option>';
}
$selectShower .= '</select></div>';

echo $selectShower;
}
?>
