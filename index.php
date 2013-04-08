<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=utf" />
<title>Geograbber</title>
<link media="screen" href="css/styles.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" >
$(function(){
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
    	<div class="mainpage"></div>
        <div id="masthead_bar">
            <div id="masthead">
                <form method="post" action="py.php"><input id="searchbox" type="text" name="search" class="search" value="Search"></form>
            </div>
        </div>
        <div id="credit">
            &copy; 2012. All Rights Reserved.<br />
            GroGrabber&reg; v1.0<br />
            <a href="https://www.facebook.com/waseem.mohd.370" target="_blank">Mohd. Waseem</a>&nbsp;&bull;&nbsp;<a href="https://www.facebook.com/prateek.sachan" target="_blank">Prateek Sachan</a>&nbsp;&bull;&nbsp;<a href="https://www.facebook.com/sehajsingh.kalra" target="_blank">Sehaj Singh Kalra</a>
        </div>
    </div>
</body>
</html>