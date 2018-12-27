<style type="text/css">
    #box{width:95%;margin:0 auto;background-color:RGBA(0,0,0,0.5);color:white;margin-bottom:25px;}
    #box span{text-align:center;}
    #content{padding:5px;text-align:center;}
    a{color:white;}
</style>

<div id="box" style="display: none;">
    <span><h2 style="padding-top:25px;">Awe heck, something happened (∩︵∩)</h2></span>
    <hr>
    <div id="content">
        <p>We couldn't find what you were looking for. :(</p>
        <p>Have a cat instead I guess: </p>
        <img id="kitty" height="400" width="auto" src=""/>
    </div>
</div>

<script type="text/javascript">
window.addEventListener('DOMContentLoaded',function(){$(function(){$('#box').fadeIn(1200,"linear");});});
$.get('https://aws.random.cat/meow', function(response)
{
    let img = response['file'];
    
    $("#kitty").attr('src', img);
});
</script>