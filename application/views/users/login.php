<style type="text/css">
  body {
    background: #4e54c8;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #8f94fb, #4e54c8);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #8f94fb, #4e54c8); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  }
</style>

<div class="row">
  <div class="col-12 col-md-6 col-lg-4 offset-md-3 offset-lg-4 mt-5">
  <h1 class="text-white">Cloud Storage</h1>
    <div class="card text-center">
      <div class="card-body" id="login">
        <h5 class="card-title">Login</h5>
          <?php echo form_open('users/login'); ?>
              <div class="form-label-group text-left">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="Email" required autofocus>
              </div>

              <div class="form-label-group text-left mt-3">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="Password" required>
              </div>

              <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Login</button>
          <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>