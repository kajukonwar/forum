<?php
require_once("../config.php");

if(Input::exists('post','register_submit'))
{
	$validate=new Validate();
	$validation=$validate->check($_POST,array(

			'email'=>array(
				'requirred'=>true,
				'max'=>255,
				'unique'=>true
				),
			'password'=>array(
				'requirred'=>true,
				'min'=>5,
				'max'=>20
				),
			'firstname'=>array(
				'requirred'=>true,
				'max'=>50
				),
			'lastname'=>array(
				'requirred'=>true,
				'max'=>50
				),

			'username'=>array(
				'requirred'=>true,
				'min'=>2,
				'max'=>20,
				'unique'=>'users'
				)
		));

	if($validation->passed())
	{
		echo "validation passed";
	}
	else
	{
		foreach($validation->errors() as $field_name=>$errors) {
			foreach($errors as $error)
			{
				echo $field_name.":>> ".$error." <br>"; 
			}
		}
	}
}
else
{
	echo "form not submitted";
}
require_once("includes/header.php");

?>

    <!-- Page Content -->
    <div class="container">

      

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Register</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

          
        	<form method="post" action="">
			  <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
			  </div>
			  <div class="form-group">
			    <label for="firstname">First name</label>
			    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name">
			  </div>

			  <div class="form-group">
			    <label for="lastname">last name</label>
			    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="last name">
			  </div>

			  <div class="form-group">
			    <label for="username">User name</label>
			    <input type="text" class="form-control" id="username" name="username" placeholder="User name">
			  </div>
		  
			  <button type="submit" name="register_submit" class="btn btn-primary">Submit</button>
			</form>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
<?php
require_once("includes/footer.php");
?>