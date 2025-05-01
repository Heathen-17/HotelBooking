<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject'])) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $conn = new mysqli("localhost", "root", "", "Hotelreservation");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("INSERT INTO userqueries(name, email, subject) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $subject);

            if ($stmt->execute()) {
                echo "<script>alert('Message sent successfully!');</script>";
                echo "<script>window.location.href=window.location.href;</script>";
            } else {
                echo "<script>alert('Error saving your message.');</script>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<script>alert('Invalid email format');</script>";
        }
    } else {
        echo "<script>alert('All fields are required');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking.com - Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/link.php'); ?>
</head>
<body class="bg-light">
<?php require('inc/header.php'); ?>

<div class="my-5 px-4">
    <h2 class="text-center fw-bold h-font">CONTACT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
        We'd love to hear from you! Fill in your details and message below.
    </p>
</div>

<div class="container">
    <div class="row">
        <!-- Left: Map & Info -->
        <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 pop">
                <iframe class="w-100 rounded mb-3" height="320" loading="lazy"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.5851838428!2d-0.26640253299971084!3d51.52852620463016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2s!4v1739004948143!5m2!1sen!2s">
                </iframe>
                <h5>Address</h5>
                <a href="https://maps.app.goo.gl/yRqDf13Y4ekucbJ56" target="_blank" class="d-block mb-2 text-decoration-none">
                    <i class="bi bi-geo-alt"></i> Luton London
                </a>
                <h5 class="mt-2">Call Us</h5>
                <a href="tel:+923355392030" class="d-block mb-2 text-decoration-none">
                    <i class="bi bi-telephone-outbound-fill me-1"></i> +92 335 5392030
                </a>
                <h5 class="mt-2">Email Us</h5>
                <a href="mailto:Reservation@booking.com" class="d-block mb-2 text-decoration-none">
                    <i class="bi bi-envelope-exclamation-fill me-1"></i> Reservation@booking.com
                </a>
                <h5 class="mt-2">Follow Us</h5>
                <a href="#" class="me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="me-2"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
            </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4">
                <h5>Send a Message</h5>
                <form method="POST">
                    <div class="mt-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" required class="form-control shadow-none">
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" required class="form-control shadow-none">
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-bold">Message</label>
                        <textarea name="subject" rows="5" required class="form-control shadow-none" style="resize: none;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark text-white mt-3 shadow">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>
</body>
</html>
