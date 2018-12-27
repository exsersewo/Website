var menushown = false;

function togglemenu()
{
    menushown = !menushown;
    console.log(menushown);
    if(menushown)
    {
        $("#navmenu").eq(0).css('display', 'block');
    }
    else
    {
        $("#navmenu").eq(0).css('display', 'none');
    }
}