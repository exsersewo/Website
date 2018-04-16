
<div id="footer">
<span>&copy; Exsersewo/Skuld 2018</span>
<div id="legalstuff"><span><a href="/privacy#privacy">Privacy Policy</a></span><span style="width:120px;"><a href="/privacy#terms" style="width:120px;">Terms of Service</a></span></div>
</div>
<script type="text/javascript">
//
$('#fader').on('click',function(){window.history.back();});
//
$.get('https://nekos.life/api/v2/cat',function(response){$("#nya").text(response.cat);});
//
function updateUrl(url){history.pushState(null, null, url);}
</script>
</body>