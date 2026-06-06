window.onload = function () {

    // Sélection du jour

    const bookingDays = document.querySelectorAll(".booking__day");

    bookingDays.forEach(day => {

        day.addEventListener("click", function () {

            const date = this.dataset.date;
            const type = this.dataset.type;

            window.location.href =
                `?page=booking&date=${date}&type=${type}`;

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

    bookingHours.forEach(hour => {

        hour.addEventListener("click", function () {

            bookingHours.forEach(item =>
                item.classList.remove("booking__hour--active")
            );

            this.classList.add("booking__hour--active");

            console.log("Créneau sélectionné :", this.textContent);

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

    const continueBtn = document.querySelector(".booking__continue");

    if (continueBtn) {

        continueBtn.addEventListener("click", function () {

            window.location.href = "?page=booking-informations";

        });

    }

};