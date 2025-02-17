<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    // Email recipient
    $to = "sarath.pcet@gmail.com"; // Replace this with your email
    
    // Email subject
    $subject = "New Contact Form Submission from $name";
    
    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n\n";
    $email_content .= "Message:\n$message\n";
    
    // Improved email headers
    $headers = array(
        'From' => 'noreply@' . $_SERVER['HTTP_HOST'], // Uses your domain automatically
        'Reply-To' => $email,
        'X-Mailer' => 'PHP/' . phpversion(),
        'Content-Type' => 'text/plain; charset=UTF-8'
    );
    
    // Convert headers array to string
    $headers_str = '';
    foreach($headers as $key => $value) {
        $headers_str .= "$key: $value\r\n";
    }
    
    // Send email
    if (mail($to, $subject, $email_content, $headers_str)) {
        // Redirect back to the form page with success message
        header("Location: index.html?status=success#contact");
    } else {
        // Redirect back to the form page with error message
        header("Location: index.html?status=error#contact");
    }
} else {
    // Not a POST request, redirect to the main page
    header("Location: index.html");
}
?> 