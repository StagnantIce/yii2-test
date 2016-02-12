
$(function(){
    $('.showImage').click(function(){
        $('#showImage').modal('show');
        $('#showImage').find('.modal-body').html('<img width=300 src="/thumb/show?src='+$(this).attr('url')+'&width=300"/>')
    });
});

function showBook(url) {
	$('#showBook').modal('show');
	$('#showBook').find('.modal-body').html('Загрузка...');
    $.ajax({
    	url: url,
    	success: function(data) {
    		$('#showBook').find('.modal-body').html(data);
    	}
    })
}
