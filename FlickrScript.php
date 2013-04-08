<?php

$flickr_api_key="4e34f38630d1f46bc8558cf931f649e6";

class FlickrManager
{
	
		//ARRAY FOR HOLDING METADATA OF IMAGES
		var $metadata_holder;
		//$tag=$_POST["tags"];
		//http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=ff3537288b23f8ef704d4fde43953e50&tags=hacku&format=rest
		
		
		
		function getPhotos($tag)
		{
		$this->metadata_holder=null;
		$urlArray=null;
		$lbd=null;
		$request_url='http://api.flickr.com/services/rest/?method=flickr.photos.search & api_key=4e34f38630d1f46bc8558cf931f649e6'.'& tags='.$tag.'& format=rest ';

		$curl=curl_init();

		curl_setopt($curl, CURLOPT_PROXY, "10.10.78.22");
		curl_setopt($curl, CURLOPT_PROXYPORT, 3128);  

		curl_setopt( $curl, CURLOPT_URL, $request_url );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

		$result = curl_exec( $curl );

		curl_close( $curl );
		
/*		
		function  retreivePhotoURL($farm_id,$server_id,$id,$secret)
		{
		
			 								
			
//				echo($picUrl);
				return $picUrl;
				
		}
*/

		$photodata=new SimpleXMLElement($result);
//		echo ($request_url);


		$lbd=$photodata->photos->photo;

//		echo '<pre>';
//		print_r($this->lbd).'\n';
//		echo '<pre>';

		
//		echo(count($lbd));		
		
		
		$urlArray;
		$i=0;		
		for ( $i=0;$i<count($lbd);$i++ )
		{
			$temp=$lbd[$i]->attributes();
			$this->metadata_holder[$i]=$lbd[$i];
//			echo'ReachedHere';
			$pic_url='http://farm'.$temp->farm.'.staticflickr.com/'.$temp->server.'/'.$temp->id.'_'.$temp->secret.'_m.jpg';	
			$urlArray[$i]=$pic_url;			
//			echo "<div class='user'><a href=\"","http://www.twitter.com/".$x->from_user,"\" target=\"_blank\"><img border=\"0\" width=\"200\" class=\"twitter\" src=\"",$pic_url,"\" title=\"", 'DEFAULT'." (".'DEFAULT'.")", "\" /></a>\n";
//			$text = preg_replace('/\s+#(\w+)/',' <a href="http://search.twitter.com/search?q=%23$1">#$1</a>', $temp['title']);
//			echo "<div class='text'>".$text."</div>";					
		}

		return $urlArray;
		}


}

?>