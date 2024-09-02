<?php
include "header.php";
include "navbar.php";
?>
<div class="card-body px-5 py-5" style="background-color:darkgray;">

<?php
if(isset($_POST['login']))
{
  $email =$_POST['email'];
  $password=$_POST['password'];

  if($email=="admin@gmail.com" && $password=="admin")
  {
    header("location:admin/view/layout.php");
  }

  if($email=="" || $password=="")
  {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            all inputs is required
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }


  else
  {
    if(isset($_SESSION['registration']))
    {

      $emailcol = array_column($_SESSION['registration'],'Email');
      $passwordcol = array_column($_SESSION['registration'],'password');

      $keyEmail = array_search($email,$emailcol);
      $keyPassword = array_search($password,$passwordcol);

      if(in_array($email,$emailcol) && in_array($password,$passwordcol) && $keyEmail==$keyPassword)
      {
        $userLoggedIn = true;
        setcookie("userLoggedIn",$userLoggedIn,time()+60*60*24*14);
        header("location:shop.php");
      }
      else
      {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                 email or password invalid
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
      }
      
    }
  }
}
?>

            
              <div class="card-body px-5 py-5" style="background-color:darkgray;">
                <h3 class="card-title text-left mb-3">Login</h3>
                <form >
                  <div class="form-group">
                    <label>email *</label>
                    <input type="email" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="text" class="form-control p_input" >
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <?php include "footer.php" ?>


    //table user, product, cart ,, review comment , rating  = session