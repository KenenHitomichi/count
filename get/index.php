<!DOCTYPE html>
<html>
<head>
  <title></title>
<?php
  header("content-type:text/html;charset=utf-8");
  $now = "0";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $now = $_POST["action"];
  }
?>
  <link rel="stylesheet" type="text/css" href="basic.css">
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
    function sub(v) {
      
      $('#action').attr("value",v);
      $("#form").submit();
    }

    function determine() {
      var y = <?php echo $now ?>;
      $("#b"+y).removeClass("hide");
      $("#b"+y).siblings(".button").addClass("hide");
      if (!y) $(".time").addClass("hide");
    }

    $(document).ready(()=>{
      var time = 30;
      determine();
      var y = <?php echo $now ?>;
      if (y==1) {
        var s = setInterval(()=>{
          time--;
          $(".time").html(time);
          if (!time) { clearInterval(s); sub('0'); }
        }, 1000);
      }
    });
  </script>
</head>
<body>
  <main class="main">
    <form method="post" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
      <input id="action" type="hidden" name="action" value="">
      <input id="b0" class="button" type="button" onclick="sub('1')" value="start">
      <input id="b1" class="button" type="button" onclick="sub('0')" value="stop">
    </form>
    <section class="time">
      30
    </section>
  </main>
</body>
</html>