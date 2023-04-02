document.getElementById("loginform").addEventListener("submit", function(event) {
    // Prevent the form from submitting normally
    event.preventDefault();
  
    // Get the form data
    var formData = new FormData(this);
  
    // Validate the form data
    if (formData.get("username") == "") {
      document.getElementById("error-message2").textContent = "Please enter your username.";
      return;
    }
  
    if (formData.get("password") == "") {
      document.getElementById("error-message2").textContent = "Please enter your password.";
      return;
    }
  
    // Clear the error message
    document.getElementById("error-message2").textContent = "";
  
    // Submit the form data if it is valid
    this.submit();
  });