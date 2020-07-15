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

// configNav
$('#configNav').click( function () {
  var configNav = $(this),
  target = configNav.attr('target'),
  parent = configNav.parents('#'+target),
  divScreen = $('#screen'),
  divDash = $('#dash-body');

  if (configNav.hasClass('open')) {
    configNav.removeClass('open');
    parent.removeClass('open');
    configNav.addClass('close');
    parent.addClass('close');
    divScreen.removeClass('close');
    divScreen.addClass('open');
    divDash.removeClass('close');
    divDash.addClass('open');
  }
  else {
    configNav.removeClass('close');
    parent.removeClass('close');
    configNav.addClass('open');
    parent.addClass('open');
    divScreen.removeClass('open');
    divScreen.addClass('close');
    divDash.removeClass('open');
    divDash.addClass('close');
  }
});

$('#filter-arrow').click( function (e) {
  e.preventDefault();
  var t = $(this),
  form = $('#filter-form');

  if (t.hasClass('open')) {
    t.removeClass('open');
    t.addClass('close');
    form.removeClass('open');
    form.addClass('close');
  }
  else {
    t.removeClass('close');
    t.addClass('open');
    form.removeClass('close');
    form.addClass('open');
  }
});

// Form image holder

$('#image-trigger').click( function (e) {
  e.preventDefault();
  $('#image-selector').trigger('click');
});

$('#image-selector').on('change', function () {
  if (typeof (FileReader) != "undefined") {
 
    var image_holder = $('#image');
    image_holder.empty();

    var reader = new FileReader();
    reader.onload = function (e) {
      image_holder.removeAttr('style');
      $("<img />", {
          "src": e.target.result,
          "class": "w-100 h-100 rounded-circle"
      }).appendTo(image_holder);
    }
    image_holder.show();
    reader.readAsDataURL($(this)[0].files[0]);
  } else{
      alert("Este navegador nao suporta FileReader.");
  }
});

// Disable checkbox

$('.disable-checkbox').change( function () {
  var t = $(this),
  target = t.attr('target'),
  input = $(target);

  if (t.hasClass('checked')) {
    t.removeClass('checked');
    input.removeAttr('disabled');
  }
  else {
    t.addClass('checked');
    input.attr('disabled', 'disabled');
  }
});

// Delete Button

// $('.ajax-button').click( function (e) {
//   var t = $(this),
//   parent = t.parents('tr'),
//   id = parent.attr('value');
// });

// Ajax-form

$('form.ajax-form').submit( function(e) {

	e.preventDefault();
	var t = $(this),
  msg = $('.message'),
  d = new FormData(t[0]);

	msg.removeClass('success').text('');
  msg.removeClass('error');

  $.ajax({
    url: t.attr('action')+"@store",
    type: t.attr('method'),
    data: d,
    contentType: false,
    processData: false,
    success: function(x){
      msg.text(x);
      // if (x == 1) {
      // 	a.text(a.attr('success')).addClass('success');
      // 	s.removeClass('loading');
      // 	t.trigger('success');
      // }
      // else {
        // a.text(x).addClass('error');
        // s.removeClass('loading');
      // }
    },
    error: function(){
      msg.text('Houve um erro de conexão').addClass('text-danger');
    }
  });
  

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