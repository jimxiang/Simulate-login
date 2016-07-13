$(document).ready(function()
{
    $("#submit").click(function()
    {
        var username = $("#username").val();
        var password = $("#password").val();
        var data = "username=" + username + "&password=" + password;
        if(username != '' && password != '')
        {
            $.ajax({
                method: "POST",
                url: "login.php",
                dataType: "JSON",
                data: data
            })
            .done(function(data) {
                $("#result").html(data.msg);
                if(data.errCode == "200")
                {
                    
                }
            })
            .fail(function(data) {
                console.log(data);
            })
        }
        else
        {
            $("#result").html("用户名或密码不能为空");
        }
    });
});
