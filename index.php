<!-- zbxd klhg swjf dzdt    -->
<?php
session_start();    

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$mail = new PHPMailer(true);



if(isset($_POST["btn"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  $code = rand(1000,9999);          

// session storage ma add karay ga 
$_SESSION["name"] = $name;
$_SESSION["email"] = $email;
$_SESSION["password"] = $password;
$_SESSION["code"] = $code;



  echo "$name <br> $email<br> $password";       



try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
  $mail->isSMTP();                                            
  $mail->Host       = 'smtp.gmail.com';                      
  $mail->SMTPAuth   = true;                                   
  $mail->Username   = 'shaheermamji05@gmail.com';                      
  $mail->Password   = 'lcet pxmx qjbc glju';                                
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
  $mail->Port       = 465;                             

  //Recipients
  $mail->setFrom('its.owaisansari314@gmail.com', 'Mailer');
  $mail->addAddress($email, $name);  
  // $mail->addAddress('ellen@example.com');               
  // $mail->addReplyTo('info@example.com', 'Information');
  // $mail->addCC('cc@example.com');
  // $mail->addBCC('bcc@example.com');

  //Attachments    // ya commit ho ga
  // $mail->addAttachment('/var/tmp/file.tar.gz');        
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   

  //Content
  $mail->isHTML(true);                                  
  $mail->Subject = 'Verification Email';
  $mail->Body    = "This is the HTML message body <b> $code </b>";  
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  echo 'Message has been sent';

header("location:verifaction.php");   

} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Signin Page</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --gold: #d4af37;
    --gold-light: #ffd86b;
    --sky: #38bdf8;
    --sky-light: #7dd3fc;
    --black: #030405;
    --card: rgba(7, 9, 13, 0.88);
}

/* =========================
   BODY
========================= */

body {
    min-height: 100vh;

    /* Top + Bottom spacing */
    padding: 45px 20px;

    color: #fff;
    font-family: "Courier New", monospace;

    /* Perfect center */
    display: flex;
    align-items: center;
    justify-content: center;

    overflow-x: hidden;

    position: relative;

    background:
        linear-gradient(
            rgba(255,255,255,0.018) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(255,255,255,0.018) 1px,
            transparent 1px
        ),
        radial-gradient(
            circle at 20% 20%,
            rgba(212,175,55,0.15),
            transparent 30%
        ),
        radial-gradient(
            circle at 80% 80%,
            rgba(56,189,248,0.15),
            transparent 30%
        ),
        #020304;

    background-size:
        45px 45px,
        45px 45px,
        100% 100%,
        100% 100%;
}
@media(max-width: 576px) {

    body {
        min-height: 100vh;
        padding: 30px 15px;
    }

    .register-card {
        margin: 0;
        padding: 28px 22px;
    }

}

/* =========================
   ANIMATED BACKGROUND LIGHTS
========================= */

body::before,
body::after {
    content: "";
    position: fixed;
    width: 550px;
    height: 550px;
    border-radius: 50%;
    filter: blur(100px);
    pointer-events: none;
    z-index: 0;
    opacity: 0.25;
}

body::before {
    background: #d4af37;
    top: -250px;
    left: -200px;
    animation: goldMove 9s ease-in-out infinite alternate;
}

body::after {
    background: #38bdf8;
    bottom: -250px;
    right: -200px;
    animation: skyMove 10s ease-in-out infinite alternate;
}

@keyframes goldMove {
    0% {
        transform: translate(0, 0);
    }

    50% {
        transform: translate(180px, 100px);
    }

    100% {
        transform: translate(50px, 250px);
    }
}

@keyframes skyMove {
    0% {
        transform: translate(0, 0);
    }

    50% {
        transform: translate(-180px, -100px);
    }

    100% {
        transform: translate(-50px, -250px);
    }
}


/* =========================
   CODE BACKGROUND
========================= */

body {
    background-image:
        linear-gradient(
            rgba(222, 16, 16, 0.02) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(255,255,255,0.018) 1px,
            transparent 1px
        ),
        radial-gradient(
            circle at 20% 20%,
            rgba(212,175,55,0.15),
            transparent 30%
        ),
        radial-gradient(
            circle at 80% 80%,
            rgba(56,189,248,0.15),
            transparent 30%
        ),
        #020304;

    background-size:
        45px 45px,
        45px 45px,
        100% 100%,
        100% 100%;
}


/* =========================
   REGISTER CARD
========================= */

.register-card {
    width: 100%;
    max-width: 500px;

    padding: 40px;

    position: relative;
    z-index: 2;

    background: var(--card);

    border-radius: 20px;

    backdrop-filter: blur(20px);

    box-shadow:
        0 0 50px rgba(0,0,0,0.8),
        0 0 100px rgba(56,189,248,0.05);

    overflow: hidden;
}


/* =========================
   ANIMATED BORDER
========================= */

.register-card::before {
    content: "";
    position: absolute;

    inset: -2px;

    border-radius: 22px;

    background: conic-gradient(
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

    animation: borderRotate 5s linear infinite;

    z-index: -2;
}


/* Inner black layer */

.register-card::after {
    content: "";
    position: absolute;

    inset: 2px;

    border-radius: 18px;

    background: rgba(5,7,10,0.97);

    z-index: -1;
}


@keyframes borderRotate {

    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }

}


/* =========================
   TOP TERMINAL LINE
========================= */

.top-line {
    color: var(--gold-light);

    font-size: 13px;

    margin-bottom: 10px;

    letter-spacing: 1px;

    text-shadow:
        0 0 10px rgba(212,175,55,0.7);
}

.top-line::before {
    content: "● ";
    color: var(--sky);
}


/* =========================
   HEADING
========================= */

.register-card h1 {
    font-size: 31px;

    margin-bottom: 10px;

    letter-spacing: 1px;

    color: #fff;

    text-shadow:
        0 0 20px rgba(255,255,255,0.08);
}

.register-card h1 span {
    color: var(--gold-light);

    text-shadow:
        0 0 15px rgba(212,175,55,0.7);
}


/* =========================
   SUBTITLE
========================= */

.subtitle {
    color: #718096;

    font-size: 13px;

    margin-bottom: 30px;

    border-left: 2px solid var(--sky);

    padding-left: 10px;
}


/* =========================
   LABELS
========================= */

.form-label {
    color: #cbd5e1;

    font-size: 12px;

    letter-spacing: 1px;
}


/* =========================
   INPUTS
========================= */

.form-control {
    background: rgba(0,0,0,0.65) !important;

    border: 1px solid #252b33 !important;

    color: #fff !important;

    border-radius: 10px;

    padding: 13px 15px;

    font-family: "Courier New", monospace;

    transition: all 0.3s ease;

    box-shadow:
        inset 0 0 15px rgba(0,0,0,0.5);
}

.form-control:hover {
    border-color: rgba(212,175,55,0.5) !important;
}

.form-control:focus {
    border-color: var(--gold) !important;

    box-shadow:
        0 0 0 2px rgba(212,175,55,0.08),
        0 0 18px rgba(212,175,55,0.15),
        inset 0 0 15px rgba(212,175,55,0.03) !important;
}

.form-control::placeholder {
    color: #46505c;
}


/* =========================
   BUTTON
========================= */

.btn-register {

    width: 100%;

    padding: 14px;

    border: 1px solid var(--gold);

    border-radius: 10px;

    background:
        linear-gradient(
            90deg,
            #a88319,
            #e8c65a,
            #b89427
        );

    background-size: 200% 100%;

    color: #080808;

    font-weight: bold;

    font-family: "Courier New", monospace;

    letter-spacing: 1px;

    cursor: pointer;

    transition: all 0.4s ease;

    box-shadow:
        0 0 20px rgba(212,175,55,0.15);

    animation: buttonGradient 4s ease infinite;
}

@keyframes buttonGradient {

    0% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }

    100% {
        background-position: 0% 50%;
    }

}

