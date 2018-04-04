<style type="text/css">
#header, nav{margin:0 auto;padding:0;}
#navbar{background-color:#00d2ff;}
#li-nav{display:table;margin:0 auto;width:auto;text-align:center;height:50px;padding:0;}
#blend-bar{position:absolute;box-shadow:0px 2px 2px black;-moz-box-shadow:0px 2px 2px black;width:100%;height:2px;}
#logo{background-color:#4873ff;height:150px;display:inline-table;width:100%;}
#logo span a{text-decoration:none;color:white;cursor:default;}
#logo span a:hover{text-shadow:0px 0px 30px #1500ef;}
#logo span{display:table-cell;vertical-align:middle;color:white;text-shadow:0px 0px 10px #1500ef;}
#li-nav li{display:table-cell;vertical-align:middle;width:150px !important;}
#li-nav li a{color:black;text-align:center;text-decoration:none;height:50px;width:150px;}
#li-nav li:hover{background-color:#00ffd6;}
#logo{text-align:center;font-size:50px;}
#legal-list{padding:0;margin:0;width:150px;text-align:center;height:100px;position:absolute;}
#legal-list li{padding:0;margin:0;width:150px !important;display:table-row;height:50px;background-color:#00d2ff;}
#legal-list li:hover{background-color:#00ffd6;}
#legal-list li a{display:table-cell;color:black;text-decoration:none;vertical-align:middle;padding:5px;width:100%;}
#legalblock{position:absolute;padding:5px;margin:0 auto;align-self:middle;left:0;right:0;width:1000px;height:auto;background-color:#6a7fdb;box-shadow:0px 0px 5px black;color:white;margin:0 auto;z-index:2;}
#legal-header{text-align:center;font-size:30px;font-weight:bold;}
#legal-content{padding-left:1em;padding-right:1em;padding-bottom:1em;}
#legal-content h4{padding-left:2em;}
#nya{position:absolute !important;font-size:15px;top:125px;right:5px;width:auto;}
#backdropgif{-webkit-filter:blur(5px);-moz-filter:blur(5px);-o-filter:blur(5px);-ms-filter:blur(5px);filter:blur(5px);position:fixed;padding:0;margin:0;overflow:hidden;z-index:-1;}
</style>
<nav id="header">
    <div id="logo">
        <span><a href="/">Skuld</a></span>
        <div id="nya">
            
        </div>
    </div>
    <div id="blend-bar"></div>
    <div id="navbar">
        <ul id="li-nav" align="center">
            <li><a href="/">Home</a></li>
            <li><a href="./commands">Commands</a></li>
            <li class="strikethrough"><a>Dashboard</a></li>
            <li id='legal'>
                <p><a id="legalhotlink" href='#'>Legal</a></p>
                <ul id="legal-list" style="display:none;list-style:none;">
                    <li><a class="legallink" href="#privacy">Privacy Policy</a></li>
                    <li><a class="legallink" href="#terms">Terms of Service</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div id="content">    
<div id="legalblock" style="display:none;">
    <div id="legal-header"></div><hr>
    <div id="legal-content"></div>
</div>