<footer class="bg-dark text-light py-4">
    <div class="container text-center">
        <p class="my-0">&copy; 2023 Your Auction System. All rights reserved. Made by Pragya Kayastha & Niruta Bhujel</p>
    </div>
</footer>


<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="db/login.php" method="POST">
                    <div class="mb-3">
                        <label for="loginemailaddress" class="form-label">Email address</label>
                        <input type="email" name="email_address" required class="form-control" id="loginemailaddress">

                    </div>
                    <div class="mb-3">
                        <label for="loginpassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" value="" name="password" required class="form-control"
                                id="loginpassword">
                            <i class="bi bi-eye-slash togglePassword"></i>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <div class="mt-3">Not a member? <a href="" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Register here</a></div>

                    <div id="login-err" class="alert alert-danger mt-3 py-2 d-none">
                       
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>


<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="db/insert.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" name="first_name" required class="form-control" id="first_name">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" name="last_name" required class="form-control" id="last_name">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone number</label>
                                <input type="number" name="phone" maxlength="10" required class="form-control"
                                    id="phone">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" required class="form-control" id="address">

                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="registeremailaddress" class="form-label">Email address</label>
                        <input type="email" name="email_address" required class="form-control"
                            id="registeremailaddress">

                    </div>
                    <div class="mb-3">
                        <label for="registerpassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" value="" name="password" required class="form-control"
                                id="registerpassword">
                            <i class="bi bi-eye-slash togglePassword"></i>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <div class="mt-3">Already a member? <a href="" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Login here</a></div>

                    <div id="register-err" class="alert alert-danger mt-3 py-2 d-none">
                        
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>


<script>
    $(document).ready(function() {
        if (localStorage.getItem('register_error')){
            $("#registerModal").modal('show');
            $("#register-err").removeClass('d-none').text(localStorage.getItem('register_error'));
            localStorage.removeItem("register_error");
        }

        if (localStorage.getItem('login_error')){
            $("#loginModal").modal('show');
            $("#login-err").removeClass('d-none').text(localStorage.getItem('login_error'));
            localStorage.removeItem("login_error");
        }
    });
    
</script>

</body>

</html>