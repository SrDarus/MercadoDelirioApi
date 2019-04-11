
<?php 

	function entregarResponse($status, $status_messaje, $data){

		header("HTTP/1.1 $status $status_messaje");

		$response['Status'] = $status; 
		$response['Status_messaje'] = $status_messaje;
		$response['Data'] = $data;

		$json_response = json_encode($response);
		echo $json_response;

	}
 ?>