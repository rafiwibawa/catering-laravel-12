@extends('customer.layouts.app')

@section('content')
 
<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Register
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="form_container">
          <form action="/store-register" method="POST">
            @csrf
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required />
              @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}" required />
              @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
              <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}" required />
              @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div> 
            <div class="form-group">
              <textarea name="address" class="form-control" placeholder="Address" cols="30" rows="10" required>{{ old('address') }}</textarea>
              @error('address') <small class="text-danger">{{ $message }}</small> @enderror
            </div> 
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password" required />
              @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group"> 
              <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required />
              @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="btn_box text-center">
              <button type="submit" class="btn btn-primary">
                Register
              </button>
            </div> 
            <div class="text-center mt-3">
              <p>Already have an account? <a href="/login" class="text-primary">Login here</a></p>
            </div>
          </form>
        </div>
      </div> 
    </div>
  </div>
</section>


@endsection 
  