<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/bootstrap.min.css'; ?>"> 

	<title>Registration</title>
</head>
<body style="background-color: azure;">

	<div class="container">


		<div class="row justify-content-center m-5 p-5">
			<div class="card col-8 p-5">
				<h1 style="text-align: center;">Registration</h1>
				<form method="POST" action="<?= base_url().'registration-verify'; ?>" class="row g-3 needs-validation" novalidate>

					<div class="col-md-12">
						<label for="fname" class="form-label">First name</label>
						<input type="text" class="form-control" name="fname" id="fname" value="<?php echo set_value('fname'); ?>" minlength="3" maxlength="50" required>
						<span class="text-danger"><?php echo form_error('fname'); ?></span>
						<div class="invalid-feedback">
							This field is required.
						</div>
						<div class="valid-feedback">
							Looks good!
						</div>
					</div>

					<div class="col-md-12">
						<label for="lname" class="form-label">Last name</label>
						<input type="text" class="form-control" name="lname" id="lname" value="<?php echo set_value('lname'); ?>" minlength="3" maxlength="50" required>
						<span class="text-danger"><?php echo form_error('lname'); ?></span>
						<div class="invalid-feedback">
							This field is required.
						</div>
						<div class="valid-feedback">
							Looks good!
						</div>
					</div>

					<div class="col-md-12">
						<label for="email" class="form-label">Email-Id</label>
						<input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" required>
						<span class="text-danger"><?php echo form_error('email'); ?></span>
						<div class="invalid-feedback">
							Please enter a Valid Email Address.
						</div>
						<div class="valid-feedback">
							Looks good!
						</div>
					</div>

					<div class="col-md-12">
						<label for="phone" class="form-label">Phone No</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupPrepend">+91</span>
							<input type="text" class="form-control" minlength="10" maxlength="10" onkeypress="return isNumber(event)"  name="phone" id="phone" aria-describedby="inputGroupPrepend" value="<?php echo set_value('phone'); ?>" required>
							<div class="invalid-feedback">
								Please enter a Valid Phone No.
							</div>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<span class="text-danger"><?php echo form_error('phone'); ?></span>
					</div>

					<div class="col-md-12">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" name="password" id="password" minlength="8" maxlength="30" value="<?php echo set_value('password'); ?>" required>
						<span class="text-danger"><?php echo form_error('password'); ?></span>
						<!-- <div class="valid-feedback">
							Looks good!
						</div> -->
					</div>

					<div class="col-md-12">
						<label for="re_password" class="form-label">Confirm Password</label>
						<input type="password" class="form-control" name="re_password" id="re_password" minlength="8" maxlength="30" value="" required>
						<span class="text-danger"><?php echo form_error('re_password'); ?></span>
						<!-- <div class="valid-feedback">
							Looks good!
						</div> -->
					</div>

					<div class="col-12">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="yes" name="agree" id="agree" required>
							<label class="form-check-label" for="agree">
								Agree to terms and conditions
							</label>
							<div class="invalid-feedback">
								You must agree before submitting.
							</div>
						</div>
						<span class="text-danger"><?php echo form_error('agree'); ?></span>
					</div>

					<div class="col-12">
						<input class="btn btn-primary" type="submit" name="submit" value="Register">
					</div>

				</form>

				<div class="col-12">
					<p>*Already Registered then go to Login to click here <a href="<?= base_url(); ?>">Here</a></p>
				</div>

			</div>
		</div>

	</div>

	<script src="<?= base_url().'assets/js/bootstrap.bundle.min.js'; ?>"></script> 

	<script type="text/javascript">
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function () {
			'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
  .forEach(function (form) {
  	form.addEventListener('submit', function (event) {
  		if (!form.checkValidity()) {
  			event.preventDefault()
  			event.stopPropagation()
  		}

  		form.classList.add('was-validated')
  	}, false)
  })
})()
</script>

<script type="text/javascript">
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
</script>


</body>
</html>