<!DOCTYPE html>
<html lang="en">
  <?php require(ROOT . 'views/templates/head.php'); ?>
  <body>
    <!-- Header -->
    <?php require(ROOT . 'views/templates/header.php'); ?>

    <section id="login">
      <form method="POST" action="<?= BASE_URL ?>/login" class="form" id="login-form">
        <h2 class="form-title">Se connecter</h2>
        <div class="input-group">
          <label for="username">Nom d'utilisateur</label>
          <input type="text" id="username" name="username" />
        </div>
        <?php if(isset($errors['username'])): foreach($errors['username'] as $e): ?>
          <div class="error"><?= $e ?></div>
        <?php endforeach; endif; ?>
        <div class="input-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" />
        </div>
        <?php if(isset($errors['password'])): foreach($errors['password'] as $e): ?>
          <div class="error"><?= $e ?></div>
        <?php endforeach; endif; ?>
        <?php if(isset($errors['auth'])): ?>
          <div class="error"><?= $errors['auth'] ?></div>
        <?php endif; ?>
        <button type="submit">Se connecter</button>
      </form>
      <div class="signup-link">
        <p>Vous n'avez pas encore un compte ? <a href="<?= BASE_URL ?>/signup">Créer le.</a></p>
      </div>
    </section>

    <!-- Footer -->
    <?php require(ROOT . 'views/templates/footer.php'); ?>

    <?php require(ROOT . 'views/templates/scripts.php'); ?>
  </body>
</html>
