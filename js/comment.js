document.addEventListener('DOMContentLoaded', (event) => {
    const required = document.getElementsByClassName('required');
    const username = required[0];
    const password = required[1];
    inputs.addEventListener('submit', function (event) {
        
        if((username.value==="") || (username.value==null)){
            event.preventDefault();
            alert("Username is blank")
           //title.style.border = "1px solid red";
        }
        if((password.value==="") || (password.value==null)){
            event.preventDefault();
            alert("Password is blank");
            //desc.style.border = "1px solid red";
        }
        // if(!accept.checked){
        //     event.preventDefault();
        //    //accept.parentNode.style.border = "1px solid red";
        // }

    });
    // desc.addEventListener("change", function (event) {
    //     desc.style.border="1px solid black";
    // });
    // title.addEventListener("change", function (event) {
    //     title.style.border="1px solid black";
    // });
    // accept.addEventListener("change", function (event) {
    //     accept.parentNode.style.border="1px solid black";
    // });
}); 