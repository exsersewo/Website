<style type="text/css">#commandtable, #moduleselect{margin:0 auto;padding:0;}#moduleselect{text-align:center;}#tablehead{font-weight:bold;text-align:center;}#commandtable tr:nth-child(even) {background: #CCC}#commandtable tr:nth-child(odd) {background: #FFF}</style>
<div align="center"><select name="module" id="moduleselect"><option value="0">All</option></select></div>
<table id="commandtable"><tr id="tablehead"><td>Command Name</td><td>Description</td><td>Aliases</td><td>Arguments</td><td>Access Level</td></tr></table>
<script type="text/javascript" src="static/js/parse.js" defer></script>
<script type="text/javascript">var cmds = <?php echo file_get_contents('static/json/commands.json'); ?>;</script>