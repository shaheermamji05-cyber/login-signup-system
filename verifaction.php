<?php
session_start();
include("connection.php");

// echo $_SESSION["name"];  // ya session ma value aa gaya ha 

if(isset($_POST["btn"])){


$userEntercode = $_POST["codeVerifaction"];

if($userEntercode == $_SESSION["code"]){

    echo "verifaction successfully";
  

    
 $name = $_SESSION["name"];
 $password = $_SESSION["password"];
 $email = $_SESSION["email"];


 $insertquery = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name, :email, :password)";
 $insertprepare = $connection->prepare($insertquery);
 $insertprepare->bindParam(":name",$name, PDO::PARAM_STR);
 $insertprepare->bindParam(":email",$email, PDO::PARAM_STR);

 $hashpassword = password_hash($password,PASSWORD_BCRYPT);  // ya password ko ya password ko dcord karay ga show nahii ho ga

 $insertprepare->bindParam(":password", $hashpassword, PDO::PARAM_STR);   // // password ko hash password ka andar store kr da ga

if($insertprepare->execute()){
echo "user added successfully";
unset($_SESSION["code"]);

header("location:home.php");

}else{
    echo "user not added successfully";
}




}else{
    echo "verification failed";
}



}
   







?>













<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>verify email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
        linear-gradient(
            rgba(255,255,255,.018) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(255,255,255,.018) 1px,
            transparent 1px
        ),
        radial-gradient(
            circle at 15% 20%,
            rgba(212,175,55,.18),
            transparent 30%
        ),
        radial-gradient(
            circle at 85% 80%,
            rgba(56,189,248,.18),
            transparent 30%
        ),
        #020304;

    background-size:
        45px 45px,
        45px 45px,
        100% 100%,
        100% 100%;
}


/* GOLD GLOW */

body::before{
    content:"";

    position:fixed;

    width:550px;
    height:550px;

    border-radius:50%;

    background:var(--gold);

    filter:blur(110px);

    opacity:.18;

    top:-250px;
    left:-200px;

    pointer-events:none;

    animation:goldMove 9s ease-in-out infinite alternate;
}


/* SKY GLOW */

body::after{
    content:"";

    position:fixed;

    width:550px;
    height:550px;

    border-radius:50%;

    background:var(--sky);

    filter:blur(110px);

    opacity:.18;

    bottom:-250px;
    right:-200px;

    pointer-events:none;

    animation:skyMove 10s ease-in-out infinite alternate;
}


@keyframes goldMove{
    0%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(180px,100px);
    }

    100%{
        transform:translate(50px,250px);
    }
}


@keyframes skyMove{
    0%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-180px,-100px);
    }

    100%{
        transform:translate(-50px,-250px);
    }
}


/* HEADING */

h1{
    position:relative;
    z-index:2;

    color:#fff;

    font-size:32px;

    margin-bottom:25px;

    letter-spacing:2px;

    text-shadow:
        0 0 15px rgba(255,255,255,.08);
}

h1::first-letter{
    color:var(--gold-light);
}


/* CARD */

.container{
    width:100%;
    max-width:500px;

    position:relative;
    z-index:2;

    margin:auto;
}


/* FORM */

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


/* ANIMATED BORDER */

.container form::before{
    content:"";

    position:absolute;

    inset:-2px;

    border-radius:22px;

    background:
        conic-gradient(
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
    from{
        transform:rotate(0deg);
    }

    to{
        transform:rotate(360deg);
    }
}


/* LABEL */

.form-label{
    color:#cbd5e1;

    font-size:12px;

    letter-spacing:1px;

    margin-bottom:8px;
}


/* CODE INPUT */

.form-control{
    background:rgba(0,0,0,.65)!important;

    border:1px solid #252b33!important;

    color:#fff!important;

    border-radius:10px;

    padding:14px 15px;

    font-family:"Courier New",monospace;

    font-size:18px;

    letter-spacing:6px;

    text-align:center;

    transition:all .3s ease;

    box-shadow:
        inset 0 0 15px rgba(0,0,0,.5);
}


.form-control:hover{
    border-color:
        rgba(212,175,55,.6)!important;
}


.form-control:focus{
    border-color:
        var(--gold)!important;

    box-shadow:

        0 0 0 2px
        rgba(212,175,55,.08),

        0 0 20px
        rgba(212,175,55,.2),

        inset 0 0 15px
        rgba(212,175,55,.03)!important;
}


.form-control::placeholder{
    color:#46505c;

    letter-spacing:2px;
}


/* VERIFY BUTTON */

.btn-primary{
    width:100%;

    padding:14px;

    margin-top:8px;

    border:1px solid var(--gold)!important;

    border-radius:10px;

    background:
        linear-gradient(
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

    transition:all .4s ease;

    animation:
        buttonGradient 4s ease infinite;

    box-shadow:
        0 0 20px
        rgba(212,175,55,.15);
}


@keyframes buttonGradient{

    0%{
        background-position:0% 50%;
    }

    50%{
        background-position:100% 50%;
    }

    100%{
        background-position:0% 50%;
    }
}


.btn-primary:hover{

    transform:translateY(-3px);

    box-shadow:

        0 0 25px
        rgba(212,175,55,.35),

        0 0 50px
        rgba(56,189,248,.08);
}


/* MOBILE */

@media(max-width:576px){

    body{
        padding:30px 15px;
    }

    h1{
        font-size:25px;
        margin-bottom:20px;
    }

    .container form{
        padding:28px 22px;
    }

    .form-control{
        font-size:16px;
    }
}
</style>
  </head>
  <body>
    <h1 class="text-center">verify email</h1>
    <div class="container">
    <form class="row g-3" method ="post">
    <div class="col-md-12">
    <label for="inputPassword4" class="form-label">username</label>
    <input type="number" class="form-control" name ="codeVerifaction">
  </div>
    <button type="submit" class="btn btn-primary" name ="btn">verify</button>
  </div>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>