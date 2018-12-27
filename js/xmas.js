let rnd = parseInt(Math.random(3) * (3-1) + 1);
let d = new Date();
if(d.getMonth() == 11 && d.getDate() > 23 && d.getDate() < 28)
{
    switch(rnd)
    {
        case 1:
        $('body').css('background-image', 'url("/img/xmas.jpg")');
        break;

        case 2:
        $('body').css('background-image', 'url("/img/xmas-2.jpg")');

        break;

        case 3:
        $('body').css('background-image', 'url("/img/xmas-3.jpg")');

        break;
    }
}