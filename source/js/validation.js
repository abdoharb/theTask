function validateRegisterForm() {
    removeOldValidation();
    // get required inputs
    let requires = document.getElementsByClassName("required");

    // check all input validation and show validation error if exist
    let hasValidation = false;
    for (let i = 0; i < requires.length; i++) {
        // remove old validation style on input
        requires[i].classList.remove('validate_required');

        // check validation required
        if(requires[i].value === ""){
            requires[i].classList.add('validate_required');

            let validationElement = requires[i].nextElementSibling;

            let text = requires[i].getAttribute('validation-name')+' is required *';

            validationElement.innerText = text;

            validationElement.classList.remove('d-none');

            hasValidation = true;
        }
    }

    if(passwordConfirmation() === false){
        hasValidation = true;
    }

    if(checkValidImage() === false){
        hasValidation = true;
    }

    if(hasValidation){
        return false;
    }

    return true;
}

function removeOldValidation(){
    let oldValidation = document.getElementsByClassName('error');

    for (let i = 0; i < oldValidation.length; i++) {
        oldValidation[i].classList.add('d-none');
        oldValidation[i].innerText = "";
    }
}

function passwordConfirmation(){
    let password = document.getElementById("password");
    let password_confirmation = document.getElementById("password_confirmation");

    let passwordValidationElement = password_confirmation.nextElementSibling;

    if(password.value !== password_confirmation.value){
        password_confirmation.classList.add('validate_required');

        passwordValidationElement.innerText = "Passwords not matches";
        passwordValidationElement.classList.remove('d-none');

        return false;
    }

    return true;
}

function checkValidImage(){
    let image = document.getElementById("image");

    let ext = getExtension(image.value);

    if(ext === ""){
        return false;
    }

    let imageTypes = ['jpg', 'jpeg', 'png', 'svg', 'bmp'];

    let imageValidationElement = image.nextElementSibling;

    if(imageTypes.includes(ext.toLowerCase()) === false){
        imageValidationElement.innerText = "Image file type must be " + imageTypes.join(',');
        imageValidationElement.classList.remove('d-none');

        return false;
    }

    // check file size
    let fileSize = image.files[0].size;
    let fileSizeInKB = (fileSize/1024);

    if(fileSizeInKB > 2048){
        imageValidationElement.innerText = "Image file must be 2MB or less";
        imageValidationElement.classList.remove('d-none');
        return false
    }

    return true
}

function getExtension(file) {
    let parts = file.split('.');
    return parts[parts.length - 1];
}

function imgPreview(){
    let image = document.getElementById("image").files[0];

    let img_preview = document.getElementById("img_preview");

    let reader = new FileReader();

    reader.addEventListener("load", () => {
        img_preview.src = reader.result;
    }, false);

    if(image){
        reader.readAsDataURL(image);
    }

    let thumbnail = document.getElementById('thumbnail')
    thumbnail.classList.remove('d-none')
}
