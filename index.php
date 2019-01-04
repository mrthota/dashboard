// A template for the dashboard

<a href="<?php echo $_SERVER["REQUEST_URI"];?>">Refresh</a>
<br></br>
<br></br>

<?php

// Get cURL resource

//$url = 'http://localhost:9200';
//$url = 'http://localhost:9200/_cat/health?h=status';
$opt = '/_cat/health?h=status';

// CSS Styles
echo "<style> .blue {   background: blue; } </style>";

$llc_servers = array(
  array('QA', 'cmftes00.homedepot.com:9200', 'e5admin'),
  array('Q1', 'cmf1es00.homedepot.com:9200', 'e5admin'),
  array('Q2', 'cmf2es00.homedepot.com:9200', 'e561admin'),
  array('Q3', 'cmf3es00.homedepot.com:9200', 'e5admin'),
  array('QP-A', 'ccliqpe0.homedepot.com:9200', 'e5admin'),
  array('QP-S', 'ccliqpf0.homedepot.com:9200', 'e5admin'),
  array('PR-A', 'cclidie0.homedepot.com:9200', 'E559Adm19n'),
  array('PR-S', 'cclidif0.homedepot.com:9200', 'e559adm1n'),
  //array('Local', 'host.docker.internal:9200', 9200,'e5admin'),
  //array('Local', 'localhost:9200', 9200,'e5admin'),
  //array('Local', 'localhost:9200', 9200,'e5admin'),
  //array('Local', 'localhost:9200', 9200,'e5admin'),
  //array('Local', 'localhost:9200', 9200,'e5admin'),
  //array('Local', 'localhost:9200', 9200,'e5admin'),
);


$qp_servers = array(
  array('QP-A', 'ccliqpe0.homedepot.com:9200', 'e5admin'),
  array('QP-S', 'ccliqpf0.homedepot.com:9200', 'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
);


$pr_servers = array(
  array('PR-A', 'cclidie0.homedepot.com:9200', 'E559Adm19n'),
  array('PR-S', 'cclidif0.homedepot.com:9200', 'e559adm1n'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),
  array('Local', 'localhost:9200', 9200,'e5admin'),

);

$redis_servers = array(
  array('QA', 'ccliqae1.homedepot.com', 6379),
  array('QP-A', 'com-redis-sa-qp-atc.homedepot.com', 10001),
  array('QP-S', 'com-redis-sa-qp-ssc.homedepot.com', 10001),
  array('PR-A', 'com-redis-sa-pr-atc.homedepot.com', 10001),
  array('PR-S', 'com-redis-sa-pr-ssc.homedepot.com', 10001),

);

//echo '<body link="grey">';
//border="0" cellspacing="0" cellpadding="4"
//echo '<table style="width:100%" border="1" cellspacing="4" cellpadding="4" >';
echo '<table border="5" border="1" frame="void" rules="border" style="width:50%" cellpadding="2" cellspacing="4">';
echo '<CAPTION><font size=6>Service Availability Dashboard</font></CAPTION>';
echo '    <tr><th colspan="100%" ><font size=6>Elastic</font></th></tr>';

// --- LLC Servers
echo '<tr>';
echo '<td bgcolor="orange" ><font face="verdana" size=5 >LLC</font></td>';
foreach ($llc_servers as list($a, $b, $c))
{

$curl = curl_init();
// Set some options - we are passing in a useragent too here

curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $b.$opt,
    CURLOPT_HTTPAUTH => CURLAUTH_ANY,
//CURLOPT_USERPWD  => "$username:$password",
//CURLOPT_RETURNTRANSFER   => true,
    CURLOPT_USERPWD  => "es_admin:".$c
));
// Send the request & save response to $resp
$resp = curl_exec($curl);

if ( !empty($resp) )
 {
//echo '<td><font color=#e40000>'.$resp.'</font></td>';
echo '<td align="center" bgcolor='.$resp.'><font face="verdana" size=3 >'.$a.'</font></td>';
 }
else
 {
//echo '<td><font face="verdana" size=5 color=grey> <a color=grey href= '. curl_error($curl) '>'.$a.'</a></font></td>';
echo '<td align="center"><font face="verdana" size=3 color=grey>'.$a.'</font></td>';
 }
