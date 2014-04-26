$(function(){

$('.btn-forward').click( function(){
	var $question = $(this).parents('.question');
	var $next_question = $question.next();
	$question.hide();
	$next_question.show();
});

$('.btn-back').click( function(){
	var $question = $(this).parents('.question');
	var $prev_question = $question.prev();
	$question.hide();
	$prev_question.show();
});

});
