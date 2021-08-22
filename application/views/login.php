<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/bootstrap.min.css'; ?>"> 

	<title>Login</title>
</head>
<body style="background-color: azure;">

	<div class="container">


		<div class="row justify-content-center m-5 p-5">
			<div class="card col-8 p-5">
				<h1 style="text-align: center;">Login</h1>
				<form method="POST" action="<?= base_url(); ?>" id="login_form">

					<?php if($this->session->flashdata('success')): ?>
						<div class="alert alert-success d-flex align-items-center" role="alert">
							<div>
								<?php echo $this->session->flashdata('success'); ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if($this->session->flashdata('error')): ?>
						<div class="alert alert-danger d-flex align-items-center" role="alert">
							<div>
								<?php echo $this->session->flashdata('error'); ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="col-md-12">
						<label for="email" class="form-label">Email-Id :</label>
						<input type="email" class="form-control" name="email" id="email" value="" required>
						<span class="text-danger" id="email_error"></span>
					</div>

					<div class="col-md-12">
						<label for="password" class="form-label">Password :</label>
						<input type="password" class="form-control" name="password" id="password" value="" required>
						<span class="text-danger" id="password_error"></span>
					</div>
					<br>
					<div class="col-12" style="text-align: center;">
						<input class="btn btn-primary" type="submit" name="submit" value="Login">
					</div>
					<div class="col-12" style="text-align: center;">
						<p>*First Here, Click Here to Register Yourself <a href="<?= base_url().'registration'; ?>">Here</a></p>
					</div>


				</form>
			</div>
		</div>

	</div>

	<script src="<?= base_url().'assets/js/bootstrap.bundle.min.js'; ?>"></script> 
	<script src="<?= base_url().'assets/js/jquery.min.js'; ?>"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			$("#login_form").on("submit", function(){

				var email = $("#email").val();
				var password = $("#password").val();
				var status = true;

				if (email == '') 
				{
					$("#email_error").text("Please enter your Email-Id");
					status = false;
				}
				else
				{
					$("#email_error").text("");
				}

				if (password == '') 
				{
					$("#password_error").text("Please enter your password");
					status = false;
				}
				else
				{
					$("#password_error").text("");
				}

				if (status) 
				{
					return true;
				}
				else
				{
					return false;
				}

			});

		});
	</script>
</body>
</html>