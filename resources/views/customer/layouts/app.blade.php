<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png')}}" type="">

  <title> Rumah Makan Anni </title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('customer/css/bootstrap.css') }}" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="{{ asset('customer/css/font-awesome.min.css') }}" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('customer/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('customer/css/responsive.css') }}" rel="stylesheet" />


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.6/sweetalert2.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <!-- Font Awesome CDN --> 
  @stack('style')

  <style>
    .profile_container {
      position: relative;
      display: inline-block;
    }
    .profile_dropdown {
      position: absolute;
      right: 0;
      margin-top: 10px;
      background: white;
      border-radius: 6px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
      padding: 10px;
      width: 180px;
      opacity: 0;
      visibility: hidden;
      transition: all 0.2s ease-in-out;
      z-index: 1000;
    }
    .profile_container:hover .profile_dropdown {
      opacity: 1;
      visibility: visible;
    }
      .cart_container {
        position: relative;
        display: inline-block;
      }
      
      .cart_dropdown {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        min-width: 350px;
        box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
        padding: 10px;
        z-index: 1;
        border-radius: 8px;
      }
      
      .cart_container:hover .cart_dropdown {
        display: block;
      }
      
      .cart_item {
        padding: 5px 0;
        border-bottom: 1px solid #eee;
      }
      
      .cart_badge {
          position: absolute;
          top: -5px;
          right: -5px;
          background-color: red;
          color: white;
          font-size: 12px;
          padding: 2px 6px;
          border-radius: 50%;
          font-weight: bold;
          min-width: 10px;
          text-align: center;  
      }
  </style>

</head>

<body class="{{ ($page ?? false) ? '' : 'sub_page' }}">

  <div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('customer/images/bg-.jpeg') }}" alt="">
    </div>
    <!-- header section strats -->
    
    @include('customer.layouts.header')

    <!-- end header section -->
    <!-- slider section -->
    @stack('slider')
    <!-- end slider section -->
  </div>
 
  @yield('content')

  <!-- footer section -->
    @include('customer.layouts.footer')
  <!-- footer section -->

  <!-- jQery -->
  <script src="{{ asset('customer/js/jquery-3.4.1.min.js') }}"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="{{ asset('customer/js/bootstrap.js') }}"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="{{ asset('customer/js/custom.js') }}"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.6/sweetalert2.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- End Google Map -->
  @stack('script')

  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        statusCode: {
            403: function(){
                window.location = '{{url('login')}}';
            },
            419: function(){
                window.location = '{{url('login')}}';
            }
        }
    });
  </script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const profileContainer = document.getElementById('profile-container');
    const profileButton = document.getElementById('profile-button');
    const profileDropdown = document.getElementById('profile-dropdown');
    const chevronIcon = document.getElementById('chevron-icon');
  
    if (profileButton && profileDropdown) {
      // Toggle dropdown
      profileButton.addEventListener('click', function(e) {
        e.stopPropagation();
        const isActive = profileDropdown.style.opacity === '1';
        
        if (isActive) {
          profileDropdown.style.opacity = '0';
          profileDropdown.style.visibility = 'hidden';
          profileDropdown.style.transform = 'translateY(-10px)';
          chevronIcon.style.transform = 'rotate(0deg)';
          profileButton.style.backgroundColor = 'transparent';
        } else {
          profileDropdown.style.opacity = '1';
          profileDropdown.style.visibility = 'visible';
          profileDropdown.style.transform = 'translateY(0)';
          chevronIcon.style.transform = 'rotate(180deg)';
          profileButton.style.backgroundColor = 'rgba(0, 0, 0, 0.05)';
        }
      });
  
      // Hover effect for button
      profileButton.addEventListener('mouseenter', function() {
        if (profileDropdown.style.opacity !== '1') {
          this.style.backgroundColor = 'rgba(0, 0, 0, 0.05)';
        }
      });
      
      profileButton.addEventListener('mouseleave', function() {
        if (profileDropdown.style.opacity !== '1') {
          this.style.backgroundColor = 'transparent';
        }
      });
  
      // Close when clicking outside
      document.addEventListener('click', function(e) {
        if (!profileContainer.contains(e.target)) {
          profileDropdown.style.opacity = '0';
          profileDropdown.style.visibility = 'hidden';
          profileDropdown.style.transform = 'translateY(-10px)';
          chevronIcon.style.transform = 'rotate(0deg)';
          profileButton.style.backgroundColor = 'transparent';
        }
      });
  
      // Close when pressing Escape
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          profileDropdown.style.opacity = '0';
          profileDropdown.style.visibility = 'hidden';
          profileDropdown.style.transform = 'translateY(-10px)';
          chevronIcon.style.transform = 'rotate(0deg)';
          profileButton.style.backgroundColor = 'transparent';
        }
      });
    }
  });
  </script>

</body>

</html>