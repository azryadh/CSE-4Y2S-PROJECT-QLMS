<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script>
        window.Laravel =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <link href="{{asset('old/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('old/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <style>

        body {
            background-color: #FFF;
        }
        .bg-cream {
            background-color: bisque;
            padding-bottom: 100px;
        }
        .mr-t-20 {
            margin-top: 20px;
        }
        .navbar-default .navbar-nav > li > a,
        .navbar-default .navbar-nav > li > a:hover {
            color: #FFF;
        }
        .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
            background-color: transparent;
            color: #FFF;
        }
        .btn-wave,
        button.btn-wave {
            position: relative;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            vertical-align: middle;
            z-index: 1;
            -webkit-transition: .3s ease-out;
            transition: .3s ease-out;
            border: none;
            text-decoration: none;
            color: #fff;
            background-color: #26a69a;
            text-align: center;
            letter-spacing: .5px;
            -webkit-transition: .2s ease-out;
            transition: .2s ease-out;
            cursor: pointer;
        }
        .btn-wave:hover,
        .btn-wave:active,
        .btn-wave:focus,
        .btn-wave.hover {
            background-color: #2bbbad;
            color: #FFF !important;
            box-shadow: 0 3px 3px 0 rgba(0,0,0,0.14), 0 1px 7px 0 rgba(0,0,0,0.12), 0 3px 1px -1px rgba(0,0,0,0.2);
            outline: none !important;
        }

        /* ============================= */
        /*===== Login Page =====*/
        /* ============================= */
        .form-control {
            border-radius: 0 !important;
        }
        .register-page .btn-default {
            float: left;
        }
        .user-register-heading {
            text-transform: uppercase;
            font-size: 17px;
            color: #424242;
            letter-spacing: 0.6px;
        }
        .remember-me {
            color: #424242;
        }
        .login-page {
            width: 360px;
            margin: auto;
            margin-top: 4%;
            border-radius: 4px;
            padding: 10px 45px 45px;
            background-color: #FFF;
            box-shadow: 0 7px 24px 2px rgba(0, 0, 0, 0.1), 5px 7px 17px 2px rgba(0, 0, 0, 0.15);
        }
        .login-logo {
            margin: 0 auto;
        }
        .form ::-webkit-input-placeholder {
            color: rgba(0,0,0,0.6) !important;
        }
        .login-page .logo {
            margin-bottom: 20px;
        }
        .login-page .form {
            position: relative;
            z-index: 1;
            max-width: 360px;
        }
        .login-page .form input {
            outline: 0;
            background: #F2F2F2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            font-size: 14px;
        }
        .login-form .checkbox {
            text-align: left;
            margin-bottom: 26px;
        }
        .login-form .checkbox label {
            margin-top: 4px;
            padding: 0 13px 0 2px;
            vertical-align: middle;
        }
        .login-form .checkbox input {
            width: auto;
            margin: 0;
            padding: 0;
        }
        .form button {
            padding: 8px 0;
            width: 100%;
            text-transform: uppercase;
            margin-bottom: 12px;
            letter-spacing: 1px;
        }

        /* ============================= */
        /*===== Register Page =====*/
        /* ============================= */
        .register-page {
            background-color: #424242;
            padding: 20px 45px 45px;
            border-radius: 4px;
            margin-top: 4%;
            box-shadow: 0 7px 24px 2px rgba(0, 0, 0, 0.1), 5px 7px 5px 0 rgba(0, 0, 0, 0.15);
        }
        .register-page label {
            color: #FFF;
        }
        .register-page .form-control::-webkit-input-placeholder {
            opacity: 0.8;
        }
        .register-page .form-control {
            background-color: #F2F2F2;
        }
        .register-page .user-register-heading {
            font-size: 22px;
        }
        .register-page .logo img {
            margin: 0 auto;
        }
        .user-register-heading {
            font-weight: 400;
            padding-bottom: 15px;
            border-bottom: 1px solid #F2F2F2;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }
        .register-page .btn-group {
            width: 100%;
        }
        .register-page .btn {
            width: 48%;
            margin: 20px;
            margin-bottom: 0;
            font-weight: 600;
            letter-spacing: 2px;
            /*display: inline-block;*/
        }
        @media (max-width: 767px) {
            .register-page .btn {
                width: 100%;
                margin: 0;
                margin-bottom: 10px;
                /*display: inline-block;*/
            }
        }
        .logo-main-block {
            margin-top: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f2f2f2;
        }
        .logo-main-block img {
            margin: 0 auto;
        }

        .navbar-header .heading {
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 20px;
            font-weight: 600;
            color: #FFF;
        }
        .nav-bar {
            padding: 7px 0 3px;
            box-shadow: 0 4px 14px 0 rgba(0,0,0,0.08);
            background-color: #424242;
        }
        .home-main-block blockquote {
            margin-top: 50px;
            margin-left: 120px;
            width: 60%;
            box-shadow: 0 3px 10px 0 rgba(0,0,0,0.1);
            border-color: #424242;
        }
        @media (max-width: 992px) {
            .home-main-block blockquote {
                margin-left: 0;
            }
        }
        .main-block-heading {
            font-size: 60px;
            text-transform: uppercase;
            letter-spacing: 10px;
        }
        .home-main-block .btn_block {
            margin-top: 50px;
            text-align: center;
            margin-left: -15px;
        }
        .home-main-block .btn_block .btn {
            padding: 10px 50px;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 1px;
        }
        #question_block {
            padding: 10px 0 30px;
        }
        .question {
            margin-bottom: 15px;
        }
        .myQuestion {
            display: none;
        }
        .myQuestion.active {
            display: block;
        }
        .myQuestion blockquote {
            margin: 20px 0 32px;
        }
        .myQuestion form {
            margin-left: 5px;
        }
        .myQuestion input {
            margin-bottom: 15px;
        }
        .myQuestion span:nth-child(odd) {
            color: black;
        }
        .myQuestion span {
            font-size: 16px;
            margin-left: 5px;
        }
        .myQuestion .btn-block {
            margin: 25px 20px 0 10px;
            font-weight: 600;
            font-size: 17px;
            letter-spacing: 2px;
            padding: 4px 0;
        }
        .myQuestion .code {
            background-color: #f1f1f1;
            padding: 12px;
        }
        #clock span {
            margin-top: 4px;
            color: #FFF;
            font-size: 22px;
            letter-spacing: 3px;
            font-weight: 600;
        }

        /*======== Session Modal ========*/
        .sessionmodal {
            visibility: hidden;
            position: fixed;
            top: -120px;
            left: 0;
            right: 0;
            margin: 0 auto;
            width: 400px;
            border-radius: 2px;
            font-size: 16px;
            letter-spacing: 0.5px;
            text-transform: capitalize;
            box-shadow: 3px 4px 14px 0 rgba(0,0,0,0.12);
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -ms-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
            transition-delay: 0.3s;
            text-align: center;
            z-index: 9999999999;
            font-weight: 600;
        }
        .sessionmodal.active {
            visibility: visible;
            top: 10px;
        }
        .navbar-collapse.collapse {
            display: block !important;
        }
        @media (max-width: 992px){
            .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
                color: #FFF;
                background-color: transparent;
            }
            .main-block-heading {
                font-size: 40px;
                letter-spacing: 5px;
            }
        }

        /*======== Quiz Main Block ======*/
        .topic-block {
            margin-bottom: 25px !important;
        }
        .quiz-main-block {
            margin-top: 30px;
        }
        .card {
            position: relative;
            margin: .5rem 0 1rem 0;
            background-color: rgba(255, 255, 255, 0.8);
            -webkit-transition: -webkit-box-shadow .25s;
            transition: -webkit-box-shadow .25s;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -ms-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            border-radius: 2px;
            box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2);
        }
        .card .card-content {
            padding: 24px;
            border-radius: 0 0 2px 2px;
        }
        .white-text {
            color: #fff !important;
        }
        .card .card-content .card-title {
            display: block;
            line-height: 32px;
            margin-bottom: 8px;
            font-size: 22px;
        }
        .card .card-content p {
            margin: 0;
            color: rgba(255,255,255,0.8);
            font-size: 14px;
        }
        .card .card-action:last-child {
            border-radius: 0 0 2px 2px;
        }
        .card .card-action {
            position: relative;
            border-top: 1px solid rgba(255, 255, 255, 0.4);
            padding: 8px 24px;
        }
        .card .card-action a {
            color: #FFF;
        }
        .topic-detail {
            margin-top: 13px;
            list-style-type: none;
            -webkit-padding-start: 0;
        }
        .topic-detail li {
            margin-bottom: 6px;
            position: relative;
        }
        .topic-detail li .fa {
            position: absolute;
            right: 0;
            top: 3.5px;
            color: #424242;
        }
        .result-table {
            margin: 40px 0;
        }
        .question-block-tabs {
            padding: 20px 0;
        }
        .question-block-tabs .tab-content {
            padding: 20px 0;
        }
    </style>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="navbar-header">
                            <!-- Branding Image -->

                            @if($topic)
                                <h4 class="heading">{{$topic->title}}</h4>

                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                <li id="clock"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

        <div class="container">

                <div class="home-main-block">
                    <?php
                        use Illuminate\Support\Facades\Auth;
                        $users =  App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->first();
                        $que =  App\Question::where('topic_id',$topic->id)->first();
                    ?>
                    @if(!empty($users))
                        <div class="alert alert-danger">
                            You have already Given the test ! Try to give other Quizes
                            <a href="javascript: window.close()" class="btn btn-danger">Close</a>
                        </div>
                    @else
                        <div id="question_block" class="question-block">
                            <question :topic_id="{{$topic->id}}" ></question>
                        </div>
                    @endif
                    @if(empty($que))
                        <div class="alert alert-danger">
                            No Questions in this quiz
                            <a href="javascript: window.close()" class="btn btn-danger">Close</a>
                        </div>

                    @endif
                </div>

        </div>
