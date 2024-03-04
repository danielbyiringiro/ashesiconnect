const emailfield = document.getElementById('email');
let passwordfield = document.getElementById('password');
let btn = document.getElementById('btn').addEventListener("click", validation);
function validation(e){
    const regEmail=/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,}$/;
    if (passwordfield.value == ""){
        e.preventDefault();
        alert("Please enter an appropriate password");
        passwordfield.style.borderColor= "red";
        return false;
    }
    else if (emailfield.value === ""||!regEmail.test(emailfield.value)){
        e.preventDefault();
        alert("Please input an appropriate email")
        emailfield.style.borderColor= "red";
        return false;
    }
    else{
        email.style.borderColor="green"
        passwordfield.style.borderColor="green"
        return true;
    }
}