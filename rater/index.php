<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="basic.css">
<?php
  header("content-type:text/html;charset=utf-8");
  $con = mysqli_connect("localhost", "root", "123", "singers");
  mysqli_query($con, "set names 'utf8'");
  $ip = $_SERVER["REMOTE_ADDR"];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!array_key_exists("score", $_POST)) { echo "<script>alert('Please choose your point!');</script>"; }
    else { 
     $sql = "SELECT value from config";
     $retval = mysqli_query($con, $sql);
     $row = mysqli_fetch_row($retval);
     $now = $row[0];
     if (!$now) { echo "<script>alert('Waiting for collecting~~');</script>"; }
     else {
      $row = mysqli_fetch_row($retval);
      $num = $row[0];
      $sql = "SELECT * FROM rater$num WHERE ip='$ip'";
      $rs = mysqli_query($con,$sql);
      if (mysqli_num_rows($rs)>0) {  echo "<script>alert('You already have posted your point!');</script>"; }
      else {
        $grade = $_POST["score"];
        $sql = "INSERT INTO rater$num (ip, grade) VALUES ('$ip', $grade)";
        mysqli_query($con, $sql);
        echo "<script>alert('successfully post!');</script>";
      }
     }
    }
  }
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
    document.querySelector('html').style.fontSize =  window.innerWidth*100/750 + 'px';
    function refresh(val) {
      $('.score-button').removeClass("makegreen");
      $('label[for="score'+val+'"]').addClass("makegreen");
    }
    $(document).ready(()=>{
      refresh();
    });
  </script>
</head>
<body>
  <div style="text-align: center; padding-top:1rem; font-size:20px;">请给选手打分</div>
  <div class="be-center">
    <form class="score-box" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
      <section><label for="score0" class="score-button" onclick="refresh(0)">0</label><input type="radio" name="score" id="score0" value="0" hidden/></section>
      <section><label for="score1" class="score-button" onclick="refresh(1)">1</label><input type="radio" name="score" id="score1" value="1" hidden/></section>
      <section><label for="score2" class="score-button" onclick="refresh(2)">2</label><input type="radio" name="score" id="score2" value="2" hidden/></section>
      <section><label for="score3" class="score-button" onclick="refresh(3)">3</label><input type="radio" name="score" id="score3" value="3" hidden/></section>
      <section><label for="score4" class="score-button" onclick="refresh(4)">4</label><input type="radio" name="score" id="score4" value="4" hidden/></section>
      <section><label for="score5" class="score-button" onclick="refresh(5)">5</label><input type="radio" name="score" id="score5" value="5" hidden/></section>
      <section><label for="score6" class="score-button" onclick="refresh(6)">6</label><input type="radio" name="score" id="score6" value="6" hidden/></section>
      <section><label for="score7" class="score-button" onclick="refresh(7)">7</label><input type="radio" name="score" id="score7" value="7" hidden/></section>
      <section><label for="score8" class="score-button" onclick="refresh(8)">8</label><input type="radio" name="score" id="score8" value="8" hidden/></section>
      <section><label for="score9" class="score-button" onclick="refresh(9)">9</label><input type="radio" name="score" id="score9" value="9" hidden/></section>
      <section><label for="score10" class="score-button"  onclick="refresh(10)">10</label><input type="radio" name="score" id="score10" value="10" hidden/></section>
      <section><button id="submit" onclick="javascript::" >√</button></section>
    </form>
  </div>
</body>
</html>