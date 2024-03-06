<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $to = "example@gmail.com";
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $from_email = $_POST['email'];

    $headers = "From: " . $from_email . "\r\n";
    $headers .= "Reply-To: " . $from_email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        $msg = "Mail has been sent successfully.";
    } else {
        $msg = "Sending Failed!";
    }
} else {
    $msg = "";
}

?>

<style>
    .container #login {
        margin-top: 4rem;
        margin-bottom: 3rem;
    }
</style>

<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="row  justify-content-center align-items-center">
            <div class="col-sm-5 border border-dark mt-4 px-5 py-3">
                <div class="form-wrap">
                    <h3 class="text-center"><i class="fas fa-envelope fa-3x"></i></h3>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <h6><?php echo $msg; ?></h6>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your subject">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body" id="body" cols="50" rows="6" placeholder="Type Your Message..."></textarea>
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-secondary btn-lg btn-block mb-3" value="Submit">
                    </form>
                </div>
            </div> <!-- /.col-sm-5 -->
        </div> <!-- /.row -->
    </section>

    <hr>


</div> <!-- /.container -->
<?php include "includes/footer.php"; ?>