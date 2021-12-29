$(document).ready(function(){
    $('email').on('change', function(){
        $.ajax({
            url: '../app/model/register.php',
            data: {
                'email' : $('email').val()
            },
            dataType: 'json',
            success: function(data){
                if(data == true){
                    alert('Email exists');
                }
                else{
                    alert("Email does not exists");
                }
            },
            error: function(data){
                alert('error');
            }
        });
    });
});