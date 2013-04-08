<?php
require_once 'GMaps.php';		
require_once 'Twitter7.php';		
require_once 'FlickrScript.php';		
// Your Google key
$google_key = 'AIzaSyBv58bNQZbX0SxC3gVFZgqjrkuUqAjqfHw';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=utf" />
<title>Geograbber</title>
<link media="screen" href="css/styles.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="js/jquery.infinitescroll.min.js"></script>
<script type="text/javascript" >
$(function(){
	var $container = $('#displayarea');
	$('div.feed').css({ opacity: 0 });
	$container.imagesLoaded(function(){
	$('div.feed').animate({ opacity: 1 });
	  $container.masonry({
		itemSelector : '.feed',
		columnWidth : 240
	  });
	});
$('input[name=search]').focus(function(){
    if ($(this).val() == 'Search')
        $(this).val('');
});
$('input[name=search]').blur(function(){
    if ($(this).val() == '')
        $(this).val('Search');
});
});
</script>
</head>
<body>
  <div id="container">
<?php 
    $search= ($_GET['search']);

if (!empty($search)) {

    // Get the Google Maps Object
    $GMap = new GMaps($google_key);
//	echo('Reached here');
    if ($GMap->getInfoLocation($search)) {
/*
        //echo 'Address: '.$GMap->getAddress().'<br>';
        //echo 'Country name: '.$GMap->getCountryName().'<br>';
        //echo 'Country name code: '.$GMap->getCountryNameCode().'<br>';
        //echo 'Administrative area name: '.$GMap->getAdministrativeAreaName().'<br>';
        //echo 'Postal code: '.$GMap->getPostalCode().'<br>';    
        //echo 'Latitude: '.$GMap->getLatitude().'<br>';
        //echo 'Longitude: '.$GMap->getLongitude().'<br>';
*/		
		$TwitterData=new TwitterMap($search,$GMap->getLatitude(),$GMap->getLongitude());
		
		
	
/*		
		echo '<pre>';
		print_r($TwitterData->ret1)."\n";
		echo '</pre>';

		echo '<pre>';
		print_r($TwitterData->ret2)."\n";
		echo '</pre>';
*/
		
		$Twitter_dataset1=$TwitterData->ret1;
		$Twitter_dataset2=$TwitterData->ret2;
		$Twitter_dataset_total=array_merge($Twitter_dataset1->results,$Twitter_dataset2->results);
		//echo(count($Twitter_dataset1->results)).'</br>';
		//echo(count($Twitter_dataset2->results)).'</br>';
		//echo(count($Twitter_dataset_total)).'</br>';

//		echo '<pre>';
//		print_r($Twitter_dataset_total)."\n";
//		echo '</pre>';


    } else {
        echo "The response of Google Maps is empty";
    }

		
	
		$hashtags;
		$count;
		$ret1=$Twitter_dataset_total;
		//FINDING HASHTAGS FROM TWEETS		
		echo "<div id='displayarea'>";
		foreach($ret1 as $x)
		{

			$array = explode(" ", $x->text);
			foreach($array as $element) {
				if (strcmp(substr($element, 0, 1), "#") == 0) {
					$hashtags[$count] = substr($element, 1, strlen($element)-1);
					$count++;
				}
			}

		//	print_r($hashtags);

					//TWITTER;
					// echo "<div class='user'><a href=\"","http://www.twitter.com/".$x->from_user,"\" target=\"_blank\"><img border=\"0\" width=\"48\" class=\"twitter\" src=\"",$x->profile_image_url,"\" title=\"", $x->from_user." (".$x->from_user_name.")", "\" /></a>\n";
					//$text = preg_replace('/\s+#(\w+)/',' <a href="http://search.twitter.com/search?q=%23$1">#$1</a>', $x->text);
					//echo "<div class='text'>".$text."</div>";

		}
			
		//PRINTING TWEETS
		
		//FINDING TWEETS WITH SAME NAME
		$name_tweets;
		foreach ($ret1 as $x) {
		
			if(!isset($name_tweets[$x->from_user])) {
				$name_tweets[$x->from_user] = $x->text;
			} else {
				$name_tweets[$x->from_user] = $name_tweets[$x->from_user]."NEWTWEET".$x->text;
			}			
		}
		
		
		//PRINTING REDUCED TWEETS
		//echo ('NEW_DIVIDE').'</br>';
		foreach($name_tweets as $x=>$y)
		{
			foreach ($ret1 as $p)
			{
			
				if($p->from_user==$x)
				{
					echo "<div class='feed'><div class='twitter_feed'><div class='item'><a href=\"","http://www.twitter.com/".$p->from_user,"\" target=\"_blank\"><img src=\"",str_replace('_normal', '', $p->profile_image_url),"\" title=\"", $p->from_user." (".$p->from_user_name.")", "\" /></a>";
					$text = preg_replace('/\s+#(\w+)/',' <a href="http://localhost/Hack/example.php?q=%23$1">#$1', $y);
					$text = preg_replace('#@([\\d\\w]+)#', '<a href="http://twitter.com/$1" target="_blank">$0</a>', $text);
					
					echo "<div class='clr'></div>";
					echo "<div class='tweet'><a href=\"","http://www.twitter.com/".$p->from_user,"\" target=\"_blank\">".$p->from_user_name."</a><br />";
					$arr=explode("NEWTWEET",$text);

					$i=0;
					foreach($arr as $exp)
					{
						echo "<div class='text'>".$exp."</a>";
						echo "</div>";
						echo "<div class='clr1'></div>";					
						
					}
					echo "</div></div></div></div><div class='clrflt'></div>";
					break;
				}
			
			}

		}	
		//FINDING FREQUENCY FOR CORRESPONDING HASHTAGS
		$sort_hash;
		$sort_number;
		$count1 = 0;
		$repeat = false;
		$var = 0;
		foreach($hashtags as $hash) {
			for($i = 0; $i < count($sort_hash); $i++) {
				//echo "In FOR loop\n";
				//echo count($sort_hash)."\n";
				if (strcmp($sort_hash[$i], $hash) == 0) {
					$repeat = true;
					$var = $i;
					break;
				}
			$var = $i;
			}

			if ($repeat) {
				$sort_number[$var]++;
				$repeat = false;
			} else {
				$sort_hash[$count1] = $hash;
				$sort_number[$count1] = 1;
				$count1++;
			}
		}

//		print_r($sort_hash);
//		print_r($sort_number);

//		$sort_number = array(3, 2, 5, 6, 8, 1, 4);
//		$sort_hash = array("a", "b", "c", "d", "e", "f", "g");


		//SORTING THE TAGS BASED ON FREQUENCY
		$value = count($sort_number);
		do {
			$swapped = false;
			for ($i = 1; $i < $value; $i++) {
				if ($sort_number[$i-1] < $sort_number[$i]) {
					$temp1 = $sort_number[$i];
					$temp2 = $sort_hash[$i];
					$sort_number[$i] = $sort_number[$i-1];
					$sort_hash[$i] = $sort_hash[$i-1];
					$sort_number[$i-1] = $temp1;
					$sort_hash[$i-1] = $temp2;
					$swapped = true;
				}
			}
			$value -= 1;
		} while($swapped);


		//PRINTING SORTED HASHTAGS
		/*
		for ($i = 0; $i < count($sort_number); $i++) {
			echo $sort_number[$i]."\n";
			echo $sort_hash[$i]."\n";
		}
		*/
		echo('MAX FREQUENCY TAG').$sort_hash[0].' '.$sort_hash[1].'</br>';
		//SEARCHING FLICKR FOR MAX FREQUENCY HASHTAGS
		$i=0;$OPTIMIZED_SEL=2;
		$OPTIMIZED_FILTER=0;
		$url_array;$metadata_array;
		
		$f=new FlickrManager();		
		for($i=0;$i<$OPTIMIZED_SEL;$i++)
		{
			$OPTIMIZED_FILTER=6*$sort_number[$i];
			
			$r=$f->getPhotos($sort_hash[$i].','.$search);
			$md=$f->metadata_holder;

///			echo('PRINTING STUDAPPA').'</br>';
//			echo count($md);
			if(count($url_array)==0)
			{
				if(count($r)!=0)
				{
				$url_array=array_slice( $r ,0,$OPTIMIZED_FILTER);
				$metadata_array=array_slice( $md ,0,$OPTIMIZED_FILTER);
				///echo(count($r)).'</br>';
				}
			}
			else
			{
				if(count($r)!=0)
				{
				$url_array=array_merge( $url_array,array_slice( $r  , 0,$OPTIMIZED_FILTER) );
				$metadata_array=array_merge( $metadata_array,array_slice( $md  , 0,$OPTIMIZED_FILTER) );
	//			echo 'Merging';
				}
			}
		}
		
	//	echo('url_array'.count($url_array)).'</br>';
	//	echo('metadata_array'.count($metadata_array)).'</br>';
/*		
		print_r($url_array);
		echo('<pre>');
		print_r($metadata_array)."\n";
		echo('</pre>');
	*/	
		//FLICKR
		for ( $i=0;$i<count($url_array);$i++ )
		{

			$temp=$metadata_array[$i]->attributes();
//			echo'ReachedHere';
			http://www.flickr.com/people/{user-id}/ - profile
			//$pic_url='http://farm'.$temp->farm.'.staticflickr.com/'.$temp->server.'/'.$temp->id.'_'.$temp->secret.'_m.jpg';	
			echo "<div class='feed'><div class='flickr_feed'><div class='item'><a href=\"","http://www.flickr.com/people/".$temp['owner'],"\" target=\"_blank\"><img border=\"0\" width=\"200\" class=\"twitter\" src=\"",$url_array[$i],"\" title=\"", $temp['title']." (".$temp['title'].")", "\" /></a>\n";
			$text = preg_replace('/\s+#(\w+)/',' <a href="http://search.twitter.com/search?q=%23$1">#$1</a>', $temp['title']);
			echo "<div class='clr'></div>";
			echo "<div class='tweet'><div class='text'>".$text."</div></div></div></div></div><div class='clrflt'></div>";					
		}
		echo '</div>';
		
/*		
		$url = 'http://localhost/HackU/Twitter7.php';
				//what post fields?
				$fields = array(
				   'latitude'=>$GMap->getLatitude(),
				   'longitude'=>$GMap->getLongitude()
				);

				//build the urlencoded data
				$postvars='';
				$sep='';
				foreach($fields as $key=>$value) 
				{ 
				   $postvars.= $sep.urlencode($key).'='.urlencode($value); 
				   $sep='&'; 
				}


				//open connection
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch,CURLOPT_POST,count($fields));
				curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);

				//execute post
				$result = curl_exec($ch);

				//close connection
				curl_close($ch);
		
*/		
		/*
		$urlnew='https://maps.googleapis.com/maps/api/place/search/xml?key='.$google_key.'&location='.$GMap->getLatitude().','.$GMap->getLongitude().'&radius=250&sensor=false';
		
		$tcurl=curl_init();
		
		curl_setopt($tcurl, CURLOPT_PROXY, "10.10.78.22");
		curl_setopt($tcurl, CURLOPT_PROXYPORT, 3128);  
		curl_setopt( $tcurl, CURLOPT_URL, $urlnew );
		curl_setopt( $tcurl, CURLOPT_RETURNTRANSFER, 1 );

		$tresult = curl_exec( $tcurl );

		echo 'Echoing Result<br>';
		
		curl_close( $tcurl );
		
        $reslts=simplexml_load_string($tresult);
		
		echo($tresult);
		
		if($tresult==null)
		echo ('I\'ve got data');
		
		print_r($reslts);
		*/
		
    
}