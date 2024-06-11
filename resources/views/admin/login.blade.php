<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>後台管理系統</title>
    <script>
        function check() {
            let userId = document.getElementById("managerId");
            var pwd = document.getElementById("pwd");

            if (userId.value == "") {
                userId.focus();
                document.getElementById("userIdMsg").innerHTML = "<font color='red'>請輸入帳號</font>";
                return false;
            } else {
                document.getElementById("userIdMsg").innerHTML = "";
            }

            if (pwd.value == "") {
                pwd.focus();
                document.getElementById("pwdMsg").innerHTML = "<font color='red'>請輸入密碼</font>";
                return false;
            } else {
                document.getElementById("pwdMsg").innerHTML = "";
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="text-center text-primary">後台管理系統</div>
        </div>
        <div class="row">
            <div class="text-center">
                <form action="/admin/login" method="post" onsubmit="return check()">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2">帳號</div>
                        <div class="col-8 col-sm-9 col-md-10">
                            <input type="text" class="form-control" name="userId" id="managerId" value="{{ old('userId') }}">
                            <div id="userIdMsg">
                                @if($errors->has("userId"))
                                <div class="text-danger">{{ $errors->first("userId") }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2">密碼</div>
                        <div class="col-8 col-sm-9 col-md-10">
                            <input type="password" class="form-control" name="pwd" id="pwd" value="{{ old('pwd') }}">
                            <div id="pwdMsg">
                                @if($errors->has("pwd"))
                                <div class="text-danger">{{ $errors->first("pwd") }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2">驗證碼</div>
                        <div class="col-2">
                            <input type="text" name="code" class="form-control">
                            @if($errors->has("code"))
                            <div class="text-danger">{{ $errors->first("code") }}</div>
                            @endif
                        </div>
                        <div class="col-2">
                            <img class="captcha" src="/captcha/flat" onclick="this.src='/captcha/flat?' + Math.random()" style="cursor: pointer;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2"></div>
                        <div class="col-8 col-sm-9 col-md-10">
                            <input type="submit" class="btn btn-primary" value="確定">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>