</div>
<!-- Begin page -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('old/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('old/bootstrap.min.js')}}"></script>
<script src="{{asset('old/jquery.cookie.js')}}"></script>
<script src="{{asset('old/jquery.countdown.js')}}"></script>

@if(empty($users) && !empty($que))
    <script>
        var topic_id = {{$topic->id}};
        var timer = {{$topic->timer}};
        $(document).ready(function() {
            function e(e) {
                (116 == (e.which || e.keyCode) || 82 == (e.which || e.keyCode)) && e.preventDefault()
            }
            setTimeout(function() {
                $(".myQuestion:first-child").addClass("active");
                $(".prebtn").attr("disabled", true);
            }, 2500), history.pushState(null, null, document.URL), window.addEventListener("popstate", function() {
                history.pushState(null, null, document.URL)
            }), $(document).on("keydown", e), setTimeout(function() {
                $(".nextbtn").click(function() {
                    var e = $(".myQuestion.active");
                    $(e).removeClass("active"), 0 == $(e).next().length ? (Cookies.remove("time"), Cookies.set("done", "Your Quiz is Over...!", {
                        expires: 1
                    }), location.href = "{{$topic->id}}/finish") : ($(e).next().addClass("active"), $(".myForm")[0].reset(),
                        $(".prebtn").attr("disabled", false))
                }),
                    $(".prebtn").click(function() {
                        var e = $(".myQuestion.active");
                        $(e).removeClass("active"),
                            $(e).prev().addClass("active"), $(".myForm")[0].reset()
                        $(".myQuestion:first-child").hasClass("active") ?  $(".prebtn").attr("disabled", true) :   $(".prebtn").attr("disabled", false);
                    })
            }, 700);
            var i, o = (new Date).getTime() + 6e4 * timer;
            if (Cookies.get("time") && Cookies.get("topic_id") == topic_id) {
                i = Cookies.get("time");
                var t = o - i,
                    n = o - t;
                $("#clock").countdown(n, {
                    elapse: !0
                }).on("update.countdown", function(e) {
                    var i = $(this);
                    e.elapsed ? (Cookies.set("done", "Your Quiz is Over...!", {
                        expires: 1
                    }), Cookies.remove("time"), location.href = "{{$topic->id}}/finish") : i.html(e.strftime("<span>%H:%M:%S</span>"))
                })
            } else Cookies.set("time", o, {
                expires: 1
            }), Cookies.set("topic_id", topic_id, {
                expires: 1
            }), $("#clock").countdown(o, {
                elapse: !0
            }).on("update.countdown", function(e) {
                var i = $(this);
                e.elapsed ? (Cookies.set("done", "Your Quiz is Over...!", {
                    expires: 1
                }), Cookies.remove("time"), location.href = "{{$topic->id}}/finish") : i.html(e.strftime("<span>%H:%M:%S</span>"))
            })
        });
    </script>
@else
    {{ "" }}
@endif



    <script type="text/javascript" language="javascript">
        // Right click disable
            $(function() {
                $(this).bind("contextmenu", function(inspect) {
                    inspect.preventDefault();
                });
            });
            // End Right click disable
        </script>

<script type="text/javascript" language="javascript">
    //all controller is disable
    $(function() {
        var isCtrl = false;
        document.onkeyup=function(e){
            if(e.which == 17) isCtrl=false;
        }

        document.onkeydown=function(e){
            if(e.which == 17) isCtrl=true;
            if(e.which == 85 && isCtrl == true) {
                return false;
            }
        };
        $(document).keydown(function (event) {
            if (event.keyCode == 123) { // Prevent F12
                return false;
            }
            else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
                return false;
            }
        });
    });
    // end all controller is disable
</script>

</body>
</html>
