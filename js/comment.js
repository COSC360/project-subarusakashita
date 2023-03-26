document.getElementById("loginform").addEventListener("submit", function(event) {
    // Prevent the form from submitting normally
    event.preventDefault();
  
    // Get the form data
    var formData = new FormData(this);
  
    // Validate the form data
    if (formData.get("username") == "") {
      document.getElementById("error-message").textContent = "Please enter your name.";
      return;
    }
  
    if (formData.get("password") == "") {
      document.getElementById("error-message").textContent = "Please enter your email.";
      return;
    }
  
    // Clear the error message
    document.getElementById("error-message").textContent = "";
  
    // Submit the form data if it is valid
    this.submit();
  });