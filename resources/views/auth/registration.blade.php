<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 11 Custom User Register Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <style type="text/css">
    body{
      background: #F8F9FA;
    }
    .msg {
    color: red;
    font-weight: 700;
  }
  </style>
</head>
<body>

<section class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <div class="card border border-light-subtle rounded-3 shadow-sm">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="text-center mb-3">
              
            </div>
            <h2 class="fs-6 fw-normal text-center  mb-4">Register</h2>
            <p class="msg"></p>
            <!-- <form method="POST" action="{{ route('register.post') }}">
              @csrf -->

              @session('error')
                  <div class="alert alert-danger" role="alert"> 
                      {{ $value }}
                  </div>
              @endsession

              <div class="row gy-2 ">
                <div class="col-12">
                  <div class=" mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="First Name" required>
                    <!-- <label for="name" class="form-label">{{ __('First Name') }}</label> -->
                  </div>
                  @error('name')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class=" mb-3">
                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname" placeholder="Last Name" required>
                    <!-- <label for="lastname" class="form-label">{{ __('Last Name') }}</label> -->
                  </div>
                  @error('lastname')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class=" mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" required>
                    <!-- <label for="email" class="form-label">{{ __('Email Address') }}</label> -->
                  </div>
                  @error('email')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="mb-3">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone" required>
                    <!-- <label for="phone" class="form-label">{{ __('Phone') }}</label> -->
                  </div>
                  @error('phone')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="mb-3">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" required>
                    <!-- <label for="username" class="form-label">{{ __('Username') }}</label> -->
                  </div>
                  @error('username')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" placeholder="Password" required>
                    <!-- <label for="password" class="form-label">{{ __('Password') }}</label> -->
                  </div>
                  @error('password')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
               
                <div class="col-12">
                  <div class="d-grid my-3">
                    <button class="btn btn-primary btn-lg" id="register" type="submit">{{ __('Register') }}</button>
                  </div>
                </div>
                <div class="col-12">
                  <p class="m-0 text-secondary text-center">Have an account? <a href="{{ route('login') }}" class="link-primary text-decoration-none">Sign in</a></p>
                </div>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#register").on("click", function() {
      console.log("{{route('register.post')}}");
      var name = $("#name").val();
      var lastname = $("#lastname").val();
      var email = $("#email").val();
      var phone = $("#phone").val();
      var username = $("#username").val();
      var password = $("#password").val();
      var regex = /^(0|91)?[6-9][0-9]{9}$/;
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if (name == '' || lastname == '' || email == '' || password == '' || username == '' || phone == '') {
        $(".msg").html("All fields are required!");
      } else if (!regex.test($("#phone").val())) {
        $(".msg").html("Invalid Mobile Number.");
      }else if(!emailReg.test( $("#email").val() )){
        $(".msg").html("Invalid Email format .");
      }
      else {
        $.ajax({
          url: "{{ route('register.post') }}",
          method: 'post',
          data: {
            name: name,
            lastname: lastname,
            email: email,
            username: username,
            password: password,
            phone: phone,
            _token: "{{ csrf_token() }}"
          
          },
          success: function(data) {
            console.log("{{session}}");
            $(".msg").html(data);
            $("input[type='text'], input[type='email'], input[type='password']").val('');
          }
        });
      }
    });
  });
// mobile number validation:
//   1. It should be 10 digits long.
// 2. The first digit should be a number. 6 to 9.
// 3. The rest 9 digits should be any number. 0 to 9.
// 4. It can have 11 digits including 0 at the starting.
// 5. It can have 12 digits including 91 at the starting.
// Examples: 9876543210, 09876543210, 919876543210
</script>