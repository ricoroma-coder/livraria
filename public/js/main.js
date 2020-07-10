$('.carousel').carousel({
  interval: 5000
});

$(document).ready( function () {
  var timestamp = time_now();
  if ($('.update-field')) {
    var append = '<small class="text-muted">Atualizado em '+timestamp+"</small>";
    $('.update-field').append(append);
  }
});

// Functions

function time_now() {
  var dt = new Date();
  var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
  var d = [dt.getDate(), dt.getMonth() + 1, dt.getFullYear()].join('/');
  var t = [dt.getHours(), dt.getMinutes(), dt.getSeconds()].join(':');
  return [d,t].join(' ');
}