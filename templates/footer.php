</div>
<script type="text/javascript">
var lelist=document.getElementById('legal-list');var lelink=document.getElementById('legalhotlink');var bbar=document.getElementById('blend-bar');
//
$(window).resize(function(){bbar.style.top=($('#li-nav').offset().top-3)+"px";});
//
$(window).scroll(function(){var navbar=$('#navbar');
if($(window).scrollTop()>150){navbar.css('position','fixed');navbar.css('top','0');navbar.css('width','100%');}
else{navbar.css('position','relative');}});
//
function toggleDsplay(){if(lelist.style.display!='none'){lelist.style.display='none';}else{lelist.style.display='table';}}
//
$('.legallink').on('click',function(){lelist.style.display='none';});
//
setInterval(function (){
if(window.location.href.includes('#privacy')){$('#lega-list').css('display', 'none');
$("#fader").css('display','block');$("#fader").css('opacity','0.5');$('#legalblock').css('display','block');$('#legal-header').html('<span>Privacy Policy</span>');
$.get('static/legal/privacy.html',function(response){$("#legal-content").html(response);});$('#fader').css('height',$(document).height());}
if(window.location.href.includes('#terms')){$('#lega-list').css('display', 'none');$("#fader").css('display','block');
$("#fader").css('opacity','0.5');$('#legalblock').css('display','block');$('#legal-header').html('<span>Terms of Service</span>');
$.get('static/legal/terms.html',function(response){$("#legal-content").html(response);});$('#fader').css('height',$(document).height());}},500);
//
$('#fader').on('click',function(){$('#legalblock').css('display','none');$('#fader').css('display','none');
if(window.location.href.includes('#privacy')){updateUrl(window.location.href.substr(0,window.location.href.length-"#privacy".length));}
if(window.location.href.includes('#terms')){updateUrl(window.location.href.substr(0,window.location.href.length-"#terms".length));}$('#fader').css('display','none');$('#legal-list').css('display','none');});
//
$('#legal').on('click',toggleDsplay);
//
$(function(){bbar.style.top=($('#li-nav').offset().top-3)+"px";$.get('https://nekos.life/api/v2/cat',function(response){$("#nya").text(response.cat);});});
//
function updateUrl(url){history.pushState(null, null, url);}
</script>