<style type="text/css">
#navbar{top:0;height:50px;padding:0;margin:0 auto;background-color:#00d2ff;z-index:1;position:sticky;display:block;width:100%;}
#li-nav{display:table;margin:0 auto;width:auto;text-align:center;height:50px;padding:0;}
#blend-bar{background-color:black;box-shadow:0px 1px 1px black;-moz-box-shadow:0px 1px 1px black;width:100%;height:1px;}
#logo{margin-top:0;background-color:#4873ff;height:150px;display:inline-table;width:100%;text-align:center;}
#logo span a{text-decoration:none;color:white;cursor:default;text-align:center;margin:0 auto;}
#logo span a:hover{text-shadow:0px 0px 30px #1500ef;}
#logo span{display:table-cell;vertical-align:middle;color:white;text-shadow:0px 0px 10px #1500ef;}
#li-nav li{display:table-cell;vertical-align:middle;width:150px !important;}
#li-nav li a{color:black;text-align:center;text-decoration:none;height:50px;width:150px;}
#li-nav li:hover{background-color:#00ffd6;}
#logo{text-align:center;font-size:50px;}
#legallist{padding:0;margin:0;width:150px;text-align:center;height:100px;position:absolute;z-index:1;}
#legallist li{padding:0;margin:0;width:150px !important;display:table-row;height:50px;background-color:#00d2ff;}
#legallist li:hover{background-color:#00ffd6;}
#legallist li a{display:table-cell;color:black;text-decoration:none;vertical-align:middle;padding:5px;width:100%;}
#legalblock{position:absolute;padding:5px;margin:0 auto;align-self:middle;left:0;right:0;width:1000px;height:auto;background-color:#6a7fdb;box-shadow:0px 0px 5px black;color:white;margin:0 auto;z-index:5;}
#legal-header{text-align:center;font-size:30px;font-weight:bold;}
#legal-content{padding-left:1em;padding-right:1em;padding-bottom:1em;}
#legal-content h4{padding-left:2em;}
#nya{position:absolute !important;font-size:15px;top:125px;right:10px;width:auto;}
#backwrap{-webkit-filter:blur(5px);-moz-filter:blur(5px);-o-filter:blur(5px);-ms-filter:blur(5px);filter:blur(5px);position:fixed;padding:0;margin:0;top:0;overflow:hidden;z-index:-1;}
#fader{position:fixed;}
.legallink{height:50px;}
#content{margin-bottom:20px;}
#footer{margin:0 auto;width:95%;height:20px;display:block;color:white;background-color:rgba(0,0,0,0.5);position:relative;bottom:0;z-index:10;padding-top:5px;padding-bottom:5px;bottom:0;margin-top:auto;}
#footer span{padding-left:5px;display:inline;}
#footer span a:visited{color:white;}
#legalstuff{margin:0 auto;padding:0;display:block;position:relative;top:-20px;width:220px;right:0;font-size:15px;}
#legalstuff span{margin:0 auto;padding:0;width:100px;display:inline-block;text-align:center;color:white;}
#legalstuff span a{margin:0 auto;text-align:center;width:100px;color:white;}
#backwrap{width:100%;height:100%;position:fixed;background-image:url('./content/img/back.png');background-repeat:no-repeat;top:0;z-index:-1;}
@media screen and (max-width: 580px)
{
    #footer{font-size:12px;}
    #footer span{top:0;display:block;float:left;width:200px;}
    #legalstuff{width:180px;top:0;display:block;float:right;}
    #legalstuff span{font-size:10px; margin-right:0; width:90px!important;}
    #legalstuff span a{width:90px!important;}
}
@media screen and (max-width: 500px)
{
    #legallist{width:81px;}
    #legallist li a{padding:0;}
    #legal-content h1{font-size:12px;}    
    #legal-content h4, #legal-content p, #legal-content ol li{font-size:10px;}
    #legalblock{width:95%;}
    #legalstuff{top:-14px;}
}
@media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
    body{margin:0 auto;padding:0;margin-top:-14px;}
}
</style>
    <div id="logo">
        <span><a href="/">Skuld</a></span>
        <div id="nya"></div>
    </div>
    <div id="blend-bar"></div>
    <nav id="navbar">
        <ul id="li-nav" align="center">
            <li><a href="/">Home</a></li>
            <li><a href="./commands">Commands</a></li>
            <li class="strikethrough"><a>Dashboard</a></li>
        </ul>
    </nav>
    <script type="text/javascript">
        if(/MSIE \d|Trident.*rv:/.test(navigator.userAgent))
        {
            $(window).scroll(function(){
                var nav = $("#navbar");
                var offset = $(window).scrollTop();
                if(offset>=154)
                {
                    nav.css('position','fixed');
                }
                else if (offset<154)
                {
                    nav.css('position','relative');
                }
            });
        }
    </script>
<div id="content">
    <div id="backwrap"></div>