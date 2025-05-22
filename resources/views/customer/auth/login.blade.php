@extends('customer.layouts.app')

@section('content')
 
<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Login
      </h2>
      <p>Enter your email & password to login</p>
    </div>
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="form_container">
          <form action="/login" method="POST">
            @csrf 
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Your Email" value="pelanggan@example.com" required />     
              @error('email') <small class="text-danger">{{ $message }}</small> @enderror 
            </div>  
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password" value="password" required />     
              @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div> 
            <div class="btn_box text-center">
              <button type="submit" class="btn btn-primary">
                Login
              </button>
            </div>
            <div class="text-center mt-3">
              <p>Don't have an account yet? <a href="/register" class="text-primary">Sign up here</a></p>
            </div>
          </form>
        </div>
      </div> 
    </div>
  </div>
</section>

@endsection 
  