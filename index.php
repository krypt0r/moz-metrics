<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Start your project here-->
    <!-- Horizontal material form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <br />
    <p align="center" class="h1 text-monospace">
      Check Moz Metrics FREE
    </p>
    <br />
    <br />

    <div style="width:50%; margin:auto;">
      <!-- Grid row -->
      <div class="form-group row">
          <!-- Material input -->
          <label for="inputEmail3MD" class="col-sm-2 col-form-label">Website: </label>

          <div class="col-sm-10">
              <div class="md-form mt-0">
                  <input name="url" type="url" class="form-control" id="inputEmail3MD" placeholder="URL">
              </div>
          </div>
      </div>
      <!-- Grid row -->

      <!-- Grid row -->

      <!-- Grid row -->

      <!-- Grid row -->
      <div class="form-group row">
          <div class="col-sm-10">
              <button name="submit" type="submit" class="btn btn-success btn-md">Check</button>
          </div>
      </div>
      <!-- Grid row -->
    </div>
</form>
<!-- Horizontal material form -->
    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>



<?php
$siteUrl = $siteDA = $sitePA = $siteTitle = $siteLastVisited = $siteBL = "";

if(isset($_POST['submit'])){
  $objectURL = $_POST['url'];

  $accessID = "mozscape-55fbae0a17";
  $secretKey = "f0994f6e645d5314ca89cc60cafee8e7";
  $expires = time() + 3000;
  $stringToSign = $accessID."\n".$expires;
  $binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
  $urlSafeSignature = urlencode(base64_encode($binarySignature));
  $cols = "103079217157";
  // Put it all together and you get your request URL.
  // This example uses the Mozscape URL Metrics API.
  $requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($objectURL)."?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;
  // Use Curl to send off your request.
  $options = array(
  	CURLOPT_RETURNTRANSFER => true
  	);
  $ch = curl_init($requestUrl);
  curl_setopt_array($ch, $options);
  $content = curl_exec($ch);
  curl_close($ch);
  $siteDetails = json_decode($content);

  $siteUrl    = $siteDetails->uu;
  $siteDA     = $siteDetails->pda;
  $sitePA     = $siteDetails->upa;
  $siteBL     = $siteDetails->uid;
  $siteTitle  = $siteDetails->ut;
  //$siteKeyw   = $siteDetails->
  //$siteDesc   = $siteDetails->
  //$siteLastVisited = $siteDetails->ulc;
}


?>
<br />
<div align="center">
  <p class="h1">MOZ Metrics : </p>
  <br />
  <table border="1" id="table table-hover">
     <tbody>
             <tr><td class="title">Site Url</td><td><?php echo $siteUrl; ?></td></tr>
             <tr><td class="title">Site Title</td><td><?php echo $siteTitle; ?></td></tr>
             <tr><td class="title">Domain Authority(DA)</td><td><?php echo $siteDA; ?></td></tr>
             <tr><td class="title">Page Authority(PA)</td><td><?php echo $sitePA; ?></td></tr>
             <!-- <tr><td class="title">IP Address</td><td> </td></tr>
             <tr><td class="title">Alexa Rank</td><td> </td></tr> -->
             <tr><td class="title">Back Links</td><td><?php echo $siteBL; ?></td></tr>
             <!-- <tr><td class="title">Last Visited</td><td><?php echo $siteLastVisited; ?></td></tr> -->

             <!-- <tr><td class="title">Site Keywords</td><td></td></tr>
             <tr><td class="title">Site Description</td><td></td></tr> -->
             <tr></tr>
             <!-- <tr><td class="title">Google Cache Date</td><td><font color="red"><strong>N/A</strong></font></td></tr>
             <tr><td class="title"> Bing Indexed ? </td><td> <font color="red">✘</font></td></tr>
             <tr><td class="title">Yahoo Indexed ?</td><td><font color="red">✘</font></td></tr>
             <tr><td class="title">Google Indexed ?</td><td><font color="#32CD32">✔</font></td></tr> -->
     </tbody>
   </table>
</div>

</body>

</html>
