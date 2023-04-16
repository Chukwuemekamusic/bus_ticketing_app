document.addEventListener("DOMContentLoaded", function() {
    const departureDateInput = document.getElementById("departuredate");


    // check if the date inputed is either today or ahead
    departureDateInput.addEventListener("change",function () {
        let today = new Date();
        if (new Date(departureDateInput.value) < today.setHours(0, 0, 0, 0)) {
            alert("Travel date must be today or a future date.");
            departureDateInput.value="";
        }
    });

    
  
  })
  
  // this function 
  function addReturnInput() {
    const element = document.getElementById("returndate");
      // check if there is any element in the html with class 'return' 
    if (!element) { 
      var form = document.getElementById("traveldate");
    //   form.removeChild(document.getElementById("searchbusbtn"));
  
        // create the returndate label    
      var returnDateLabel = document.createElement("label");
      returnDateLabel.setAttribute("for", "returndate"); 
      returnDateLabel.setAttribute("id", "returndatelabel");
    //   returnDateLabel.innerHTML = "Return Date:";
      form.appendChild(returnDateLabel);
      
      var returnDateInput = document.createElement("input");
      returnDateInput.setAttribute("type", "date");
      returnDateInput.setAttribute("id", "returndate");
      returnDateInput.setAttribute("name", "returndate");
      form.appendChild(returnDateInput);
  
      var emptyspace = document.createElement("br");
      emptyspace.setAttribute("class", "returnspace");
      form.appendChild(emptyspace);
  
        // add event listener for the return date input
        
        returnDateInput.addEventListener("change", function() {
          let departureDate = new Date(document.getElementById("departuredate").value);
          let returnDate = new Date(returnDateInput.value);
          if (returnDate < departureDate) {
              alert("Return date must be after departure date.");
              returnDateInput.value = "";
          }
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
  
  