//Сервис шифровки email: https://p2pi.ru/hide-email.html

var x1,x2,x3,x4,x5,x6,x7;

//.mgtb = газтрансбанк
x1='<a href="';
x1+='mai';
x1+='lto:';
x2 ='';
x3 ='&#64;';
x4 ='&#103;&#97;&#122;&#116;&#114;&#97;&#110;&#115;&#98;&#97;&#110;&#107;&#46;&#114;&#117;';
x5 ='">';
x6 = x2+'&#64;'+x4;
x7 ='</a>';
$('a[href*=".mgtb"]').each(function () {
    x2 = $(this).attr('href');
    x2 = x2.replace('mailto:', '').replace('tel:', '').replace('.mgtb', '');
    x6 = x2+'&#64;'+x4;
    $(this).replaceWith(x1+x2+x3+x4+x5+x6+x7);
});

//Другие (info+mail+ru) == info@mail.ru
x1='<a href="';
x1+='mai';
x1+='lto:';
x2 ='';
x3 ='&#64;';
x4 ='';
x5 ='">';
x6 = x2+'&#64;'+x4 ;
x7 ='</a>';
$('a[href*="mailto:("]').each(function () {
    var temp;
    temp = $(this).attr('href').replace('mailto:', "").replace('tel:', "").replace('(', '[{"0":"').replace('+', '","1":"').replace('+', '","2":"').replace(')', '"}]');
    temp = JSON.parse(temp);
    console.log(temp);
    if ($(this).prop('classList').value) {
        x5 = '" ' + 'class="' + $(this).prop('classList').value + '">'
    }
    x2 = temp[0][0];
    x4 = temp[0][1] + '.' + temp[0][2];
    x6 = x2+'&#64;'+x4;
    $(this).replaceWith(x1+x2+x3+x4+x5+x6+x7);
});
$('a[href*="tel:("]').each(function () {
    var temp;
    temp = $(this).attr('href').replace('mailto:', "").replace('tel:', "").replace('(', '[{"0":"').replace('+', '","1":"').replace('+', '","2":"').replace(')', '"}]');
    temp = JSON.parse(temp);
    console.log(temp);
    x2 = temp[0][0];
    x4 = temp[0][1] + '.' + temp[0][2];
    x6 = x2+'&#64;'+x4;
    $(this).replaceWith(x1+x2+x3+x4+x5+x6+x7);
});