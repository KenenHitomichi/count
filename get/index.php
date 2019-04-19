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
    }

    $(document).ready(()=>{determine();});
  </script>
</head>
<body>
  <form method="post" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <input id="action" type="hidden" name="action" value="">
    <input id="b0" class="button" type="button" onclick="sub('1')" value="begin">
    <input id="b1" class="button" type="button" onclick="sub('0')" value="end">
  </form>
</body>
</html>