<?php
ob_start();
session_start();

require_once '../config.php';

class FormSubmit{
    public function submit(){
        $inputs = [
            'fname' => $_POST['first_name'],
            'lname' => $_POST['last_name'],
            'password' => $_POST['password'],
            'password_confirmation' => $_POST['password_confirmation'],
            'image' => $_FILES['image']
        ];

        if (!empty($this->formValidation($inputs))) {
            $_SESSION['errors'] = $this->formValidation($inputs);
            Redirect('task/index.php');
        }

        $crf = $_POST['token'];

        // if there's no crf
        if (!$crf || $crf !== $_SESSION['token']) {
            var_dump($_SESSION['token']);

            // return 405 http status code
            http_response_code(405);
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit();
        }

        // upload file
        $this->fileUpload($_FILES['image']);

        // insert to DB
        $connect = db_connect();
        $connect->query("INSERT INTO users (firstName, lastName, password, image, created_at, updated_at) VALUES ('" . $inputs['fname'] . "', '" . $inputs['lname'] . "', '" . md5($inputs['password']) . "', '" . $_FILES['image']['name'] . "', '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "')");

        // destroy all sessions after success
        session_destroy();

        Redirect('task/index.php');
    }

    /*
     * Upload file
     * */
    protected function fileUpload($file): bool
    {
        $target_dir = UPLOAD_PATH;
        $target_file = $target_dir . '/'. basename($file["name"]);

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return true;
        }

        return false;
    }

    /*
     * Form validation
     * */
    private function formValidation(array $inputs): array
    {
        $validations = [];
        foreach ($inputs as $key => $input){
            if($key == 'image'){
                if($_FILES['image']['name'] == ''){
                    $validations[$key] = 'is required';
                }else{
                    $imageInfo = getimagesize( $_FILES['image']['tmp_name']);

                    $imgTypes = [
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/bmp',
                        'image/svg',
                    ];

                    if(!in_array($imageInfo['mime'], $imgTypes)){
                        $validations[$key] = 'type must be png,jpg.pnb,svg';
                    }

                    if(filesize( $_FILES['image']['tmp_name']) / 1024 > 2048){
                        $validations[$key] = 'size must be 2MB or less';
                    }
                }
            }

            if($key == 'password_confirmation'){
                if($inputs['password_confirmation'] == ''){
                    $validations[$key] = 'Password confirmation is required';
                }else{
                    if($inputs['password'] !== $inputs['password_confirmation']){
                        $validations[$key] = 'passwords not the same';
                    }
                }
            }

            if($input === '' && $key !== 'image' && $key !== 'password_confirmation'){
                $validations[$key] = 'is required';
            }
        }

        return $validations;
    }
}

$formSubmit = new FormSubmit();
$formSubmit->submit();
