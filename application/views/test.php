<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<style>
    .selector{
        background-color: #dea239;
    }
</style>
<div>
    <p>Nội dung thẻ p</p>
    <br>
    <input class="sub" type="submit" value="láy content">
</div>

<script language="JavaScript">
    // $(*);
    // $('#id');
    // $('.class');
    // $('element');
    // $('#id,.class');

  $('.sub').click(function (){
      $('p').html("đây là nội dung mới");
      $content = $('p').html();
      alert($content);

  })



</script>
</body>
</html>