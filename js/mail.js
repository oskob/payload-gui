$(function()
{
	
	var preload = ['icon_close_hi.png', 'icon_folder_hi.png', 'icon_forward_hi.png', 'icon_mail_hi.png', 'icon_print_hi.png', 'icon_reply_hi.png', 'icon_search_hi.png', 'icon_spam_hi.png', 'icon_trash_hi.png'];
	
	for(var i = 0; i < preload.length; i++)
	{
		var img = new Image();
		img.src = 'img/' + preload[i];
	}
		
	html = '';
	for(var i = 0; i < mails.length; i++)
	{
		var item = mails[i];
		html += '\
		<tr class="row id-' + i + '" id="' + i + '">\
			<td class="nobg"></td>\
			<td>' + item[0] + '</td>\
			<td>' + item[1] + '</td>\
			<td>' + item[2] + '</td>\
			<td>' + item[3] + '</td>\
			<td class="nobg"></td>\
		</tr>\
		<tr class="body id-' + i + '">\
			<td class="nobg"></td>\
			<td colspan="4"><div class="mask"><div class="container"><p>' + item[4] + '</p></div></div></td>\
			<td class="nobg"></td>\
		</tr>';
	}
	
	$('.mails tbody').html(html);

	$('.mails tr.row').click(function()
	{
		
		$('.mails .body.open .mask').animate({height: 0}, 100);
		$('.mails .open').removeClass('open');
		
		var id = $(this).attr('id');
		var body = $('.mails .body.id-'+id);
		var mask = body.find('.mask');
		
		$('.mails .row.id-'+id).addClass('open');
		$('.mails .body.id-'+id).addClass('open');
		
		var container = body.find('.container');
		mask.animate({height: container.height()+15}, 100);
		
	});
	
});