.btn-register:hover {

    transform: translateY(-3px);

    box-shadow:
        0 0 25px rgba(212,175,55,0.35),
        0 0 50px rgba(56,189,248,0.08);

}


/* =========================
   ERROR
========================= */

.error-msg {

    color: #ff647c;

    font-size: 11px;

    margin-top: 6px;

    display: none;

    animation: errorIn 0.25s ease;
}

@keyframes errorIn {

    from {
        opacity: 0;
        transform: translateX(-5px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }

}

.input-error {

    border-color: #ff647c !important;

    box-shadow:
        0 0 12px rgba(255,100,124,0.15) !important;
}


/* =========================
   FOOTER
========================= */

.terminal-footer {

    margin-top: 25px;

    color: #4b5563;

    font-size: 10px;

    text-align: center;

    letter-spacing: 1px;
}

.terminal-footer span {

    color: var(--sky);

    text-shadow:
        0 0 10px var(--sky);
}


/* =========================
   RESPONSIVE
========================= */

@media(max-width: 576px) {

    .register-card {

        margin: 18px;

        padding: 28px 22px;

    }

    .register-card h1 {

        font-size: 25px;

    }

}
</style>
  </head>
  <body>
  <div class="register-card">

    <div class="top-line">
        &gt; system.init()
    </div>

    <h1>create_<span>account</span>()</h1>

    <p class="subtitle">
        // Initialize your developer profile
    </p>

    <form method="POST" id="registerForm">

        <div class="mb-3">
            <label class="form-label">user_name</label>

            <input
                type="text"
                class="form-control"
                name="name"
                id="name"
                placeholder="Enter your name"
                autocomplete="name"
            >

            <div class="error-msg" id="nameError">
                ⚠ Name is required
            </div>
        </div>


        <div class="mb-3">
            <label class="form-label">email_address</label>

            <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder="developer@example.com"
                autocomplete="email"
            >

            <div class="error-msg" id="emailError">
                ⚠ Valid email is required
            </div>
        </div>


        <div class="mb-4">
            <label class="form-label">password</label>

            <input
                type="password"
                class="form-control"
                name="password"
                id="password"
                placeholder="Create a password"
                autocomplete="new-password"
            >

            <div class="error-msg" id="passwordError">
                ⚠ Password must be at least 6 characters
            </div>
        </div>


        <button
            type="submit"
            name="btn"
            class="btn-register"
        >
            ./create_account
        </button>

    </form>

    <div class="terminal-footer">
        <span>●</span> DEV_MODE &nbsp; | &nbsp; SECURE_CONNECTION
    </div>

</div>








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
document.getElementById("registerForm").addEventListener("submit", function(e) {

    let valid = true;

    let name = document.getElementById("name");
    let email = document.getElementById("email");
    let password = document.getElementById("password");

    let nameError = document.getElementById("nameError");
    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");

    // Reset
    name.classList.remove("input-error");
    email.classList.remove("input-error");
    password.classList.remove("input-error");

    nameError.style.display = "none";
    emailError.style.display = "none";
    passwordError.style.display = "none";


    // =========================
    // USERNAME REGEX
    // =========================

    let nameRegex = /^[A-Za-z][A-Za-z0-9_ ]{2,29}$/;

    if (!nameRegex.test(name.value.trim())) {

        name.classList.add("input-error");

        nameError.innerText =
            "⚠ Username 3-30 characters ka ho, letters/numbers/_ allowed hain";

        nameError.style.display = "block";

        valid = false;
    }


    // =========================
    // GMAIL REGEX
    // =========================

    let gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

    if (!gmailRegex.test(email.value.trim())) {

        email.classList.add("input-error");

        emailError.innerText =
            "⚠ Sirf valid Gmail address use karein (example@gmail.com)";

        emailError.style.display = "block";

        valid = false;
    }


    // =========================
    // PASSWORD REGEX
    // =========================
    // Minimum 8 characters
    // 1 uppercase
    // 1 lowercase
    // 1 number
    // 1 special character

    let passwordRegex =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!passwordRegex.test(password.value)) {

        password.classList.add("input-error");

        passwordError.innerText =
            "⚠ Password 8+ characters ka ho, uppercase, lowercase, number & special character zaroor ho";

        passwordError.style.display = "block";

        valid = false;
    }


    // =========================
    // STOP FORM IF INVALID
    // =========================

    if (!valid) {
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