function search() {
    const input = document.querySelector(".searchbox");
    const search = input.value.toUpperCase();
    const boxes = document.querySelectorAll('.image_box');
  
    for(let i = 0; i < boxes.length; i++){
      let h2 = boxes[i].querySelector('h2');
      let txtValue = h2.textContent || h2.innerText;
  
      if(txtValue.toUpperCase().includes(search)){
        boxes[i].style.display = "";
      } else {
        boxes[i].style.display = "none";
      }
    }
}

function toggleToodle() {
  var returnDateContainer = document.getElementById('returnDateContainer');
  var returnDateInput = document.getElementById('Returndate');
  var toodleButton = document.getElementById('toodleButton');
  
  if (returnDateContainer.style.display === 'none') {
      returnDateContainer.style.display = 'block';
      returnDateInput.required = true;
      toodleButton.textContent = 'Return Way';
  } else {
      returnDateContainer.style.display = 'none';
      returnDateInput.required = false;
      toodleButton.textContent = 'One Way';
  }
}

document.getElementById("confirmBookingBtn").addEventListener("click", function() {
  var confirmation = confirm("Are you satisfied with the Booking?");
  if (confirmation) {
      window.location.href = "../booking/booking.php";
  }
});