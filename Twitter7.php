<?php
class TwitterMap
{
//		var $qe='';
//		var $geo='';//$_POST['latitude'].','.$_POST['longitude'].',1mi';
		
//		var $url =''; //"http://search.twitter.com/search.json?q=".$qe."&geocode=".$geo;
//		 var $name_url='';
		
		var $ret1,$ret2;

						function processing($url,$name_url)
				{
				
				$curl = curl_init();

				curl_setopt($curl, CURLOPT_PROXY, "10.10.78.22");
				curl_setopt($curl, CURLOPT_PROXYPORT, 3128);  

				curl_setopt( $curl, CURLOPT_URL, $url );
				curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

				$result = curl_exec( $curl );

				curl_close( $curl );


				$this->ret1 =  json_decode($result);
		/*
				if($result==null)
				echo "I've not got data";
				else
				echo "I.ve got data";
		*/
				
				$curl_name = curl_init();

				curl_setopt($curl_name, CURLOPT_PROXY, "10.10.78.22");
				curl_setopt($curl_name, CURLOPT_PROXYPORT, 3128);  

				curl_setopt( $curl_name, CURLOPT_URL, $name_url );
				curl_setopt( $curl_name, CURLOPT_RETURNTRANSFER, 1 );

				$result2 = curl_exec( $curl_name );

				curl_close( $curl_name );


				$this->ret2 =  json_decode($result2);
				
				
				/*
				echo "<pre>";
				print_r($ret1)."\n";
				echo "</pre>";
				*/
				
		/*
				foreach($ret1->results as $x)
				{

					 echo "<div class='user'><a href=\"","http://www.twitter.com/".$x->from_user,"\" target=\"_blank\"><img border=\"0\" width=\"48\" class=\"twitter\" src=\"",$x->profile_image_url,"\" title=\"", $x->from_user." (".$x->from_user_name.")", "\" /></a>\n";
					$text = preg_replace('/\s+#(\w+)/',' <a href="http://search.twitter.com/search?q=%23$1">#$1</a>', $x->text);
					echo "<div class='text'>".$text."</div>";
				}
		*/

				
			}

	
	
			function TwitterMap($tag,$lat,$longt)
				{
				

		
		
			$geo=$lat.','.$longt.',1mi';
			$url="http://search.twitter.com/search.json?q=".''."&geocode=".$geo.'&rpp=20 & include_entities=1';				
			$name_url="http://search.twitter.com/search.json?q=".$tag.'&rpp=20 & include_entities=1';
			$this->processing($url,$name_url);
		}
	
		/*	foreach ($ret->entry as $twit1) {

				$description = $twit1->content;

				$description = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $description);  
				$description = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" >\\2</a>'", $description);
				$description = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" >\\2</a>'", $description);

				$retweet = strip_tags($description);
				$message = $row['content'];

				echo "<div class='user'><a href=\"",$twit1->author->uri,"\" target=\"_blank\"><img border=\"0\" width=\"48\" class=\"twitter\" src=\"",$twit1->link[1]->attributes()->href,"\" title=\"", $twit1->author->name, "\" /></a>\n";
				echo "<div class='text'>".$description."<div class='description'>From: ", $twit1->author->name," <a href='http://twitter.com/home?status=RT: ".$retweet."' target='_blank'><img src='retweet.png' style='border:none;' /></a></div><strong>".$datediff."</strong></div><div class='clear'></div></div>";

			}

		*/
}

?>

<html>




</html>







