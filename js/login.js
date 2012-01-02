$(function()
{
		
//		alert(hex_md5('pantheon'));
		
	$('.alert').hide();
	$('.wrong').hide();
	
	$('.close').click(function()
	{
		
		var message = $('.alert .message');
		message.css({top: 0, opacity: 1});
		message.animate({top: 30, opacity: 0}, 250, 'sineEaseIn', function()
		{
			$('.alert').hide();
		});
		
	})
	
	$('.submit.verify').click(function()
	{
		if(hex_md5($('.text.verify').val().toLowerCase()) == 'b602594c4ecc4b3c5cada68fe3899a09')
		{
			alert("lol!");
		}
		else
		{
			var message = $('.alert .message');
			message.animate({left: 10}, 50, function()


				message.animate({left: -10}, 100, function()
				{
					message.animate({left: 10}, 100, function()
					{
						message.animate({left: 0}, 50);
					});
				});
			});
		}
	});

	
	$('form.login-form').submit(function()
	{
		$('.wrong').hide();
		if(
			hex_md5($('.login-form .password').val().toLowerCase()) == '9e9d7a08e048e9d604b79460b54969c3'
			&&
			hex_md5($('.login-form .email').val().toLowerCase()) == 'a7950601e4ba79926d34e1f611250f16'
		)
		{
			$('.alert').show();
			var message = $('.alert .message');
			message.css({top: 50, opacity: 0});
			message.animate({top: 0, opacity: 1}, 500, 'backEaseOut');
			
			
		}
		else
		{
			alert("Wrong email or password");
		}
		
		
		return false;
	});
	
});