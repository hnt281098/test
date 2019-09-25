$(document).ready(function(){
  $('img[class=gio-chay]').click(function(){
  	var time_r = $(this).attr('time_r')

  	$('#lich-chay-xe').html('')
  	$('#lich-chay-xe').html($('#sub-time-'+ time_r).html())
  	$('#myModal').modal()
  })
});
