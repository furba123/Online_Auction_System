<footer class="bg-dark text-light py-4">
    <div class="container text-center">
        <p>&copy; 2023 Your Auction System. All rights reserved. Made by Pragya Kayastha & Niruta Bhujel</p>
    </div>
</footer>


<!-- Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmLabel">Are you sure want to delete?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" class="btn btn-danger delete-btn">Yes, Delete</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>


<script>
    var element = $('.alert');
    setTimeout(function() {
        element.fadeOut(500, function() {
            element.remove();
        });
    }, 5000);

    var input = document.getElementById("phone");

    if (input){
        input.addEventListener("input", function() {
            var value = input.value;
            if (value.length > 10) {
                input.value = value.slice(0, 10); // Truncate to 10 digits
            }
        });
    }

    $('.togglePassword').click(function() {
        const password = $('#userpassword');
        const type = password.attr('type') === 'password' ? 'text' : 'password';
        password.attr('type', type);
        $(this).toggleClass('bi-eye');
    });

     $(".modal-trigger").click(function() {
        var rowId = $(this).attr("href");
        $('#deleteConfirmModal .delete-btn').attr('href',rowId);
        
    });
</script>

</body>

</html>