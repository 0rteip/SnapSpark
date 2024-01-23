<form method="POST" class="row g-3 needs-validation :-<?php echo $_GET['action'] ?>" id="mod-new-form">
    <div class="col-md-12 image-container mb-2">

        <!-- <label id="profile-img-label" for="profile-img" class="mx-auto">+
            <input name="profile-img" type="file" id="profile-img" accept="image/jpeg" />
        </label> -->

        <?php if ($_GET["action"] == "create_user"): ?>
            <label id="profile-img-label" for="profile-img" class="mx-auto">+
                <input name="profile-img" type="file" id="profile-img" accept="image/jpeg" />
            </label>
        <?php else: ?>
            <input name="profile-img" type="file" id="profile-img" accept="image/jpeg" />
            <label id="profile-img-label" for="profile-img" class="visually-hidden">Change Image</label>
            <img src="<?php echo AVATAR_FOLDER . $templateParams["accountInfo"]["profile_img"]; ?>"
                class="profile-avatar mx-auto d-block" alt="" />
        <?php endif; ?>


        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-md-6">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control extra-validation" id="nome" name="nome"
            value="<?php echo $templateParams['accountInfo']['nome'] ?>" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            Nome troppo lungo o vuoto.
        </div>
    </div>
    <div class="col-md-6">
        <label for="cognome" class="form-label">Cognome</label>
        <input type="text" class="form-control extra-validation" id="cognome" name="cognome"
            value="<?php echo $templateParams['accountInfo']['cognome'] ?>" required>
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
            <input type="text" class="form-control extra-validation" id="username" name="username"
                pattern="^[a-zA-Z_]+$" value="<?php echo $templateParams['accountInfo']['username'] ?>" <?php if (isset($_SESSION['username'])) {
                       echo 'readonly';
                   } ?> required>
            <div class="invalid-feedback" id="usernameCustomValid">
                Username mast contains only a-z, A-Z and _
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label for="data_nascita" class="form-label">Data di nascita</label>
        <input type="date" class="form-control  extra-validation" id="data_nascita" name="data_nascita"
            value="<?php echo $templateParams['accountInfo']['data_nascita'] ?>" required>
        <div class="invalid-feedback">
            Data obbligatoria.
        </div>
    </div>
    <div class="col-md-4">
        <label for="sesso" class="form-label">Sesso</label>
        <select class="form-select" id="sesso" name="sesso" required>
            <option <?php if (!isset($_SESSION['username'])) {
                echo "selected";
            } ?> disabled value="">Scegli...</option>
            <?php foreach ($templateParams['combobox'] as $option):
                $selected = ($option == $templateParams['accountInfo']['sesso']) ? "selected" : "";
                ?>
                <option <?php echo $selected ?> value="<?php echo $option ?>">
                    <?php echo $option ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
            Please select a valid state.
        </div>
    </div>
    <div class="col-md-4">
        <label for="mail" class="form-label">email</label>
        <input type="email" class="form-control extra-validation" id="mail" name="mail"
            value="<?php echo $templateParams['accountInfo']['mail'] ?>" required>
        <div class="invalid-feedback" id="mailCustomValid">
            L'email deve avere la @ e al massimo 40 caratteri
        </div>
    </div>
    <div class="col-md-4">
        <label for="password" class="form-label">password</label>
        <input type="password" class="form-control extra-validation" id="password" name="password"
            value="<?php echo $templateParams['accountInfo']['password'] ?>" required>
    </div>
    <div class="col-md-4">
        <label for="numero" class="form-label">telefono</label>
        <input type="tel" class="form-control extra-validation" id="numero" name="numero"
            value="<?php echo $templateParams['accountInfo']['numero'] ?>" required>
        <div class="invalid-feedback">
            Invalid number
        </div>
    </div>
    <div class="mb-3">
        <label for="biografia" class="form-label">Biografia</label>
        <textarea class="form-control extra-validation" id="biografia" rows="3"
            name="biografia"><?php echo $templateParams['accountInfo']['biografia'] ?></textarea>
    </div>
    <div class="col-12 mb-3">
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
        <?php if ($_GET['action'] == "update_user"): ?>
            <button class="btn btn-primary col-md-auto col-12 text-center d-sm-grid mb-3 mb-md-0 me-md-2 d-md-inline"
                type="submit">Modifica</button>
            <button class="btn btn-primary col-md-auto col-12 text-center d-sm-grid mb-3 mb-md-0 me-md-2 d-md-inline"
                type="reset" id="reset-valid-bt">Annulla</button>
            <button class="btn btn-danger col-md-auto col-12 text-center d-sm-grid mb-3 mb-md-0 d-md-inline" type="button"
                id="exit-bt">Exit</button>
        <?php else: ?>
            <button class="btn btn-primary col-md-auto col-12 text-center d-sm-grid d-md-inline"
                type="submit">Subscribe</button>
        <?php endif; ?>
    </div>

</form>

<?php require_once 'template/cropper.php'; ?>

<script src="js/create-user.js"></script>
<script src="js/validate-login.js"></script>