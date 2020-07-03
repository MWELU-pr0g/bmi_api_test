<?php

if (isset($_GET['query']) && $_GET['query'] != '') {

  $param = $_GET['query'];
  $query_fields = [
    'autoCorrect' => 'true',
    'pageNumber' => 1,
    'pageSize' => 10,
    'safeSearch' => 'false',
    'q' => $_GET['query']
  ];


  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost/bmi/web/member/list",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => $query_fields,
  ));

  $response = curl_exec($curl);


  $arr = json_decode($response, 1);

  // var_dump($arr);die();
  curl_close($curl);
  //  print($arr);

  $data = $arr['data'];

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Member Search</title>
</head>

<body>
  <form action="" method="get">
    <label for="query">Enter your query string:</label>
    <input id="query" type="text" name="query" />
    <br />
    <button type="submit" name="submit" style="color: blueviolet;">Search</button>
  </form>
  <br />
  <?php
  if (!empty($data)) {
    echo '<b>Here is your Search :</b>';
    foreach($data as $post)  {
        if (strpos(strtolower($param), strtolower($post['name'])) !== false) {
          echo '<h3>' . $post['name'] . '</h3>';
          echo '<p>' . $post['weight'] . '</p>';
          echo '<hr>';
        }
        
    }
  }
  ?>
</body>



</html>