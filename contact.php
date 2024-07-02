<?php include 'include/header.php';
if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];


  $query = mysqli_query($conn, "INSERT INTO contact_form (`first_name`, `last_name`, `email`, `subject`, `message`) VALUES ('$first_name', '$last_name', '$email', '$subject', '$message')");
  if ($query) {
    $_SESSION['success_msg'] = 'Message sent successfully.';
  } else {
    $_SESSION['error_msg'] = 'Error while sending message.';
  }

}
?>


<div class="breadcrumbs">
  <a href="index.php">Home</a>
  <i class="bi bi-arrow-right"></i>
  <span>Contact</span>
</div>
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-9">
      <h1 class="mb-5">Contact Us</h1>
      <?php  if (isset($_SESSION['success_msg'])): ?>
          <div class="alert alert-success mb-3">
            <?php echo $_SESSION['success_msg']; ?>
            </div>
        <?php unset($_SESSION['success_msg']); endif; ?>
      <form method="POST">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
          </div>
          <div class="col-md-6">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="col-md-6">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject">
          </div>
          <div class="col-12">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <div class="btn w-100">
                  <button type="submit" name="submit" class="btn btn-dark w-100 fw-bold">Send</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container my-5">
          <div class="row">
            <div class="col-sm-4">
              <div class="box shadow p-3 text-center">
                <i style="font-size: 25px" class="bi text-muted bi-telephone-fill"></i>
                <h5>Phone</h5>
                <p class="mb-0">+977 9815366763</p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="box shadow p-3 text-center">
                <i style="font-size: 25px" class="bi text-muted bi-envelope-fill"></i>
                <h5>Email</h5>
                <p class="mb-0">onlineauction@gmail.com</p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="box shadow p-3 text-center">
                <i style="font-size: 25px" class="bi text-muted bi-globe-central-south-asia"></i>
                <h5>Website</h5>
                <p class="mb-0">yourauctionsystem.com</p>
              </div>
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<?php include 'include/footer.php';