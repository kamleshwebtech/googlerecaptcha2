<html>
	<head>
		<title>Check Re-captcha</title>
	</head>
	<body>
		<link href="style.css" rel="stylesheet">
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
  </script>

		  	<div class="form-wrapper-outer">

			    <form action="#" method="POST" name="htmlform" id="test-form" novalidate>
			      <div class="field-wrapper">
			        <div id="message-wrap">
			          <span></span>
			        </div>
			      </div>
			      <div class="field-wrapper">
			        <input type="email" name="email" class="form-checkfield" id="" required>
			        <div class="field-placeholder"><span>Enter your email</span></div>
			      </div>
			      <div class="field-wrapper">
			        <input type="text" name="name" class="form-checkfield" id="" required>
			        <div class="field-placeholder"><span>Enter your name</span></div>
			      </div>
			      <div class="field-wrapper">
			        <input type="text" name="phone" class="form-checkfield" id="" required>
			        <div class="field-placeholder"><span>Enter your phone</span></div>
			      </div>
			      <div class="field-wrapper">
			        <div id="google_recaptcha"></div>
			      </div>
			      <div class="field-wrapper">
			        <input type="button" id="submit-test-form" value="Submit">
			      </div>
			    </form>

			  </div>


			<script>
				
				    var onloadCallback = function() {
				        grecaptcha.render('google_recaptcha', {
				          'sitekey' : '6Le3A4sUAAAAAOvMlqDkQ46RD8caGAbHuaqTWk0-'
				        });
				      };
				      
				      $(function () {
				        //Check if required fields are filled
				        function checkifreqfld() {
				                var isFormFilled = true;
				                $("#test-form").find(".form-checkfield:visible").each(function () {
				                    var value = $.trim($(this).val());
				                    if ($(this).prop('required')) {
				                        if (value.length < 1) {
				                          $(this).closest(".field-wrapper").addClass("field-error");
				                          isFormFilled = false;
				                        } else {
				                          $(this).closest(".field-wrapper").removeClass("field-error");
				                        }
				                    } else {
				                        $(this).closest(".field-wrapper").removeClass("field-error");
				                    }
				                });
				                return isFormFilled;
				          }

				        //Form Submit Event
				        $("#submit-test-form").click(function () {
				            if (checkifreqfld()) {
				              event.preventDefault();
				              var rcres = grecaptcha.getResponse();
				              if(rcres.length){
				                grecaptcha.reset();
				                showHideMsg("Form Submitted!","success");
				              }else{
				                showHideMsg("Please verify reCAPTCHA","error");
				              }
				            } else {
				                showHideMsg("Fill required fields!","error");
				            }
				        });

				        //Show/Hide Message
				        function showHideMsg(message,type){
				          if(type == "success"){
				            $("#message-wrap").addClass("success-msg").removeClass("error-msg");
				          }else if(type == "error"){
				            $("#message-wrap").removeClass("success-msg").addClass("error-msg");
				          }

				          $("#message-wrap").stop()
				          .slideDown()
				          .html(message)
				          .delay(1500)
				          .slideUp();
				        }


				        //Google Style InputFields
				        $(".field-wrapper .field-placeholder").on("click", function () {
				          $(this).closest(".field-wrapper").find("input").focus();
				        });
				        $(".field-wrapper input").on("keyup", function () {
				          var value = $.trim($(this).val());
				            if (value) {
				              $(this).closest(".field-wrapper").addClass("hasValue");
				            } else {
				              $(this).closest(".field-wrapper").removeClass("hasValue");
				            }
				        });
				      });

			</script>

	</body>
</html>