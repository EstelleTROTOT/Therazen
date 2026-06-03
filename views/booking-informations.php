<div class="booking__steps">

    <div class="booking__step booking__step--done">
        <div class="booking__step-number">✓</div>
        <p>Type & Date</p>
    </div>

    <div class="booking__step booking__step--done">
        <div class="booking__step-number">✓</div>
        <p>Créneau horaire</p>
    </div>

    <div class="booking__step booking__step--active">
        <div class="booking__step-number">3</div>
        <p>Vos informations</p>
    </div>

    <div class="booking__step">
        <div class="booking__step-number">4</div>
        <p>Paiement sécurisé</p>
    </div>

</div>

<div class="booking__form-card">

    <h2>Vos informations</h2>

    <p class="booking__subtitle">
        Merci de compléter les informations suivantes afin de confirmer votre rendez-vous.
    </p>

    <form class="booking-form">

        <div class="booking-form__group">
            <label>Nom *</label>
            <input type="text" name="lastname" required>
        </div>

        <div class="booking-form__group">
            <label>Prénom *</label>
            <input type="text" name="firstname" required>
        </div>

        <div class="booking-form__group">
            <label>Date de naissance *</label>
            <input type="date" name="birthdate" required>
        </div>

        <div class="booking-form__group">
            <label>Téléphone *</label>
            <input type="tel" name="phone" placeholder="06 00 00 00 00" required>
        </div>

        <div class="booking-form__group">
            <label>Email *</label>
            <input type="email" name="email" placeholder="email@exemple.fr" required>
        </div>

        <div class="booking-form__group">
    <label>Motif de consultation *</label>
    <textarea name="reason" rows="5" placeholder="Vous pouvez décrire brièvement votre demande ou les raisons qui vous amènent à consulter."></textarea>
</div>

<div class="booking-form__account">
    <input type="checkbox" id="create-account">
    <label for="create-account">Créer un compte TheraZen (facultatif)</label>
</div>

<p class="booking-form__info">
    Créer un compte vous permettra de retrouver vos rendez-vous, consulter votre historique et gérer facilement vos futures réservations.
</p>

<p class="booking-form__info">
    Si vous préférez ne pas créer de compte, vous recevrez toutes les informations relatives à votre rendez-vous par email.
</p>

        <p class="booking-form__info">
            Si vous ne créez pas de compte, vous recevrez toutes les informations relatives à votre rendez-vous par email.
        </p>

        <div class="booking-form__passwords">

            <div class="booking-form__group">
                <label>Mot de passe</label>
                <input type="password" name="password">
            </div>

            <div class="booking-form__group">
                <label>Confirmation du mot de passe</label>
                <input type="password" name="password_confirmation">
            </div>

        </div>

        <button type="submit" class="btn btn--primary">
            Continuer vers le paiement sécurisé →
        </button>

    </form>

</div>