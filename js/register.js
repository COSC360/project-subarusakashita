document.getElementById("registerform").addEventListener("submit", function(event) {
    // Prevent the form from submitting normally
    event.preventDefault();
  
    // Get the form data
    var formData = new FormData(this);
  
    // Validate the form data
    if (formData.get("username") == "") {
      document.getElementById("errormessage").textContent = "Please enter your username.";
      return;
    }
    if (formData.get("email") == "") {
        document.getElementById("errormessage").textContent = "Please enter your email.";
        return;
      }
    if (formData.get("password") == "") {
        document.getElementById("errormessage").textContent = "Please enter your password.";
        return;
    }
    if (formData.get("password_conf") == "") {
        document.getElementById("errormessage").textContent = "Please enter your password confirmation.";
        return;
      }
  
    // Clear the error message
    document.getElementById("errormessage").textContent = "";
  
    // Submit the form data if it is valid
    this.submit();
  });