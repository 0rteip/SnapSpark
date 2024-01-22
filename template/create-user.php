<form method="POST" class="row g-3 needs-validation">
    <div class="col-md-2 image-container">
        <label id="profile-img-label" for="profile-img" class="mx-auto">+
            <input name="profile-img" type="file" id="profile-img" accept="image/jpeg" />
        </label>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-md-4">
        <label for="nome" class="row g-3">Nome</label>
        <input type="text" class="form-control extra-validation" id="nome" name="nome" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            Nome troppo lungo o vuoto.
        </div>
    </div>
    <div class="col-md-4">
        <label for="cognome" class="form-label">Cognome</label>
        <input type="text" class="form-control extra-validation" id="cognome" name="cognome" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            Cognome troppo lungo o vuoto.
        </div>
    </div>
    <div class="col-md-4">
        <label for="username" class="form-label">Username</label>
        <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="text" class="form-control extra-validation" id="username" name="username" pattern="^[a-zA-Z_]+$" required>
            <div class="invalid-feedback" id="usernameCustomValid">
                Username mast contains only a-z, A-Z and _
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label for="data_nascita" class="form-label">Data di nascita</label>
        <input type="date" class="form-control  extra-validation" id="data_nascita" name="data_nascita" required>
        <div class="invalid-feedback">
            Data obbligatoria.
        </div>
    </div>
    <div class="col-md-3">
        <label for="sesso" class="form-label">Sesso</label>
        <select class="form-select" id="sesso" name="sesso" required>
            <option selected disabled value="">Scegli...</option>
            <option>Maschio</option>
            <option>Femmina</option>
            <option>Altro</option>
        </select>
        <div class="invalid-feedback">
            Please select a valid state.
        </div>
    </div>
    <div class="col-md-3">
        <label for="mail" class="form-label">email</label>
        <input type="email" class="form-control extra-validation" id="mail" name="mail" required>
        <div class="invalid-feedback" id="mailCustomValid">
                L'email deve avere la @ e  al massimo 40 caratteri
        </div>
    </div>
    <div class="col-md-3">
        <label for="password" class="form-label">password</label>
        <input type="password" class="form-control extra-validation" id="password" name="password" required>
    </div>
    <div class="col-md-3">
        <label for="numero" class="form-label">telefono</label>
        <input type="tel" class="form-control extra-validation" id="numero" name="numero" required>
        <div class="invalid-feedback">
            Invalid number
        </div>
    </div>
    <div class="mb-3">
        <label for="biografia" class="form-label">Biografia</label>
        <textarea class="form-control extra-validation" id="biografia" rows="3" name="biografia"></textarea>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
                Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
                You must agree before submitting.
            </div>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit" >Submit form</button>
    </div>
</form>

<?php require_once 'template/cropper.php'; ?>

<script src="js/create-user.js"></script>
<script src="js/validate-login.js"></script>
