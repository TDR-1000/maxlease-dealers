<?php
if((isset($_GET['postcode']) && !empty($_GET['postcode'])) && (isset($_GET['housenumber']) && !empty($_GET['housenumber']))) {

	// De headers worden altijd meegestuurd als array
	$headers = array();
	$headers[] = 'X-Api-Key: jSA8Ktqy3IS6qSffd8b22ntrE9emlD81M8TtTIR9';
	//https://maps.googleapis.com/maps/api/streetview?size=600x600&location=Golf+Van+riga+4+veendam&key=AIzaSyC2hYy0_8nck9dxdGmXJyj7jfBuMaGE9Xw
	// De URL naar de API call
	$url = 'https://postcode-api.apiwise.nl/v2/addresses/?';

	if (!empty($_GET['postcode']))
		$url .= 'postcode='.$_GET['postcode'];

	if (!empty($_GET['housenumber']))
		$url .= '&number='.$_GET['housenumber'];

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	// Indien de server geen TLS ondersteunt kun je met
	// onderstaande optie een onveilige verbinding forceren.
	// Meestal is dit probleem te herkennen aan een lege response.
	// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	// De ruwe JSON response
	$response = curl_exec($curl);

	// Gebruik json_decode() om de response naar een PHP array te converteren
	$data = json_decode($response);

	$streetparse = str_replace(' ', '+', $data->_embedded->addresses[0]->street);
	$cityparse = str_replace(' ', '+', $data->_embedded->addresses[0]->city->label);
	$postcodeparse = str_replace(' ', '+', $_GET['postcode']);
	$housenumberparse = str_replace(' ', '+', $_GET['housenumber']);

	curl_close($curl);

	// do something
	if (!empty($data->_embedded->addresses)) {
		$street_city['street'] = $data->_embedded->addresses[0]->street;
		$street_city['housenumber'] = $_GET['housenumber'];
		$street_city['postalcode'] = $_GET['postcode'];
		$street_city['city'] = $data->_embedded->addresses[0]->city->label;
		$street_city['image'] = 'https://maps.googleapis.com/maps/api/streetview?size=600x600&location='.$streetparse.'+'.$housenumberparse.'+'.$cityparse.'&key=AIzaSyC2hYy0_8nck9dxdGmXJyj7jfBuMaGE9Xw';
		$street_city['imagebackground'] = 'https://maps.googleapis.com/maps/api/staticmap?center='.$streetparse.'+'.$housenumberparse.'+'.$cityparse.'&zoom=17&scale=2&size=2000x977&maptype=satellite&key=AIzaSyC2hYy0_8nck9dxdGmXJyj7jfBuMaGE9Xw&format=png&visual_refresh=true';
		$street_city['error'] = '';
		$data = json_encode($street_city);
	} else { // data not found
		$street_city['street'] = 'Geen adres gevonden';
		$street_city['city'] = '';
		$street_city['error'] = 'data not found';
		$data = json_encode($street_city);
	}

	echo $data;

}