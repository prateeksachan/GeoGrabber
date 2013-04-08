<?php
/*
$url="IIT+Delhi";
$command = "python try1.py ".$url;

$pid = system($command);
*/
$file = fopen("data.txt", "r");

$data = "";
while (!feof($file))
    $data = $data.fgets($file);

$new_data = explode("NEWTOPIC", $data);


$counter=0;
$topwords;
$topuser_array;
$topsources;
$tophashtag;

foreach ($new_data as $current_data)
{
    $arr=null; $i=0;   
    $current_data = explode("\n", $current_data);
    
    foreach($current_data as $now) {
    
		
        $items=explode("DATA",$now);
        if(count($items)==2)
		{
			$arr[$i-1]=$items[0];
		}
		$i++;
    }
	switch ($counter)
	{
		case 0:
		$topwords=$arr;
		break;
		case 1:
		$topuser_array=$arr;
		break;
		case 2:
		$topsources=$arr;
		break;
		case 3:
		$tophashtag=$arr;
		break;
	}
	$counter++;
    
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=1024" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>GeoGrabber</title>
    
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="css/current.css" rel="stylesheet" />
    
    <link rel="shortcut icon" href="favicon.png" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png" />
</head>

    <body class="impress-not-supported">



        <div id="impress">
            <div id="start" class="step">
                <div class="circleBase">
				<?php 
    			echo $_POST['search'];
				?>
				</div>
            </div>

			<div id="step2" class="step circle" data-x="320">
                <a href="#id1"><div class="circleid1"></div></a>
            </div>
            <div id="step3" class="step circle" data-x="-200">
                <a href="#id4"><div class="circleid4"></div></a>
            </div>
			<div id="step4" class="step circle" data-y="-250" data-x="60">
                <a href="#id2"><div class="circleid2"></div></a>
            </div>
			<div id="step5" class="step circle" data-y="250" data-x="60">
                <a href="#id3"><div class="circleid3"></div></a>
            </div> 
			<div class="step clearfix" id="id1" data-x="1100" data-y="0" data-scale="0.71" >
            	<a href="#/id1"><div class="circleid1 lfloat">
				 
                </div>
                </a>
            	<h1 class="lfloat">Top Words</h1>
                <div class="clr lfloat"></div>
                <div class="clrflt"></div>
                <div class="words rfloat" style="right:170px">
                	<ul>
				<?php 
					for ($i=0;$i<10;$i++)
					{
						if ($i<5)
						{
							echo '<li><a href="example.php?search='.$topwords[$i].'" target="_blank">'.$topwords[$i].'</a></li>';
						}
						if ($i==5)
						{
							echo "</ul></div><div class='words lfloat'><ul>";
						}
						if ($i>5)
						{
							echo '<li><a href="example.php?search='.$topwords[$i].'" target="_blank">'.$topwords[$i].'</a></li>';
						}
						
					}
				?>
                	</ul>
               	</div>
            </div>
			<div class="step clearfix" id="id2" data-x="1100" data-y="138" data-scale="0.71" >
            	<a href="#/id2" target="_blank"><div class="circleid2 lfloat"></div></a>
                <h1 class="lfloat">Most Mentioned Users</h1>
				<div class="clr lfloat"></div>
                <div class="words rfloat" style="right:170px">
                	<ul>
                <?php 
					for ($i=0;$i<10;$i++)
					{
						if ($i<5)
						{
							echo '<li><a href="example.php?search='.str_replace('@', '', $topuser_array[$i]).'" target="_blank">'.$topuser_array[$i].'</a></li>';
						}
						if ($i==5)
						{
							echo "</ul></div><div class='words lfloat'><ul>";
						}
						if ($i>5)
						{
							echo '<li><a href="example.php?search='.str_replace('@', '', $topuser_array[$i]).'" target="_blank">'.$topuser_array[$i].'</a></li>';
						}
						
					}
				?>
                	</ul>
				</div>
            </div>
            <div class="step clearfix" id="id3" data-x="1100" data-y="277" data-scale="0.71" >
            	<a href="/#id3"><div class="circleid3 lfloat"></div></a>
                <h1 class="lfloat">Top Sources</h1>
				<div class="clr lfloat"></div>
                <div class="words rfloat" style="right:170px">
                	<ul>
                <?php 
					for ($i=0;$i<10;$i++)
					{
						if ($i<5)
						{
							echo '<li><a href="example.php?search='.$topsources[$i].'" target="_blank">'.$topsources[$i].'</a></li>';
						}
						if ($i==5)
						{
							echo "</ul></div><div class='words lfloat' ><ul>";
						}
						if ($i>5)
						{
							echo '<li><a href="example.php?search='.$topsources[$i].'" target="_blank">'.$topsources[$i].'</a></li>';
						}
						
					}
				?>
                	</ul>
				</div>
            </div>
			<div class="step clearfix" id="id4" data-x="1100" data-y="416" data-scale="0.71" >
            	<a href="/#id4"><div class="circleid4 lfloat"></div></a>
                <h1 class="lfloat">Top Hash Tags</h1>
				<div class="clr lfloat"></div>
                <div class="words rfloat" style="right:170px"">
                	<ul>
   				<?php 
					for ($i=0;$i<10;$i++)
					{
						if ($i<5)
						{
							echo '<li><a href="example.php?search='.str_replace('#', '', $tophashtag[$i]).'" target="_blank">'.$tophashtag[$i].'</a></li>';
						}
						if ($i==5)
						{
							echo "</ul></div><div class='words lfloat'><ul>";
						}
						if ($i>5)
						{
							echo '<li><a href="example.php?search='.str_replace('#', '', $tophashtag[$i]).'" target="_blank">'.$tophashtag[$i].'</a></li>';
						}
						
					}
				?>
                	</ul>
				</div>
            </div>

        </div>

        <div class="fallback-message">
            <p>Your browser <b>doesn't support the features required</b> by impress.js, so you are presented with a simplified version of this presentation.</p>
            <p>For the best experience please use the latest <b>Chrome</b>, <b>Safari</b> or <b>Firefox</b> browser.</p>
        </div>

		<script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/impress.js"></script>
        <script type="text/javascript">impress().init();</script>
        <script type="text/javascript">
		$(".circleNode").blur();
		</script>
	</body>
</html>




