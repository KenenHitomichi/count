<!DOCTYPE html>
<html>
<head>
  <title></title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<?php
  header("content-type:text/html;charset=utf-8");
  $con = mysqli_connect("localhost", "root", "123", "singers");
  mysqli_query($con, "set names 'utf8'");
  $sql = "SELECT value from config";
  $retval = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($retval);
  $now = $row[0];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $y = $_POST["action"];
    $sql = "UPDATE config SET value =$y where name='start'";
    $now = $_POST["action"];
    mysqli_query($con, $sql);
    $row = mysqli_fetch_array($retval);
    if ($y) {
      $temp = (int)$row[0];
      $sql = "CREATE TABLE singer$temp
(
inx INT NOT NULL AUTO_INCREMENT,
ip VARCHAR(60) NOT NULL unique,
grade INT NOT NULL,
PRIMARY KEY ( inx )
)";
      mysqli_query($con, $sql);
      $sql = "INSERT INTO singer$temp (ip, grade) VALUES ('None', 10)";
      mysqli_query($con, $sql);
      $sql = "CREATE TABLE rater$temp
(
inx INT NOT NULL AUTO_INCREMENT,
ip VARCHAR(60) NOT NULL unique,
grade INT NOT NULL,
PRIMARY KEY ( inx )
)";
      mysqli_query($con, $sql);
    }
    else {
      $temp = (int)$row[0] + 1;
      $sql = "UPDATE config SET value =$temp where name='index'";
      mysqli_query($con, $sql);
    }
  }
?>
  <link rel="stylesheet" type="text/css" href="basic.css">

  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
      <script type="text/javascript">
    document.querySelector('html').style.fontSize =  window.innerWidth*100/750 + 'px';
  </script>

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