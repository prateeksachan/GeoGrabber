
YUI().use('jsonp', 'node', function(Y) {
    var list = Y.one('#output');

    Y.jsonp(
        "https://api.instagram.com/v1/media/popular?client_id=70fd1ce846d641928bf0a047053cf62d&callback={callback}",
        function(data) {
            for (var i = 0; i < 10; i++) {
                list.append('<div class="ttl"><div class="ttlpadding"><div class="item">' + "<a href='" + data.data[i].images.standard_resolution.url +"' ><img src='" + data.data[i].images.thumbnail.url +"' /></a>" +"</div></div></div>");
            }
        }
    );
});


/*
https://api.instagram.com/v1/tags/puppy/media/recent?access_token=3622867.f59def8.b7faa133517b4842adaa7f4737ea2782"

https://api.instagram.com/v1/geographies/{geography id}/media/recent?client_id=CLIENT-ID
curl -F 'client_id=CLIENT-ID' \
     -F 'client_secret=CLIENT-SECRET' \
     -F 'object=geography' \
     -F 'aspect=media' \
     -F 'lat=35.657872' \
     -F 'lng=139.70232' \
     -F 'radius=1000' \
     -F 'callback_url=http://YOUR-CALLBACK/URL' \
     https://api.instagram.com/v1/subscriptions/
	 
	 
	 curl -F 'client_id=CLIENT-ID' \
     -F 'client_secret=CLIENT-SECRET' \
     -F 'object=user' \
     -F 'aspect=media' \
     -F 'verify_token=myVerifyToken' \
     -F 'callback_url=http://YOUR-CALLBACK/URL' \
     https://api.instagram.com/v1/subscriptions/
http://your-callback.com/url/?hub.mode=subscribe&hub.challenge=15f7d1a91c1f40f8a748fd134752feb3&hub.verify_token=myVerifyToken
https://api.instagram.com/v1/geographies/{geography id}/media/recent?client_id=CLIENT-ID
*/