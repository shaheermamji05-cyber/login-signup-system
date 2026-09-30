<?php 
session_start();



if(isset($_SESSION["userid"])){
  header("location:home.php");

}


include("connection.php");

if(isset($_POST["btn"])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    $fetchQuery = "SELECT * FROM `users` WHERE `email` = :email";
    $fetchQueryPrepare = $connection->prepare($fetchQuery);
    $fetchQueryPrepare->bindParam(":email", $email, PDO::PARAM_STR);
    $fetchQueryPrepare->execute();
    $userData = $fetchQueryPrepare->fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($userData);
    // echo "</pre>";

if($userData){
    $verifyUser = password_verify($password,$userData['password']);

    if($verifyUser){
        echo "login sucessfully";
        

$_SESSION['userid'] = $userData['id'];
$_SESSION['name'] = $userData['name'];
$_SESSION['email'] = $userData['email'];

header("location:home.php");

    }
    else{
    echo "Password is incorrect";
    }
}else{
    echo "You have not signed up yet. Please sign up first.";
}






}




?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>login page</title>
    <style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

:root{
    --gold:#d4af37;
    --gold-light:#ffd86b;
    --sky:#38bdf8;
    --sky-light:#7dd3fc;
}

body{
    min-height:100vh;
    padding:45px 20px;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#fff;
    font-family:"Courier New",monospace;

    position:relative;
    overflow-x:hidden;

    background:
        linear-gradient(rgba(255,255,255,.018) 1px,transparent 1px),
        linear-gradient(90deg,rgba(255,255,255,.018) 1px,transparent 1px),
        radial-gradient(circle at 20% 20%,rgba(212,175,55,.15),transparent 30%),
        radial-gradient(circle at 80% 80%,rgba(56,189,248,.15),transparent 30%),
        #020304;

    background-size:
        45px 45px,
        45px 45px,
        100% 100%,
        100% 100%;
}

body::before,
body::after{
    content:"";
    position:fixed;
    width:550px;
    height:550px;
    border-radius:50%;
    filter:blur(110px);
    pointer-events:none;
    z-index:0;
}

body::before{
    background:var(--gold);
    top:-250px;
    left:-200px;
    opacity:.18;
    animation:goldMove 9s ease-in-out infinite alternate;
}

body::after{
    background:var(--sky);
    bottom:-250px;
    right:-200px;
    opacity:.18;
    animation:skyMove 10s ease-in-out infinite alternate;
}

@keyframes goldMove{
    0%{transform:translate(0,0)}
    50%{transform:translate(180px,100px)}
    100%{transform:translate(50px,250px)}
}

@keyframes skyMove{
    0%{transform:translate(0,0)}
    50%{transform:translate(-180px,-100px)}
    100%{transform:translate(-50px,-250px)}
}

.container{
    width:100%;
    max-width:500px;
    position:relative;
    z-index:2;
}

.container form{
    position:relative;
    padding:40px;
    border-radius:20px;
    background:rgba(5,7,10,.96);
    backdrop-filter:blur(20px);
    box-shadow:
        0 0 50px rgba(0,0,0,.8),
        0 0 100px rgba(56,189,248,.05);
    overflow:hidden;
}

.container form::before{
    content:"";
    position:absolute;
    inset:-2px;
    border-radius:22px;
    background:conic-gradient(
        from 0deg,
        transparent,
        var(--gold),
        transparent 25%,
        var(--sky),
        transparent 50%,
        var(--gold-light),
        transparent 75%,
        var(--sky-light),
        transparent
    );
    animation:borderRotate 5s linear infinite;
    z-index:-2;
}

.container form::after{
    content:"";
    position:absolute;
    inset:2px;
    border-radius:18px;
    background:#05070a;
    z-index:-1;
}

@keyframes borderRotate{
    from{transform:rotate(0deg)}
    to{transform:rotate(360deg)}
}

h1{
    color:#fff;
    font-size:32px;
    margin-bottom:30px;
    text-align:center;
    text-shadow:0 0 20px rgba(255,255,255,.08);
}

.form-label{
    color:#cbd5e1;
    font-size:12px;
    letter-spacing:1px;
}

.form-control{
    background:rgba(0,0,0,.65)!important;
    border:1px solid #252b33!important;
    color:#fff!important;
    border-radius:10px;
    padding:13px 15px;
    font-family:"Courier New",monospace;
    transition:.3s;
}

.form-control:hover{
    border-color:rgba(212,175,55,.5)!important;
}

.form-control:focus{
    border-color:var(--gold)!important;
    box-shadow:
        0 0 0 2px rgba(212,175,55,.08),
        0 0 18px rgba(212,175,55,.15)!important;
}

.form-control::placeholder{
    color:#46505c;
}

.btn-primary{
    width:100%;
    padding:14px;
    border:1px solid var(--gold)!important;
    border-radius:10px;
    background:linear-gradient(
        90deg,
        #a88319,
        #e8c65a,
        #b89427
    )!important;
    background-size:200% 100%!important;
    color:#080808!important;
    font-weight:bold;
    font-family:"Courier New",monospace;
    letter-spacing:1px;
    animation:buttonGradient 4s ease infinite;
    transition:.4s;
}

.btn-primary:hover{
    transform:translateY(-3px);
    box-shadow:
        0 0 25px rgba(212,175,55,.35),
        0 0 50px rgba(56,189,248,.08);
}

@keyframes buttonGradient{
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}

.error-msg{
    color:#ff647c;
    font-size:11px;
    margin-top:6px;
    display:none;
}

.input-error{
    border-color:#ff647c!important;
    box-shadow:0 0 12px rgba(255,100,124,.15)!important;
}

@media(max-width:576px){

    body{
        padding:30px 15px;
    }

    .container form{
        padding:28px 22px;
    }

    h1{
        font-size:25px;
    }
}
</style>
  </head>
  <body>
    <h1 class="text-center">login Page</h1>


<div class="container">
<form method="POST">

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
 
  <button type="submit" name="btn" class="btn btn-primary">login</button>
</form>
</div>








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<script>
  // ya hpme page sa login page ma nahii aai ga
window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
        window.location.reload();
    }
});


// ya regex laga hua ha

document.querySelector("form").addEventListener("submit", function(e){

    let email = document.querySelector("input[name='email']");
    let password = document.querySelector("input[name='password']");

    let valid = true;

    let emailRegex =
        /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

    let passwordRegex =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


    document.querySelectorAll(".error-msg").forEach(function(error){
        error.style.display = "none";
    });

    email.classList.remove("input-error");
    password.classList.remove("input-error");


    // Gmail Regex
    if(!emailRegex.test(email.value.trim())){

        email.classList.add("input-error");

        email.insertAdjacentHTML(
            "afterend",
            '<div class="error-msg" style="display:block;">⚠ Valid Gmail address required</div>'
        );

        valid = false;
    }


    // Password Regex
    if(!passwordRegex.test(password.value)){

        password.classList.add("input-error");

        password.insertAdjacentHTML(
            "afterend",
            '<div class="error-msg" style="display:block;">⚠ Password must contain 8+ characters, uppercase, lowercase, number & special character</div>'
        );

        valid = false;
    }


    if(!valid){
        e.preventDefault();
    }

});
</script>
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>