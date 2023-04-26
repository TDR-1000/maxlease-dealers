<div class="sign_up_modal modal fade" id="logInModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body container p60">
        <div class="row">
          <div class="col-lg-12">
            <ul class="sign_up_tab nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="tab-content container p0" id="myTabContent">
          <div class="row mt30 tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="col-lg-12">
              <div class="login_form">
                <p>New to Cars.com? <a href="page-register.html">Sign up.</a> Are you a dealer?</p>
                <form action="#">
                  <div class="mb-2 mr-sm-2">
                    <label class="form-label">Username or email address *</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group mb5">
                    <label class="form-label">Password *</label>
                    <input type="password" class="form-control">
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="exampleCheck3">
                    <label class="custom-control-label" for="exampleCheck3">Remember me</label>
                    <a class="btn-fpswd float-end" href="#">Lost your password?</a>
                  </div>
                  <button type="submit" class="btn btn-log btn-thm mt5">Sign in</button>
                </form>
              </div>
            </div>
          </div>
          <div class="row mt30 tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="col-lg-12">
              <div class="sign_up_form">
                <p>Already have a profile? <a href="page-login.html">Sign in.</a></p>
                <form action="#">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb20">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb20">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-signup btn-thm mb0">Sign Up</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>