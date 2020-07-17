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

$('.ajax-delete').click( function (e) {
  e.preventDefault();
  var t = $(this),
  msg = $('.message'),
  action = t.attr('href'),
  id = t.attr('data'),
  token = $("meta[name='csrf-token']").attr("content"),
  tr = t.parents('tr');

  $.ajax({
    url: action,
    type: 'DELETE',
    data: {
      "id": id,
      "_token": token,
    },
    success: function (x) {
      if (x) {
        
        msg.text('Excluído com sucesso').addClass('text-success')
        tr.remove();
        setTimeout( function () { 
          msg.text('').removeClass('text-success');
        }, 3000);
      }
      else {
        msg.text(x).addClass('text-danger');
      }
    },
    error: function(){
      msg.text('Houve um erro de conexão').addClass('text-danger');
    }
  });
});

// Ajax-form

$('form.ajax-form').submit( function(e) {

	e.preventDefault();
	var t = $(this),
  msg = $('.message'),
  d = new FormData(t[0]),
  action = t.attr('action');

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

	msg.removeClass('success').text('');
  msg.removeClass('error');

  $.ajax({
    url: action,
    type: 'post',
    data: d,
    contentType: false,
    processData: false,
    success: function(x){
      if (x == 1) {
      	msg.text(msg.attr('success')).addClass('text-success');
      	t.trigger('success');
      }
      else {
        msg.text(x).addClass('text-danger');
      }
    },
    error: function(){
      msg.text('Houve um erro de conexão').addClass('text-danger');
    }
  });
  

});

// Ajax Search

$('#searchTarget').keyup( function () {
  var t = $(this),
  content = $('#searchContent'),
  value = t.val(),
  form = t.parents('form'),
  action = t.attr('href'),
  data = t.attr('data-require');
  data = data.split(" ");

  if (!notNull(value)) {
    content.css('bottom', '0px');
    content.html('');
  }
  else {
    $.ajax({
      url: action,
      type: 'GET',
      data: {'require': data, 'content': value},
      success: function(x) {
        content.css('bottom', '0px');
        content.html('');
        var count = 0;
        $.each(JSON.parse(x), function (index, value) {
          $.each(value, function (i, v) {
            
            count++;
            var rate = '';
            var i = 0;
            for (i = 0; i < v.rate; i++) {
              rate = rate+'<div class="col-sm-3 star m-0 p-0"></div>';
            }
            var route = v.route;
            content.append('<div class="search-item row m-0 w-100 p-2 text-center border" style="height:50px;" count="'+count+'" onclick="ajaxRedirect('+count+')" route="'+route+'">'+
            '<div class="col-sm-8 m-0 h-100">'+
            '<h5 class="p-1">'+v.name+'</h5>'+
            '</div>'+
            '<div class="col-sm-4 m-0 h-100 row">'+
            rate+
            '</div>'+
            '</div>');
            var bottom = content.css('bottom');
            var px = bottom.split('p')[0];
            content.css('bottom', px-50+'px');

          });
        
        });
      },
      error: function(x){
        alert('Houve um erro de conexão');
      }
    });
  }

 
});

// rating
$('.rating').click( function () {
  var t = $(this),
  form = t.parents('form');

  form.trigger('submit');

});

$(".rate-form").submit( function(e) {

  e.preventDefault();
	var t = $(this),
  msg = $('.message'),
  d = new FormData(t[0]),
  action = t.attr('action');

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: action,
    type: 'POST',
    data: d,
    contentType: false,
    processData: false,
    success: function(x) {
      $('.progress').css('width', x.rate);
      $('.progress').attr('aria-valuenow', x.rate);
      $('.progress-bar strong').text(x.title);
      $('.progress-bar').attr('class', 'progress-bar '+x.bg);
      $('.rating').attr('disabled','disabled');
      msg.text(msg.attr('success')).addClass('text-success');
    },
    error: function(x){
      $('.rating').attr('disabled','disabled');
      alert('Houve um erro de conexão');
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

function notNull (x){
  if(x!="" && !(x.match(/^\s+$/))) {
      return true;
  }
  else {
      return false;
  }
}

function ajaxRedirect(count) {
  var t = $('.search-item[count="'+count+'"]'),
  target = t.attr('route'),
  route = target.split(' ')[0];
  id = target.split(' ')[1],
  redirect = $('#searchContent').attr('redirect');

  $.ajax({
    url: redirect,
    type: 'GET',
    data: {'route': route, 'id': id},
    success: function(x) {
      window.location.href = x;
    },
    error: function(x) {
      alert('Houve um erro de conexão');
    }
  });
}

// update register fields

function updateFields(){

	if(!$.isEmptyObject(obj)){

		$.each($('input[type="text"], input[type="email"], input[type="number"], input[type="date"], input[type="time"], input[type="password"], select, textarea'), function(){
			var t = $(this)
				value = obj[t.attr('name')];
			if($.type(value) == 'object'){
				t.val(value['id']);
			}else{
				t.val(value);
			}
		});

		$('input[type="radio"]').each(function(){
			var name = $(this).attr('name');
			$('input[name="'+name+'"][value="'+obj[name]+'"]').prop('checked','true');
		});

	}

}