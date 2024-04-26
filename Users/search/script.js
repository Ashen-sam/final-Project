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
  