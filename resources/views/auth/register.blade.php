@extends('layout')
    
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Register</div>
                  <div class="card-body">
    
                      <form action="{{ route('register.post') }}" method="POST" id="handleAjax">
  
                          @csrf
 
                          <div id="errors-list"></div>
 
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Lastname</label>
                              <div class="col-md-6">
                                  <input type="text" id="lastname" class="form-control" name="lastname" required autofocus>
                                  @if ($errors->has('lastname'))
                                      <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                  @endif
                              </div>
                          </div>
                          
    
                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail ID</label>
                              <div class="col-md-6">
                                  <input type="text" id="email" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="phonne" class="col-md-4 col-form-label text-md-right">Phone</label>
                              <div class="col-md-6">
                                  <input type="text" id="phone" class="form-control" name="phone" required autofocus>
                                  @if ($errors->has('phone'))
                                      <span class="text-danger">{{ $errors->first('phone') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>
                              <div class="col-md-6">
                                  <input type="text" id="username" class="form-control" name="username" required autofocus>
                                  @if ($errors->has('username'))
                                      <span class="text-danger">{{ $errors->first('username') }}</span>
                                  @endif
                              </div>
                          </div>
    
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <div class="col-md-6 offset-md-4">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember"> Remember Me
                                      </label>
                                  </div>
                              </div>
                          </div>
    
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Register
                              </button>
                          </div>
                      </form>
                          
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">

      $(document).on("submit", "#handleAjax", function() {
          var e = this;
  
          $(this).find("[type='submit']").html("Register...");
  
          $.ajax({
              url: $(this).attr('action'),
              data: $(this).serialize(),
              type: "POST",
              dataType: 'json',
              success: function (data) {
  
                $(e).find("[type='submit']").html("Register");
                  
                if (data.status) {
                    window.location = data.redirect;
                }else{
  
                    $(".alert").remove();
                    $.each(data.errors, function (key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                }
             
              }
          });
  
          return false;
      });
  
    
  
</script>
@endsection