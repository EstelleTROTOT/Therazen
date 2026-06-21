window.onload = function () {


    // Sélection du jour

    const bookingDays = document.querySelectorAll(".booking__day");

    bookingDays.forEach(day => {

       day.addEventListener("click", function () {

    const date = this.dataset.date;
    const type = this.dataset.type;

    const url = new URL(window.location.href);
    const address = url.searchParams.get("address") ?? "";

    window.location.href =
        `?page=booking&date=${date}&type=${type}&address=${encodeURIComponent(address)}`;

});

    });

    // Menu burger

    const burger = document.querySelector(".navbar__burger");
    const mobileMenu = document.querySelector(".mobile-menu");

    if (burger && mobileMenu) {
        burger.addEventListener("click", function () {
            mobileMenu.classList.toggle("active");
        });
    }

    // Afficher / masquer mot de passe

    const showPasswordCheckbox = document.getElementById("show-password");
    const passwordInput = document.getElementById("password");

    if (showPasswordCheckbox && passwordInput) {
        showPasswordCheckbox.addEventListener("change", function () {
            passwordInput.type = this.checked ? "text" : "password";
        });
    }

    // Sélection du créneau horaire

    const bookingHours = document.querySelectorAll(".booking__hour");
    const continueBtn = document.querySelector(".booking__continue");
    if (continueBtn) {
        continueBtn.disabled = true;
    }
    let selectedSlot = null;

    bookingHours.forEach(hour => {

        hour.addEventListener("click", function () {

            bookingHours.forEach(item =>
                item.classList.remove("booking__hour--active")
            );

            this.classList.add("booking__hour--active");

            selectedSlot = this.textContent.trim();

            if (continueBtn) {
                continueBtn.disabled = false;
            }

        });

    });

    // Sélection du type de consultation

    const consultationTypes = document.querySelectorAll(".booking__type");

    consultationTypes.forEach(type => {

        type.addEventListener("click", function () {

            const selectedType = this.dataset.type;

            const url = new URL(window.location.href);

            url.searchParams.set("page", "booking");
            url.searchParams.set("type", selectedType);

            window.location.href = url.toString();

        });

    });

    // Bouton Continuer → étape informations patient

   if (continueBtn) {

    continueBtn.addEventListener("click", function () {

        if (!selectedSlot) {
            alert('Veuillez sélectionner un créneau horaire.');
            return;
        }

const url = new URL(window.location.href);

const date = continueBtn.dataset.date;
const type = url.searchParams.get("type");
const address = url.searchParams.get("address") ?? "";

const travelFee = continueBtn.dataset.travelFee ?? 0;
const totalPrice = continueBtn.dataset.totalPrice ?? 42;

window.location.href =
    `?page=booking-informations&date=${date}&type=${type}&slot=${encodeURIComponent(selectedSlot)}&address=${encodeURIComponent(address)}&travel_fee=${travelFee}&total_price=${totalPrice}`;

        });

    }

};

//passeword

const showPasswords = document.getElementById('show-passwords');

if (showPasswords) {

    showPasswords.addEventListener('change', () => {

        const password = document.getElementById('password');
        const confirmation = document.getElementById('password_confirmation');

        const type = showPasswords.checked ? 'text' : 'password';

        password.type = type;
        confirmation.type = type;

    });

}