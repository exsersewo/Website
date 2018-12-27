<style type="text/css">
#moduleselect{margin:0 auto;padding:0;}
#moduleselect{z-index:1;}
#moduleselect{text-align:center;}
#backwrap{z-index:-1000;}
#commandtable{width:1296px;display:table;table-layout:fixed;left:0;right:0;z-index:-1;margin:0 auto;}
#commandtable thead tr{position:relative;display:block;width:inherit;z-index:1;}
#commandtable tr{text-align:center;}
#commandtable th{text-decoration:underline;font-weight:bold;text-align:center;background: #FFF;}
#commandtable tbody{display:block;position:relative;width:inherit;}
#commandtable tbody tr td a{z-index:1;}
#commandtable tbody td:nth-child(1),#commandtable thead th:nth-child(1){min-width: 140px;}
#commandtable tbody td:nth-child(2),#commandtable thead th:nth-child(2){min-width: 513px;}
#commandtable tbody td:nth-child(3),#commandtable thead th:nth-child(3){min-width: 300px;}
#commandtable tbody td:nth-child(4),#commandtable thead th:nth-child(4){min-width: 200px;}
#commandtable tbody td:nth-child(5),#commandtable thead th:nth-child(5){min-width: 120px;}
#commandtable tr:nth-child(even){background: #CCC}
#commandtable tr:nth-child(odd){background: #FFF}
.last-row{height:22px;}
@media screen and (max-width: 1280px)
{
    #commandtable{width:100%;left:0;right:0;}
    #commandtable tbody td:nth-child(1),#commandtable thead th:nth-child(1){width:10%;min-width:140px;}
    #commandtable tbody td:nth-child(2),#commandtable thead th:nth-child(2){width:45%;min-width:513px;}
    #commandtable tbody td:nth-child(3),#commandtable thead th:nth-child(3){width:20%;min-width:100px;}
    #commandtable tbody td:nth-child(4),#commandtable thead th:nth-child(4){width:20%;min-width:100px;}
    #commandtable tbody td:nth-child(5),#commandtable thead th:nth-child(5){width:10%;min-width:80px;}
}
@media screen and (max-width: 1024px)
{
    #commandtable{width:100%;}
    #commandtable tbody td:nth-child(1),#commandtable thead th:nth-child(1){width:10%;min-width:140px;}
    #commandtable tbody td:nth-child(2),#commandtable thead th:nth-child(2){width:40%;min-width:120px;}
    #commandtable tbody td:nth-child(3),#commandtable thead th:nth-child(3){width:10%;min-width:30px;}
    #commandtable tbody td:nth-child(4),#commandtable thead th:nth-child(4){width:20%;min-width:30px;}
    #commandtable tbody td:nth-child(5),#commandtable thead th:nth-child(5){width:20%;min-width:30px;}
}
@media screen and (max-width: 670px)
{
    #commandtable tbody td:nth-child(2),#commandtable thead th:nth-child(2){display:none;}
    #commandtable tbody td:nth-child(3),#commandtable thead th:nth-child(3){display:none;}
}
@media screen and (max-width: 500px)
{
    #commandtable{font-size:2vh;}
    #commandtable tbody td:nth-child(1),#commandtable thead th:nth-child(1){width: 30%;min-width:10px;}
    #commandtable tbody td:nth-child(4),#commandtable thead th:nth-child(4){width: 30%;min-width:10px;}
    #commandtable tbody td:nth-child(5),#commandtable thead th:nth-child(5){width: 20%;min-width:5px;}
}
@media screen and (max-width: 350px)
{
    #commandtable{font-size:2vh;}
    #commandtable tbody td:nth-child(1),#commandtable thead th:nth-child(1){width:40%;min-width:10px;}
    #commandtable tbody td:nth-child(4),#commandtable thead th:nth-child(4){width:40%;min-width:10px;}
    #commandtable tbody td:nth-child(5),#commandtable thead th:nth-child(5){width:20%;min-width:10px;}
}
</style>
<div align="center" style="margin:0 auto;"><select name="module" id="moduleselect"><option value="0">All</option></select><br><span style="padding-left:5px;color:white;"id="commandcount"></span></div><br>
<table id="commandtable">
    <thead>
        <tr id="tablehead">
            <th>Command Name</th>
            <th>Description</th>
            <th>Aliases</th>
            <th>Arguments</th>
            <th>Access Level</th>
        </tr>
    </thead>
</table>
<script type="text/javascript" src="static/js/parse.js" defer></script>
<script type="text/javascript">var cmds = <?php echo file_get_contents('static/json/commands.json'); ?>;</script>
<script type="text/javascript">
$(window).scroll(function(){
    var th = $('#tablehead');
    if($(window).scrollTop()>150)
    {
        th.css('position', 'fixed');
        th.css('top','50px');
        th.css('display', 'table');
    }
    else
    {
        th.css('position', 'relative');
        th.css('top', '0');
        th.css('display', 'table');
    }
})
</script>
</div>