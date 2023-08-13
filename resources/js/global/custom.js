function hanyaAngka(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}

function hanyaHuruf(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (
        (charCode < 65 || charCode > 90) &&
        (charCode < 97 || charCode > 122) &&
        charCode > 32
    )
        return false;
    return true;
}

function previewImage() {
    const image = document.querySelector("#image");
    const imgPreview = document.querySelector(".img-prev");

    // imgPreview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}

function disableSubmitButton() {
    var submitButton = document.getElementById("submit-button");
    submitButton.disabled = true;
    submitButton.classList.add("loading");
    submitButton.innerText = "Loading";
}

// Password toggle
document.addEventListener("DOMContentLoaded", function () {
    const passwordForms = document.querySelectorAll(".password-form");

    passwordForms.forEach((form) => {
        const toggleButtons = form.querySelectorAll(".toggle-password");

        toggleButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const inputField =
                    this.closest(".input-group").querySelector("input");
                const type =
                    inputField.getAttribute("type") === "password"
                        ? "text"
                        : "password";
                inputField.setAttribute("type", type);

                this.classList.toggle("fa-eye-slash");
                this.classList.toggle("fa-eye");
            });
        });
    });
});
