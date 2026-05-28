const burger = document.querySelector(".navbar__burger");
const mobileMenu = document.querySelector(".mobile-menu");

if (burger && mobileMenu) {
    burger.addEventListener("click", function () {
        mobileMenu.classList.toggle("active");
    });
}

const showPasswordCheckbox = document.getElementById("show-password");
const passwordInput = document.getElementById("password");

if (showPasswordCheckbox && passwordInput) {
    showPasswordCheckbox.addEventListener("change", function () {
        passwordInput.type = this.checked ? "text" : "password";
    });
}