<!DOCTYPE html>
<html>
<head>
  <title>Is it RESTful?</title>
  <link rel="stylesheet" href="style.css" type="text/css">
  <script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-179193-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>
<body>

<h3>Is it RESTful?</h3>
<form action="/" method="GET">
  {{^url}}Gimme a URL: {{/url}}
  <input type="text" name="url" length="30" value="{{url}}">
</form>

{{#phrase}}
<h2>{{phrase}}</h2>

<p class="share">Share the RESTy love! <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-text="I made a #REST interface and all I got was this lousy URL" data-url="http://isitrestful.com/">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></p>
{{/phrase}}

<p class="why"><a href="why.html">why?</a></p>

</body>
</html>
