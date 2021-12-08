
function emailValidator(input){
    var format =  "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    if(input.value.match(format)){
        document.form1.email.focus();
        return true;
    }
    else{
        alert("You have entered an invalid e-mail");
        document.form1.email.focus();
        return false;
    }
}

function bannedChars(input){
    if(input.value.includes("#") && input.value.includes("@")){
        alert("You have entered prohibited characters");
        document.form1.nick.focus();
        return false;
    }
    else{
        document.form1.nick.focus();
        return true;
    }
}

function checkIfInputsEmpty(nick, email, message){
    if(nick.value.length <= 0){
        alert("Please enter nickname to input");
        return false;

    }
    else if(email.value.length <= 0) {
        alert("Please enter email adress to input");
        return false;
    }
    else if(message.value.length <= 0){
        alert("Please enter message to input");
        return false;
    }
    else if(nick.value.length <=0 || email.value.length <=0) {
        alert("Please enter nick and email to inputs");
        return false;
    }
    else{
        return true;
    }
}