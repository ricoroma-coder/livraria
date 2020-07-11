// config carousel

$('.carousel').carousel({
  interval: 5000
});

// config document ready

$(document).ready( function () {
  var timestamp = time_now();
  if ($('.update-field')) {
    var append = '<small class="text-muted">Atualizado em '+timestamp+"</small>";
    $('.update-field').append(append);
  }
});

// nav Navigation
$('#navigation .nav-link').click( function (e) {
  e.preventDefault();
  $(this).parents('.nav-item').siblings().removeClass('active');
  $(this).parents('.nav-item').addClass('active');
  var id = $(this).attr('href'),
  li = $('#navigation .nav-link'),
  array = [];

  li.each( function (index, value)  {
    array.push($(value).attr('href'));
  });
  
  array.splice( $.inArray(id, array), 1 );

  var i = 0;

  for (i = 0; i < array.length; i++) {
    var div = $(array[i]).parents('.row');
    div.addClass('navHidden');
    if (div.hasClass('inData'))
      div.removeClass('inData');
  }
  var inData = $(id).parents('.row');
  if (inData.hasClass('navHidden'))
    inData.removeClass('navHidden');
  inData.addClass('inData');
});

// Functions

function time_now() {
  var dt = new Date();
  var d = [dt.getDate(), dt.getMonth() + 1, dt.getFullYear()];
  var t = [dt.getHours(), dt.getMinutes(), dt.getSeconds()];
  
  dt = formatDate(d,t);
  d = dt[0].join('/');
  t = dt[1].join(':');

  return [d,t].join(' ');
}

function formatDate (date, time) {
  var i = 0;

  for (i = 0; i < 3; i++) {
    date[i] = date[i].toString();
    time[i] = time[i].toString();
    if (date[i].length == 1)
      date[i] = '0'+date[i];
    if (time[i].length == 1)
      time[i] = '0'+time[i];
  }

  return [date,time];
}