function toggleToodle() {
  var returnDateContainer = document.getElementById("returnDateContainer");
  var returnDateInput = document.getElementById("Returndate");
  var toodleButton = document.getElementById("toodleButton");

  if (returnDateContainer.style.display === "none") {
    returnDateContainer.style.display = "flex";
    returnDateContainer.style.flexDirection = "column";
    returnDateContainer.style.alignItems = "center";
    returnDateContainer.style.justifyContent = "center";
    returnDateInput.required = true;
    toodleButton.textContent = "Return Way";
  } else {
    returnDateContainer.style.display = "none";
    returnDateInput.required = false;
    toodleButton.textContent = "One Way";
  }
}

