@php
    $segment = Request::segment(1); 
@endphp
<header class="header_section">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.html">
          <span>
            Rumah Makan Anni
          </span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  mx-auto ">
            <li class="nav-item @if($segment == 'home') {{'active'}} @endif">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item @if($segment == 'menu') {{'active'}} @endif">
              <a class="nav-link" href="/menu">Menu</a>
            </li>
            <li class="nav-item @if($segment == 'about') {{'active'}} @endif">
              <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item @if($segment == 'book') {{'active'}} @endif">
              <a class="nav-link" href="/">Book Table</a>
            </li>
          </ul>
          <div class="user_option"> 
            @auth          
              <div class="cart_container">
                <a class="cart_link" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="24" height="24" fill="currentColor">
                    <path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                  </svg>                
                </a> 
                @if ($cartCount > 0)
                    <span id="cart-count" class="cart_badge">{{ $cartCount }}</span>
                @endif 
                
                <div class="cart_dropdown" id="cart-dropdown">
                  <div class="cart_dropdown" id="cart-dropdown">
                    @include('customer.partials.cart_dropdown', ['cartItems' => $cartItems])
                  </div>                
                </div>
              </div> 
              <a href="/logout" class="user_link"> Logout
              </a> 
            @endauth

            @guest
              <a href="/login" class="user_link">
                <i class="fa fa-user-circle"></i> Login
              </a>
            @endguest
          </div>
        </div>
      </nav>
    </div>
  </header>