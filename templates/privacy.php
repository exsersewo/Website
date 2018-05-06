<div id="legalblock">
    <div id="legal-header"></div><hr>
    <div id="legal-content"></div>
</div>
<style type="text/css">
#navbar{z-index:0 !important;}
#fader{z-index:1;}
#footer{display:none;}
</style>
<script type="text/javascript">
function LoadContent()
{
    if(window.location.href.indexOf('#privacy')>=0){
        $("#fader").css('display','block');$("#fader").css('opacity','0.5');
        $('#legal-header').html('<span>Privacy Policy</span>');
        $.get('static/legal/privacy.html',function(response){$("#legal-content").html(response);});
    }
    else if(window.location.href.indexOf('#terms')>=0)
    {
        $("#fader").css('display','block');$("#fader").css('opacity','0.5');
        $('#legal-header').html('<span>Terms of Service</span>');
        $.get('static/legal/terms.html',function(response){$("#legal-content").html(response);});
    }
    else{
        window.history.back();
    }
}
window.onload = LoadContent();
</script>