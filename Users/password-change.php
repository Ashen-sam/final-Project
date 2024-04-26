<?php 
session_start();

if(isset($_SESSION['authenticated'])) 
{
    $_SESSION['status'] = "You are already logged in!";
    header("Location: dashboard.php");
    exit(0);
}

$page_title = "Change Password";
require 'include/header.php';
?>
    <div class="container">
        <div class="contain">
            <?php
                if(isset($_SESSION['status'])){
                ?>
                <div class="alert">
                    <h5><?=$_SESSION['status']?></h5>
                </div>
                <?php
                unset($_SESSION['status']);
                }
            ?>
            <div class="card">
                <h2>Reset Password</h2>
                <div class="card-body">
                    <form action="password-reset-code.php" method="post">
                        <input type="hidden" name="password_token" value="">
                        <div class="form-group">
                            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
                            <label for="">Email Address:</label>
                            <input type="email" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password:</label>
                            <input type="password" name="new-password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password:</label>
                            <input type="password" name="confirm-password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="reset-pw" class="btn btn-success w-100">Login Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require 'include/footer.php'; ?>