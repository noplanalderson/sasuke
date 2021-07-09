

    $(".show-btn-password").click(function() {
    	var showBtn = $('.show-btn-password');
    	var formPassword = $('#user_password').attr('type');

    	if(formPassword === "password"){
          showBtn.attr('class', 'show-btn-password d-flex hide-btn');
          $('.password').attr('class', 'fa fa-eye-slash password');
          $('#user_password').attr('type', 'text');
        }else{
          $('.password').attr('class', 'fa fa-eye password');
          $('#user_password').attr('type', 'password');
          showBtn.attr('class', 'show-btn-password d-flex');
        }
    });
   
   	$(".show-btn-repeat").click(function() {
    	var showBtn = $('.show-btn-repeat');
    	var formPassword = $('#repeat_password').attr('type');

    	if(formPassword === "password"){
          showBtn.attr('class', 'show-btn-repeat d-flex hide-btn');
          $('.repeat').attr('class', 'fa fa-eye-slash repeat');
          $('#repeat_password').attr('type', 'text');
        }else{
          $('#repeat_password').attr('type', 'password');
          $('.repeat').attr('class', 'fa fa-eye repeat');
          showBtn.attr('class', 'show-btn-repeat d-flex');
        }
    });