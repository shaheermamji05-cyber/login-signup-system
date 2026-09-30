<?php 

session_start();



if(!isset($_SESSION["userid"])){
  header("location:login.php");
}

if(isset($_POST["btnlog"])){
    session_destroy();
      session_unset();

    header("location:login.php");
     exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Developer World | AI Console</title>

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
            --dark:#020304;
            --card:rgba(7,9,13,.82);
        }

        body{

            min-height:100vh;

            color:#fff;

            font-family:"Courier New",monospace;

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
                    rgba(212,175,55,.16),
                    transparent 30%
                ),

                radial-gradient(
                    circle at 85% 80%,
                    rgba(56,189,248,.16),
                    transparent 30%
                ),

                #020304;

            background-size:
                45px 45px,
                45px 45px,
                100% 100%,
                100% 100%;
        }


        /* GLOWING ORBS */

        body::before{

            content:"";

            position:fixed;

            width:500px;
            height:500px;

            border-radius:50%;

            background:var(--gold);

            filter:blur(130px);

            opacity:.13;

            top:-250px;
            left:-200px;

            pointer-events:none;

            animation:goldOrb 10s ease-in-out infinite alternate;
        }


        body::after{

            content:"";

            position:fixed;

            width:500px;
            height:500px;

            border-radius:50%;

            background:var(--sky);

            filter:blur(130px);

            opacity:.13;

            bottom:-250px;
            right:-200px;

            pointer-events:none;

            animation:skyOrb 10s ease-in-out infinite alternate;
        }


        @keyframes goldOrb{

            0%{
                transform:translate(0,0);
            }

            100%{
                transform:translate(180px,180px);
            }
        }


        @keyframes skyOrb{

            0%{
                transform:translate(0,0);
            }

            100%{
                transform:translate(-180px,-180px);
            }
        }


        /* NAVBAR */

        .navbar{

            height:75px;

            padding:0 7%;

            display:flex;

            align-items:center;

            justify-content:space-between;

            border-bottom:1px solid
                rgba(212,175,55,.15);

            background:rgba(2,3,4,.65);

            backdrop-filter:blur(15px);

            position:relative;

            z-index:10;
        }


        .logo{

            font-size:20px;

            font-weight:bold;

            letter-spacing:2px;

            color:var(--gold-light);

            text-shadow:
                0 0 15px rgba(212,175,55,.4);
        }


        .logo span{

            color:var(--sky);

        }


        .status{

            font-size:11px;

            color:#64748b;

            letter-spacing:1px;
        }


        .status span{

            color:var(--sky);

            text-shadow:
                0 0 10px var(--sky);

            animation:blink 1.5s infinite;
        }


        @keyframes blink{

            50%{
                opacity:.3;
            }
        }


        /* MAIN */

        .main{

            min-height:calc(100vh - 75px);

            display:flex;

            align-items:center;

            justify-content:center;

            padding:60px 20px;

            position:relative;

            z-index:2;
        }


        .dashboard{

            width:100%;

            max-width:1000px;

        }


        /* AI TERMINAL */

        .terminal{

            border:1px solid
                rgba(56,189,248,.18);

            border-radius:20px;

            background:rgba(5,7,10,.82);

            backdrop-filter:blur(20px);

            box-shadow:

                0 0 50px rgba(0,0,0,.7),

                0 0 80px rgba(56,189,248,.04);

            overflow:hidden;

            animation:cardIn .8s ease;
        }


        @keyframes cardIn{

            from{
                opacity:0;
                transform:translateY(25px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }
        }


        /* TERMINAL HEADER */

        .terminal-head{

            height:45px;

            display:flex;

            align-items:center;

            gap:8px;

            padding:0 18px;

            border-bottom:1px solid
                rgba(255,255,255,.06);

            color:#64748b;

            font-size:11px;
        }


        .dot{

            width:9px;

            height:9px;

            border-radius:50%;
        }


        .dot.gold{

            background:var(--gold);

            box-shadow:
                0 0 10px var(--gold);
        }


        .dot.sky{

            background:var(--sky);

            box-shadow:
                0 0 10px var(--sky);
        }


        .terminal-title{

            margin-left:10px;

            color:#475569;
        }


        /* CONTENT */

        .content{

            padding:55px;

            text-align:center;
        }


        .ai-tag{

            display:inline-block;

            padding:7px 15px;

            border:1px solid
                rgba(56,189,248,.3);

            border-radius:30px;

            color:var(--sky-light);

            font-size:10px;

            letter-spacing:2px;

            margin-bottom:25px;

            background:rgba(56,189,248,.04);

            box-shadow:
                0 0 20px rgba(56,189,248,.05);
        }


        .ai-tag::before{

            content:"● ";

            color:var(--sky);

            animation:blink 1.5s infinite;
        }


        /* WELCOME */

        .welcome{

            font-size:15px;

            color:#64748b;

            margin-bottom:12px;

            letter-spacing:2px;
        }


        .username{

            color:var(--gold-light);

            text-shadow:
                0 0 25px rgba(212,175,55,.35);
        }


        .main-title{

            font-size:clamp(35px,6vw,65px);

            line-height:1.1;

            font-weight:bold;

            letter-spacing:-2px;

            margin-bottom:20px;
        }


        .main-title span{

            color:var(--sky);

            text-shadow:
                0 0 30px rgba(56,189,248,.3);
        }


        .description{

            max-width:650px;

            margin:0 auto 35px;

            color:#64748b;

            font-size:13px;

            line-height:1.8;
        }


        /* PROFILE */

        .profile{

            display:flex;

            align-items:center;

            justify-content:center;

            gap:15px;

            margin-bottom:35px;
        }


        .avatar{

            width:50px;

            height:50px;

            border-radius:50%;

            display:flex;

            align-items:center;

            justify-content:center;

            border:1px solid var(--gold);

            color:var(--gold-light);

            font-size:18px;

            background:
                rgba(212,175,55,.06);

            box-shadow:
                0 0 20px rgba(212,175,55,.12);
        }


        .profile-info{

            text-align:left;
        }


        .profile-name{

            color:#fff;

            font-size:14px;

            font-weight:bold;
        }


        .profile-role{

            color:#64748b;

            font-size:10px;

            margin-top:4px;
        }


        /* BUTTON */

        .logout-btn{

            display:inline-block;

            padding:13px 28px;

            border-radius:10px;

            border:1px solid
                rgba(212,175,55,.7);

            background:
                linear-gradient(
                    90deg,
                    #a88319,
                    #e8c65a,
                    #b89427
                );

            background-size:200% 100%;

            color:#050505;

            font-family:"Courier New",monospace;

            font-weight:bold;

            letter-spacing:1px;

            cursor:pointer;

            transition:.4s;

            animation:buttonMove 4s ease infinite;
        }


        @keyframes buttonMove{

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


        .logout-btn:hover{

            transform:translateY(-3px);

            box-shadow:

                0 0 25px
                rgba(212,175,55,.3),

                0 0 45px
                rgba(56,189,248,.08);
        }


        /* CODE FOOTER */

        .code-line{

            margin-top:45px;

            padding-top:20px;

            border-top:1px solid
                rgba(255,255,255,.05);

            color:#334155;

            font-size:10px;

            letter-spacing:1px;
        }


        .code-line .gold{
            color:var(--gold);
        }


        .code-line .sky{
            color:var(--sky);
        }


        /* MOBILE */

        @media(max-width:600px){

            .navbar{

                padding:0 20px;
            }

            .status{

                display:none;
            }

            .main{

                padding:30px 15px;
            }

            .content{

                padding:40px 20px;
            }

            .main-title{

                font-size:36px;
            }

            .description{

                font-size:12px;
            }
        }

    </style>

</head>


<body>


<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        <?= $_SESSION["name"] ?><span>.DEV</span>
    </div>

    <div class="status">
        <span>●</span>
        AI CORE ONLINE
    </div>

</nav>



<!-- MAIN -->

<main class="main">

    <div class="dashboard">


        <div class="terminal">


            <!-- TERMINAL HEADER -->

            <div class="terminal-head">

                <div class="dot gold"></div>

                <div class="dot sky"></div>

                <div class="dot gold"></div>

                <div class="terminal-title">
                    developer_world.exe
                </div>

            </div>



            <!-- CONTENT -->

            <div class="content">


                <div class="ai-tag">
                    DEVELOPER NETWORK // ACCESS GRANTED
                </div>


                <div class="welcome">
                    Welcome back,
                    <span class="username">
                        <?= $_SESSION['name']?>
                    </span>
                </div>


                <h1 class="main-title">

                    Welcome To The
                    <br>

                    <span>Developer World</span>

                </h1>


                <p class="description">

                    Your developer profile is now connected to the
                    <b style="color:#cbd5e1;">AI Core</b>.
                    Build ideas, write code, solve problems and
                    turn imagination into real projects.

                </p>



                <!-- PROFILE -->

                <div class="profile">

                    <div class="avatar">
                        &lt;/&gt;
                    </div>

                    <div class="profile-info">

                        <div class="profile-name">
                            <?= htmlspecialchars($_SESSION['name']) ?>
                        </div>

                        <div class="profile-role">
                            DEVELOPER // AI ENTHUSIAST // CODE BUILDER
                        </div>

                    </div>

                </div>



                <!-- LOGOUT -->

                <form action="" method="post">

                    <button
                        type="submit"
                        name="btnlog"
                        class="logout-btn"
                    >
                        ./logout
                    </button>

                </form>



                <div class="code-line">

                    <span class="gold">&gt;</span>
                    system.status =
                    <span class="sky">"ONLINE"</span>
                    &nbsp;|&nbsp;

                    AI_CORE =
                    <span class="sky">"ACTIVE"</span>
                    &nbsp;|&nbsp;

                    ACCESS =
                    <span class="gold">"AUTHORIZED"</span>

                </div>


            </div>

        </div>

    </div>

</main>


</body>

</html>