<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if ($email) {
        // Receiver's email address
        $to = "bang526726@gmail.com";

        // Prepare the email headers
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8";

        // Email message
        $body = "You have received a new message from $name:\n\n" . $message;

        // Send email to the receiver
        if (mail($to, $subject, $body, $headers)) {
            echo "Message sent to the receiver successfully.";
        } else {
            echo "Failed to send the message to the receiver.";
        }

        // Prepare the acknowledgment email for the sender
        $ackSubject = "Thank you for contacting us!";
        $ackMessage = "Dear $name,\n\nThank you for reaching out. We have received your message:\n\n" . $message . "\n\nWe will get back to you shortly.\n\nBest regards,\nYour Company";

        // Send acknowledgment email to the sender
        if (mail($email, $ackSubject, $ackMessage, $headers)) {
            echo " An acknowledgment email was sent to you.";
        } else {
            echo " Failed to send the acknowledgment email.";
        }
    } else {
        echo "Invalid email address.";
    }
} else {
    echo "Invalid request method.";
}
?>
