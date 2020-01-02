var url = 'http://proyecto-laravel.com.devel/';
window.addEventListener("load", function(){

	$('.btn-like').css('cursor', 'pointer');
	$('.btn-dislike').css('cursor', 'pointer');

	//Botón de like
	function like(){
		$('.btn-like').unbind('click').click(function(){
			console.log('like');
			$(this).addClass('btn-dislike').removeClass('btn-like');
			$(this).attr('src', url+'img/heart-red.png');

			$.ajax({
				url: url +'like/'+$(this).data('id'),
				type: 'GET',
				success: function(r) {
					if(r.like){
						console.log('Has dado like a la publicación');
					}else{
						console.log('Error al dar like');
					}
				}
			});

			dislike();
		});
	}
	like();

	function dislike(){
		//Botón dislike
		$('.btn-dislike').unbind('click').click(function(){
			console.log('dislike');
			$(this).addClass('btn-like').removeClass('btn-dislike');
			$(this).attr('src', url+'img/heart-black.png');

			$.ajax({
				url: url +'dislike/'+$(this).data('id'),
				type: 'GET',
				success: function(r) {
					if(r.like){
						console.log('Has dado dislike a la publicación');
					}else{
						console.log('Error al dar dislike');
					}
				}
			});
			like();
		});
	}
	dislike();

	//BUSCADOR
	$('#buscador').submit(function(e){
		$(this).attr('action',url+'gente/'+$('#search').val());
	});
});