document.addEventListener("DOMContentLoaded", function() {
  const departureDateInput = document.getElementById("departuredate");

  departureDateInput.addEventListener("change",function () {
      let today = new Date();
      if (new Date(departureDateInput.value) < today) {
          alert("Return date must be today or a future date.");
          departureDateInput.value="";
      }
  });

})

// this function 
function addReturnInput() {
  const element = document.getElementById("returndate");

  // check if there is any element in the html with class 'return' 
  if (!element) { 
    var form = document.getElementById("booking-form");
    form.removeChild(document.getElementById("searchbusbtn"));

    var returnDateLabel = document.createElement("label");
    returnDateLabel.setAttribute("for", "returndate");
    returnDateLabel.setAttribute("id", "returndatelabel");
    returnDateLabel.innerHTML = "Return Date:";
    form.appendChild(returnDateLabel);
    
    var returnDateInput = document.createElement("input");
    returnDateInput.setAttribute("type", "date");
    returnDateInput.setAttribute("id", "returndate");
    returnDateInput.setAttribute("name", "returndate");
    form.appendChild(returnDateInput);

    var emptyspace = document.createElement("br");
    emptyspace.setAttribute("class", "returnspace");
    form.appendChild(emptyspace);
    form.appendChild(emptyspace);

    // check return date and display 'Search for Bus' 
    var submitBtn = document.createElement("button");
    submitBtn.setAttribute("type", "submit");
    submitBtn.setAttribute("id", "searchbusbtn");
    submitBtn.innerHTML = "Search for Bus";
    form.appendChild(submitBtn);

    returnDateInput.addEventListener("change", function () {      
      let today = new Date();
      if (new Date(returnDateInput.value) < today) {
          alert("Return date must be or a future date");
          returnDateInput.value="";
      }
      // TODO need to improve the code to only accept returndate >= departing date
  });


  }}

function removeReturnInput() {
  const element = document.getElementById("returndate");
  
  if (element) { 
    element.remove();
    document.getElementById("returndatelabel").remove();
    //document.getElementById("searchbusbtn").remove();
    document.getElementsByClassName("returnspace")[0].remove();
    document.getElementsByClassName("returnspace")[1].remove();
  
  
}}

