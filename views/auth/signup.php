<!DOCTYPE html>
<html lang="en">
  <?php require(ROOT . 'views/templates/head.php'); ?>
  <body>
    <!-- Header -->
    <?php require(ROOT . 'views/templates/header.php'); ?>

    <section id="signup">
      <form action="<?= BASE_URL ?>/signup" method="POST" class="form" id="login-form">
        <h2 class="form-title">S'inscrire</h2>
        <div class="input-group">
          <label for="lastname">Nom</label>
          <input type="text" id="lastname" name="lastname" autocomplete="off" />
        </div>
        <?php if(isset($errors['lastname'])): ?>
          <ul>
            <?php foreach($errors['lastname'] as $error): ?>
              <li class="form-text text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <div class="input-group">
          <label for="firstname">Prénom</label>
          <input type="text" id="firstname" name="firstname" autocomplete="off" />
        </div>
        <?php if(isset($errors['firstname'])): ?>
          <ul>
            <?php foreach($errors['firstname'] as $error): ?>
              <li class="form-text text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <div class="input-group">
          <label for="username">Nom d'utilisateur</label>
          <input type="text" id="username" name="username" autocomplete="off" />
        </div>
        <?php if(isset($errors['username'])): ?>
          <ul>
            <?php foreach($errors['username'] as $error): ?>
              <li class="form-text text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="text" id="email" name="email" autocomplete="off" />
        </div>
        <?php if(isset($errors['email'])): ?>
          <ul>
            <?php foreach($errors['email'] as $error): ?>
              <li class="form-text text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <div class="input-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" />
        </div>
        <?php if(isset($errors['password'])): ?>
          <ul>
            <?php foreach($errors['password'] as $error): ?>
              <li class="form-text text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <div class="input-group">
          <label for="numTel">Numéro de téléphone</label>
          <input type="text" id="numTel" name="numTel" autocomplete="off" />
        </div>
        <?php if(isset($errors['numTel'])): ?>
          <ul>
            <?php foreach($errors['numTel'] as $error): ?>
              <li class="form-text text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <div class="input-group freezed">
          <label for="birthday">Date de naissance</label>
          <input type="date" id="birthday" name="birthday" autocomplete="off" placeholder="" />
        </div>
        <?php if(isset($errors['birthday'])): ?>
          <ul>
            <?php foreach($errors['birthday'] as $error): ?>
              <li class="form-text text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <div class="input-group">
          <label for="adresse">Adresse</label>
          <input type="text" id="adresse" name="adresse" autocomplete="off" />
        </div>
        <?php if(isset($errors['adresse'])): ?>
          <ul>
            <?php foreach($errors['adresse'] as $error): ?>
              <li class="form-text text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <button type="submit">S'inscrire</button>
      </form>
      <div class="signup-link">
        <p>Vous avez déja un compte ? <a href="<?= BASE_URL ?>/login">Se connecter.</a></p>
      </div>
    </section>

    <!-- Footer -->
    <?php require(ROOT . 'views/templates/footer.php'); ?>

    <?php require(ROOT . 'views/templates/scripts.php'); ?>
  </body>
</html>
