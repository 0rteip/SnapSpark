<div class="col-md-2 image-container">
    <label id="profile-img-label" for="profile-img">+
        <input name="profile-img" type="file" id="profile-img" accept="image/jpeg" />
    </label>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
<div class="col-md-4">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" required>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
<div class="col-md-4">
    <label for="cognome" class="form-label">Cognome</label>
    <input type="text" class="form-control" id="cognome" name="cognome" required>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
<div class="col-md-4">
    <label for="username" class="form-label">Username</label>
    <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="text" class="form-control" id="username" name="username" required>
        <div class="invalid-feedback">
            Please choose a username.
        </div>
    </div>
</div>
<div class="col-md-4">
    <label for="data_nascita" class="form-label">Data di nascita</label>
    <input type="date" class="form-control" id="data_nascita" name="data_nascita" required>
    <div class="invalid-feedback">
        Please provide a valid city.
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
    <input type="email" class="form-control" id="mail" name="mail" required>
</div>
<div class="col-md-3">
    <label for="password" class="form-label">password</label>
    <input type="password" class="form-control" id="password" name="password" required>
</div>
<div class="col-md-3">
    <label for="numero" class="form-label">telefono</label>
    <input type="tel" class="form-control" id="numero" name="numero" required>
</div>
<div class="mb-3">
    <label for="biografia" class="form-label">Biografia</label>
    <textarea class="form-control" id="biografia" rows="3" name="biografia"></textarea>
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
    <button class="btn btn-primary" type="submit">Submit form</button>
</div>
