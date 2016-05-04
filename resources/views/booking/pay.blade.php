<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <title>頁面轉跳中，請稍候...</title>
</head>
<body>
    <p>頁面轉跳中，請稍候...</p>
    <form id="form" action="https://capi.pay2go.com/MPG/mpg_gateway" method="POST">
        @foreach ($attributes as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach
    </form>
    <script>
        document.querySelector('#form').submit();
    </script>
</body>
</html>
