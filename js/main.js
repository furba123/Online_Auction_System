
// Set the date we're counting down to

var timer = document.getElementById('countdown-timer');
if (timer) {
    const dateString = timer.getAttribute("data-countdowntime");
const date = new Date(dateString);

const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const month = monthNames[date.getMonth()];
const day = date.getDate();
const year = date.getFullYear();

const hours = date.getHours();
const minutes = date.getMinutes();
const seconds = date.getSeconds();

const formattedDate = `${month} ${day}, ${year} ${hours}:${minutes}:${seconds}`;

var countDownDate = new Date(formattedDate).getTime();

// Update the count down every 1 second
var x = setInterval(function () {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("countdown-timer").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("countdown-timer").innerHTML = "EXPIRED";
  }
}, 1000);
}

 $('.togglePassword').click(function() {
        const password = $('#loginpassword,#registerpassword');
        const type = password.attr('type') === 'password' ? 'text' : 'password';
        password.attr('type', type);
        $(this).toggleClass('bi-eye');
    });

var input = document.getElementById("phone");

input.addEventListener("input", function () {
  var value = input.value;
  if (value.length > 10) {
    input.value = value.slice(0, 10); // Truncate to 10 digits
  }

});


var element = $('.alert');
    setTimeout(function() {
        element.fadeOut(500, function() {
            element.remove();
        });
    }, 5000);



$(document).ready(function () {
       $('[name="bid_amt]').on('input', function() {
        var inputValue = $(this).val();
        var sanitizedValue = inputValue.replace(/[^0-9+-]/g, ''); // Remove non-numeric characters
        $(this).val(sanitizedValue);
      });
    
    });