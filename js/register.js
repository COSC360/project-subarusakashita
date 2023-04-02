document.getElementById("registerform").addEventListener("submit", function(event) {
    // Prevent the form from submitting normally
    event.preventDefault();
  
    // Get the form data
    var formData = new FormData(this);
  
    // Validate the form data
    if (formData.get("rUsername") == "") {
      document.getElementById("error-message").textContent = "Please enter your username.";
      return;
    }

    if (formData.get("rEmail") == "") {
        document.getElementById("error-message").textContent = "Please enter your email.";
        return;
      }
  
    if (formData.get("rPassword") == "") {
      document.getElementById("error-message").textContent = "Please enter your password.";
      return;
    }

    // Clear the error message
    document.getElementById("error-message").textContent = "";
  
    // Submit the form data if it is valid
    this.submit();
  });