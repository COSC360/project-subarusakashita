// Add an event listener to the form submission
document.getElementById("loginform").addEventListener("submit", function(event) {
    // Prevent the form from submitting normally
    event.preventDefault();
  
    // Get the form data
    var formData = new FormData(this);
  
    // Validate the form data
    if (formData.get("username") == "") {
      alert("Please enter your name.");
      return;
    }
  
    if (formData.get("password") == "") {
      alert("Please enter your password.");
      return;
    }
  
    // Submit the form data if it is valid
    this.submit();
  });
  