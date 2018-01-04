$(function () {

$('#date_format').keypad({separator: '|', prompt: 'Choose Date Format', 
    layout: ['Year Format|2012|12',
        'Monts Format|January|Jan|01-12', 
        'Day Name|Wednesday|Wed', 
        'Day Format|01-31|1-31',
        'Date Complete|05/16/12|16-May-2012|2012-05-16',
        'Separators|.|/|-|,|:',
        '-|[|]|(|)',
         $.keypad.CLEAR + '|'+  $.keypad.SPACE_BAR + '|'+  $.keypad.CLOSE 
         
        
        ]});
    $('#time_format').keypad({separator: '|', prompt: 'Choose Time Format', 
    layout: ['Hour Format|00-23|0-23|01-12|1-12|AM/PM',
        'Minute/Second|00-59m|00-59s',
        'Time Zone|EDT|UTC',
        'Time Complete|18:06|18:06:15|06:06:15 PM',
        'Separators|.|/|-|,|:',
        '-|[|]|(|)',
         $.keypad.CLEAR + '|'+  $.keypad.SPACE_BAR + '|'+  $.keypad.CLOSE 
         
        
        ]});
});

