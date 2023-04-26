<?php
include dirname(__FILE__) . '/../MAX.php';

$db = app('db');

$result = $db->select("SELECT * FROM `as_voertuig_media` WHERE `media_first_photo` = 1 AND `checked` = 0 LIMIT 50");

foreach($result as $voertuig_media) {    

    $url = $voertuig_media['media_original_url'];
    
    $headers = @get_headers($url);
    $mapnaam = str_random();

    if (!file_exists('../../../images/uploads/voertuigen/'.$mapnaam)) {
        mkdir('../../../images/uploads/voertuigen/'.$mapnaam, 0777, true);
    }
    if($headers && strpos( $headers[0], '200')) {
        $status = "URL Exist and image is downloaded<br>";
        copy($voertuig_media['media_original_url'], '../../../images/uploads/voertuigen/'.$mapnaam.'/image1.jpg');

        $sourceFile = '../../../images/uploads/voertuigen/'.$mapnaam.'/image1.jpg';
        $outputFile = '../../../images/uploads/voertuigen/'.$mapnaam.'/image1_thumb.jpg';
        $outputQuality = 40;
        $imageLayer = imagecreatefromjpeg($sourceFile);
        imagejpeg($imageLayer, $outputFile, $outputQuality);

        $db->update(
            'as_voertuig_media',
            array ("img_available" => 1, "media_thumbnail_url" => $mapnaam.'/image1.jpg', "media_image_url" => $mapnaam.'/image1_thumb.jpg',"checked" => 1),
            "voertuig_media_id = :id",
            array("id" => $voertuig_media['voertuig_media_id'])
        );
    }else {
        $status = "URL Doesn't Exist<br>";
        $db->update(
            'as_voertuig_media',
            array ("img_available" => 0,"checked" => 1),
            "voertuig_media_id = :id",
            array("id" => $voertuig_media['voertuig_media_id'])
        );
    }
  
   

   
}

?>