<?php
if(isset($_POST)) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "dkaguta@gmail.com";
    $email_from = "$mail";
    $email_subject = "General feedback from the Website";
 
    $$name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $headers = "From: $email";
 
    $response = array('status' => false, 'message' => array());
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!isset($email) || !preg_match($email_exp,$email)) {
    array_push($response['message'], 'The Email Address you entered does not appear to be valid');
  }
 
  if(!isset($name) || empty($name)) {
    array_push($response['message'], 'The Name you entered does not appear to be valid.');
  }

 
  if(!isset($comments) || empty($comments) || strlen($comments) < 2) {
    array_push($response['message'], 'The Message you entered do not appear to be valid.');
  }
 
	if(!empty($response['message'])) {
		echo json_encode($response);
	} else {
		$email_body = "Form details below.\n\n";
		$email_body .= "Name: ".$name."\n";
		$email_body .= "Email: ".$email."\n";
		$email_body .= "mobile: ".$mobile."\n";
		$email_body .= "Country: ".$country."\n";
		$email_body .= "Comments: ".$comments."\n";

		// create email headers
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		if(mail($email_to, $email_subject, $email_body, $headers)) {
 			$response = array('status' => true, 'message' => 'Thank you for contacting us. We will be in touch with you very soon.');
 			echo json_encode($response);

      Include "index.html";

		} 
	}
 }
?>