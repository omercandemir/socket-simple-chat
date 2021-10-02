<!DOCTYPE html>
<html>
	<head>
		<title>Laravel & Socket Io Simple Chat Application</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
        <!-- Theme styles -->
        <link rel="stylesheet" href="{{asset('assets/style.css')}}">
	</head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-12 col-xl-8 chat">
					<div class="card">
						<div class="card-header msg_head">
                            <div class="user_info text-center">
                                <span>Chat with ayicik.net</span>
                                <p class="total-user-count"></p>
                            </div>
						</div>
						<div class="card-body msg_card_body chat-message-area">
							<div class="d-flex justify-content-start mb-4">
								<div class="msg_cotainer">
									Welcome to ayicik.net global chat
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<textarea name="" id="message" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>

    <script src="https://cdn.socket.io/4.2.0/socket.io.min.js" integrity="sha384-PiBR5S00EtOj2Lto9Uu81cmoyZqR57XcOna1oAuVuIEjzj0wpqDVfD0JA9eXlRsj" crossorigin="anonymous"></script>

    <script>
        $(function() {
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);
            
            let = messageInput = $('#message');
            messageInput.keypress(function (e) {
                let message = $(this).val();
                if (e.which === 13 && !e.shiftKey) {
                    socket.emit('message.send', message);
                    messageInput.val('');
                    return false;
                }
            });

			socket.on('join.room', (count) => {
				$('.total-user-count').text("Total Online User: " + count);
			});

            socket.on('message.send', (message) => {
                $('.chat-message-area').append(`
                    <div class="d-flex justify-content-start mb-4">
                        <div class="msg_cotainer_send">
                            ${message}
                        </div>
                    </div>
                `);
            });

        });
    </script>
</html>
