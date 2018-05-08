<?php
/* mail action*/


if ($_POST && isset($_FILES['imgup'])) {
   $recipient_email = "test@raving.at"; //recepient

    $from_email = $_POST["userEmail"]; //from email using site domain.
    $subject = "Email with Attachments!"; //email subject line

    $sender_name = filter_var($_POST["userName"], FILTER_SANITIZE_STRING); //capture sender name
    $sender_email = filter_var($_POST["userEmail"], FILTER_SANITIZE_STRING); //capture sender email

    $attachments = $_FILES['imgup'];

    //php validation
    if (strlen($sender_name) < 2) {
        die('Name is too short or empty');
    }
    if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email');
    }
    $sender_message = '<p>';
    $sender_message .= 'Name:' . $sender_name . ' \r\n ';
    $sender_message .= ' Email:' . $sender_email . ' \r\n ';
    $sender_message .= ' Phone:' . $_POST['userPhone'] . ' \r\n ';
    $sender_message .= 'Birthday:' . $_POST['userDob'] . ' \r\n ';
    if (!empty($_POST['faColor'])) {
        $sender_message .= ' Favourite color:' . implode(',', $_POST['faColor']) . ' \r\n ';
    }
    if (!empty($_POST['optradio'])) {
        $sender_message .= '  how do you feel today:' . $_POST['optradio'] . ' \r\n ';
    }

    $sender_message .= '</p>';


    $file_count = count($attachments['name']); //count total files attached
    $boundary = md5("specialToken$4332"); // boundary token to be used

    if ($file_count > 0) { //if attachment exists
        //header
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "From:" . $from_email . "\r\n";
        $headers .= "Reply-To: " . $sender_email . "" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

        //message text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($sender_message));

        //attachments
        for ($x = 0; $x < $file_count; $x++) {
            if (!empty($attachments['name'][$x])) {

                if ($attachments['error'][$x] > 0) { //exit script and output error if we encounter any
                    $mymsg = array(
                        1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
                        2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                        3 => "The uploaded file was only partially uploaded",
                        4 => "No file was uploaded",
                        6 => "Missing a temporary folder");
                    die($mymsg[$attachments['error'][$x]]);


                    //print_r($attachments['error'][$x]);
                }

                //get file info
                $file_name = $attachments['name'][$x];
                $file_size = $attachments['size'][$x];
                $file_type = $attachments['type'][$x];

                //read file 
                $handle = fopen($attachments['tmp_name'][$x], "r");
                $content = fread($handle, $file_size);
                fclose($handle);
                $encoded_content = chunk_split(base64_encode($content)); //split into smaller chunks (RFC 2045)

                $body .= "--$boundary\r\n";
                $body .= "Content-Type: $file_type; name=" . $file_name . "\r\n";
                $body .= "Content-Disposition: attachment; filename=" . $file_name . "\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n";
                $body .= "X-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
                $body .= $encoded_content;
            }
        }
    } else { //send plain email otherwise
        $headers = "From:" . $from_email . "\r\n" .
            "Reply-To: " . $sender_email . "\n" .
            "X-Mailer: PHP/" . phpversion();
        $body = $sender_message;
    }



    $sentMail = @mail($recipient_email, $subject, $body, $headers);
    if ($sentMail) { //output success or failure messages
        $msg = "success";
    } else {
        $msg = "fail";
        // die('Could not send mail! Please check your PHP mail configuration.');
    }
    header('Location:index.php?msg=' . $msg);
}
?>