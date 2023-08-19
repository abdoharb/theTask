<?php $errors = $_SESSION['errors'] ?? null; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task</title>
    <link rel="stylesheet" href="<?php echo BOOTSTRAP_PATH.'/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH.'/validation.css'?>">
</head>
<body>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-sm-12 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">
                <div class="d-flex align-items-center justify-content-center vh-100">
                    <form class="form w-100 border border-1 border-info" method="post" id="myForm" enctype="multipart/form-data" action="classes/FormSubmit.php">
                        <input type="hidden"
                               name="token"
                               value="<?php echo $_SESSION['token']?>">

                        <h3 class="text-center mt-3">Register new account</h3>

                        <div class="p-4 row">
                            <div class="mb-3 col-md-4 col-lg-4 col-xl-4 col-sm-12">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control required" name="first_name" id="first_name" validation-name="First Name" aria-describedby="firstNameHelp">
                                <span class="text-danger <?php isset($errors['fname']) ? '' : 'd-none'  ?> error">
                                    <?php  echo isset($errors['fname']) ? 'First Name is required' : ''; ?>
                                </span>
                                <div id="firstNameHelp" class="form-text">ex. Mahmoud</div>
                            </div>

                            <div class="mb-3 col-md-4 col-lg-4 col-xl-4 col-sm-12">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control required" name="last_name" id="last_name" validation-name="Last Name" aria-describedby="lastNameHelp">
                                <span class="text-danger <?php isset($errors['lname']) ? '' : 'd-none'  ?> error">
                                    <?php  echo isset($errors['lname']) ? 'Last Name is required' : ''; ?>
                                </span>

                                <div id="lastNameHelp" class="form-text">ex. Ali</div>
                            </div>

                            <div class="mb-3 col-md-4 col-lg-4 col-xl-4 col-sm-12">
                                <label for="image" class="form-label">Profile Image</label>
                                <input type="file" onchange="imgPreview()" class="form-control required" name="image" id="image" validation-name="Profile Image" aria-describedby="profileImageHelp">
                                <span class="text-danger <?php isset($errors['image']) ? '' : 'd-none'  ?> error">
                                    <?php  echo isset($errors['image']) ? 'Profile Image '.$errors['image'] : ''; ?>
                                </span>
                                <div id="profileImageHelp" class="form-text">Upload your profile image here, max file size is 2MB</div>
                                <span id="thumbnail" class="img-thumbnail d-none">
                                    <img src="" id="img_preview">
                                </span>
                            </div>

                            <div class="mb-3 col-md-4 col-lg-4 col-xl-4 col-sm-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control required" validation-name="Password" id="password">
                                <span class="text-danger <?php isset($errors['password']) ? '' : 'd-none'  ?> error">
                                    <?php  echo isset($errors['password']) ? 'Password '.$errors['password'] : ''; ?>
                                </span>
                            </div>

                            <div class="mb-3 col-md-4 col-lg-4 col-xl-4 col-sm-12">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control required" validation-name="Confirm Password" id="password_confirmation">
                                <span class="text-danger <?php isset($errors['password_confirmation']) ? '' : 'd-none'  ?> error">
                                    <?php  echo $errors['password_confirmation'] ?? ''; ?>
                                </span>
                            </div>

                            <button onclick="validateRegisterForm() === true ? document.getElementById('myForm').submit() : false" type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?php echo BOOTSTRAP_PATH. '/js/bootstrap.min.js' ?>"></script>
<script src="<?php echo JS_PATH. '/validation.js' ?>"></script>
</body>
</html>

<?php
ob_flush();
?>