    <form class="login-form" action="logueate.php" method="post">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" class="form-control" name="username" pattern="[a-zA-Z0-9]+" required placeholder="Usuario" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="password" required class="form-control" placeholder="contraseña">
        </div>
        <label class="checkbox">
                <input type="checkbox" value="remember-me"> Recordar
                <span class="pull-right"> <a href="#"> ¿Olvidaste tu contraseña?</a></span>
            </label>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        <button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>
      </div>
    </form>