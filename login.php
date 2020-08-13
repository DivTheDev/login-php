<?php
session_start();

if (isset($_SESSION['loggedIN'])){
    header('Location: hidden.php');
    exit();
}
if (isset($_POST['login'])) {
    $connection = new mysqli('localhost', 'root', '', 'login');

    $email = $connection->real_escape_string($_POST['emailPHP']);
    $password = md5($connection->real_escape_string($_POST['passwordPHP']));

    $data = $connection->query("SELECT id FROM users WHERE email='$email' AND password='$password'");
    if ($data->num_rows > 0) {
        $SESSION['loggedIN'] = '1';
        $SESSION['email'] = $email;
        exit('<font style="color: green">Login success...</font>');
    } else
        exit('<font style="color: red">Please check your inputs!</font>');
}
?>

<html>
<head>
    <title>Login Function</title>
</head>
<body>
<form method="post" action="login.php">
    <input type="text" id="email" placeholder="Email..."><br>
    <input type="password" id="password" placeholder="Password..."><br>
    <input type="button" value="Log In" id="login">
</form>

<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function (){
        $("#login").on('click', function () {
            var email = $("#email").val();
            var password = $("#password").val();

            if (email == "" || password == "")
                alert ('Please check your inputs');
            else {
                $.ajax(
                    {
                        url: 'login.php',
                        method: 'POST',
                        data: {
                            login: 1,
                            emailPHP: email,
                            passwordPHP: password
                        },
                        success: function (response) {
                            $("#response").html(response);

                            if (response.indexOf('success') >= 0)
                                window.location = 'hidden.php';
                        },
                        dataType: 'text'
                    }
                );
            }
        });
    });
</script>

</body>
</html>