curl_close($curl);

}
echo '</tr>';

// --- QP Servers
echo '<tr>';
echo '<td class="blue" ><font face="verdana" size=5 >QP</font></td>';
foreach ($qp_servers as list($a, $b, $c))
{

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $b.$opt,
    CURLOPT_HTTPAUTH => CURLAUTH_ANY,
    CURLOPT_USERPWD  => "es_admin:".$c
));
// Send the request & save response to $resp
$resp = curl_exec($curl);

if ( !empty($resp) )
 {
echo '<td align="center" bgcolor='.$resp.'><font face="verdana" size=3 >'.$a.'</font></td>';
 }
else
 {
echo '<td align="center"><font face="verdana" size=3 color=grey>'.$a.'</font></td>';
 }
curl_close($curl);

}
echo '</tr>';

// --- PROD Servers
echo '    <tr><th colspan="100%" bgcolor="grey" ><font size=6></font></th></tr>';
echo '    <tr><th colspan="100%" ><font size=6>Cassandra</font></th></tr>';
echo '<tr>';
echo '<td bgcolor="orange" ><font face="verdana" size=5 >QP</font></td>';
foreach ($pr_servers as list($a, $b, $c))
{

$curl = curl_init();
// Set some options - we are passing in a useragent too here

curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $b.$opt,
    CURLOPT_HTTPAUTH => CURLAUTH_ANY,
    CURLOPT_USERPWD  => "es_admin:".$c
));
// Send the request & save response to $resp
$resp = curl_exec($curl);

        // Check if any error has occurred
//        if (curl_errno($curl))
//        {
//            $ela_error = curl_error($curl);
//        }
//        else
//        {
            // cURL executed successfully
//            print_r(curl_getinfo($curl));
//        }

if ( !empty($resp) )
 {
echo '<td align="center" bgcolor='.$resp.'><font face="verdana" size=3 >'.$a.'</font></td>';
 }
else
 {
echo '<td align="center" bgcolor="grey"><font face="verdana" size=3 >'.$a.'</font><details Hide><summary><font size=1>>>></summary><p>'.curl_error($curl).'</font></p></details></td>';
 }
curl_close($curl);

}



echo '</tr>';

// --- PROD Servers
echo '    <tr><th colspan="100%" bgcolor="brown" ><font size=6></font></th></tr>';
echo '    <tr><th colspan="100%" ><font size=6>Redis</font></th></tr>';
echo '<tr>';
echo '<td bgcolor="orange" ><font face="verdana" size=5 >QA</font></td>';
foreach ($redis_servers as list($a, $b, $c))
{

$redis=new Redis();
//$redis->connect($b, $c);
  try
  {
    //$redis->connect('127.0.0.1', 6379); -- Do not display any Warnings or Errors. Just Catch them
    @$redis->connect($b, $c);
  }
  catch (Exception $e)
  {
    //die( "Cannot connect to redis server:".$e->getMessage() );
    if ( (strpos($e->getMessage(), 'nodename nor servname provided') !== true) or (strpos($e->getMessage(), 'Connection refused') !== true) )
    {
      echo '<td align="center" bgcolor="grey"><font face="verdana" size=3 >'.$a.'</font><details Hide><summary><font size=1>>>></summary><p>'.$e->getMessage().'</font></p></details></td>';
      continue;
    }
    else
    {
      echo '<td align="center"><font face="verdana" size=3 color=blue>'.$a.'</font></td>';
      continue;
    }
    //die( " ");
  break;
  }

  //$redis->setex('somekey', 60, 'some value');
    $cache = $redis->ping();
    if ($cache === "+PONG")
    {
    echo '<td align="center" bgcolor="green"><font face="verdana" size=3 >'.$a.'</font></td>';
    }
    else
    {
      echo '<td align="center" bgcolor="yellow"><font face="verdana" size=3 >'.$a.'</font></td>';
    }

}

// Loop should go above this point

echo '</tr>';
echo '</table>';

        // Check if any error has occurred
//        if (curl_errno($curl))
//        {
//            echo 'cURL error: ' . curl_error($curl);
//        }
//        else
//        {
            // cURL executed successfully
//            print_r(curl_getinfo($curl));
//        }

?>
