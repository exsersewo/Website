let rnd = parseInt(Math.random(3) * (3-1) + 1);
let d = new Date();
if(d.getMonth() == 11 && d.getDate() > 23 && d.getDate() < 28)
{
    let back = $('#background-holder');

    switch(rnd)
    {
        case 1:
        back.css('background-image', 'url("/img/xmas.jpg")');
        break;

        case 2:
        back.css('background-image', 'url("/img/xmas-2.jpg")');

        break;

        case 3:
        back.css('background-image', 'url("/img/xmas-3.jpg")');

        break;
    }
}