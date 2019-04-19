<!DOCTYPE html>
<html>
<head>
  <title></title>
<?php
  $raternum = 6;
  $audiencenum = 10;
  header("content-type:text/html;charset=utf-8");
  $con = mysqli_connect("localhost", "root", "123", "singers");
  mysqli_query($con, "set names 'utf8'");
  $sql = "SELECT value from config where name='index'";
  $retval = mysqli_query($con, $sql);
  $row = mysqli_fetch_row($retval);
  $num = $row[0];
  for ($i=0; $i < $num; $i++) {
    $xuhao = $i+1;
    echo "The grade of singer $xuhao :<br/>";
    $acrater = 0; $acaudi = 0;
    $rater_point = 0; $audience_point = 0;
    $min = 10;
    $sql = "SELECT grade from rater$i";
    $retval = mysqli_query($con, $sql);
    while ($row=mysqli_fetch_row($retval)) {
      $acrater++;
      $rater_point = $rater_point + (int)$row[0];
      if (((int)$row[0])<$min) $min=(int)$row[0];
    }
    if ($acrater < $raternum) $rater_point = $rater_point + 10*($raternum - $acrater);
    $rater_point = $rater_point - $min;

    $sql = "SELECT grade from singer$i";
    $retval = mysqli_query($con, $sql);
    while ($row=mysqli_fetch_row($retval)) {
      $acaudi++;
      $audience_point = $audience_point + (int)$row[0];
    }
    $audience_point = $audience_point / $acaudi * (int)($audiencenum/10);
    $point = $rater_point+$audience_point;
    echo "&nbsp; &nbsp; &nbsp; &nbsp;grades from raters: $rater_point&nbsp; &nbsp;&nbsp; &nbsp;grades from audience: $audience_point&nbsp; &nbsp;&nbsp; &nbsp;total grades: $point<br/>";
    echo "<br/>";
  }
?>
</head>
<body>

</body>
</html>