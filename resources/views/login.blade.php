<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Agriculture Connectivity and Livestock Management System">
  <meta name="author" content="AgriConnect">
  <meta name="keywords" content="agriculture, livestock, management, connectivity, farming, agritech">

  <title>AgriConnect - Login</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">

  <!-- Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <!-- Layout Styles -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}">

  <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />
  
  <style type="text/css">
    :root {
      --primary-color: #2E7D32;
      --primary-dark: #1B5E20;
      --primary-light: #C8E6C9;
      --secondary-color: #FFC107;
      --accent-color: #4CAF50;
      --dark-color: #263238;
      --light-color: #f5f5f5;
      --gradient: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
      --gradient-accent: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
      --card-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
      --card-shadow-hover: 0 15px 40px -10px rgba(0,0,0,0.15);
      --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #001B07;
      overflow-x: hidden;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: var(--light-color);
      line-height: 1.6;
    }
    
    .main-wrapper {
      flex: 1;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      background-color: #001B07;
    }
    
    .auth-container {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
    }
    
    .auth-card {
      border: none;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px -10px rgba(255,255,255,0.1);
      transform-style: preserve-3d;
      transition: var(--transition);
    
      width: 100%;
      position: relative;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.1);
    }
    
    .auth-card:hover {
      transform: translateY(-10px) rotateX(2deg) rotateY(2deg);
      box-shadow: 0 20px 50px -10px rgba(255,255,255,0.2);
    }
    
    .auth-form-wrapper {
      padding: 3rem;
      background: rgba(0, 8, 2, 0.7);
      position: relative;
      z-index: 1;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    
    .auth-form-wrapper::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: var(--gradient);
      z-index: -1;
      opacity: 0.1;
      clip-path: polygon(0 0, 100% 0, 100% 30%, 0 70%);
    }
    
    .agri-logo {
      text-align: center;
      margin-bottom: 2rem;
      position: relative;
    }
    
    .logo-text {
      display: inline-block;
      font-family: 'Montserrat', sans-serif;
      font-size: clamp(1.8rem, 5vw, 3rem);
      font-weight: 700;
      color: white;
      position: relative;
      background: var(--gradient);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      animation: fadeInDown 1s both;
      letter-spacing: -1px;
    }
    
    .logo-text::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 4px;
      background: var(--gradient);
      border-radius: 2px;
      animation: scaleIn 0.8s both 0.5s;
    }
    
    .logo-subtext {
      display: block;
      color: var(--primary-light);
      font-size: clamp(1rem, 2.5vw, 1.3rem);
      font-weight: 500;
      margin-top: 1rem;
      animation: fadeInUp 1s both 0.5s;
      text-transform: uppercase;
      letter-spacing: 2px;
    }
    
    .form-control {
      border-radius: 12px;
      padding: 15px 20px;
      border: 2px solid rgba(255,255,255,0.2);
      transition: var(--transition);
      box-shadow: none;
      width: 100%;
      font-size: 1rem;
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 4px rgba(46, 125, 50, 0.2);
      background-color: rgba(255,255,255,0.2);
    }
    
    .form-control::placeholder {
      color: rgba(255,255,255,0.5);
    }
    
    .btn-primary {
      background: var(--gradient);
      border: none;
      border-radius: 12px;
      padding: 15px 30px;
      font-weight: 600;
      transition: var(--transition);
      position: relative;
      overflow: hidden;
      z-index: 1;
      font-size: 1rem;
      width: 100%;
      margin: 0 auto;
      display: block;
      color: white;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
    }
    
    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(46, 125, 50, 0.4);
      color: white;
    }
    
    .btn-primary:active {
      transform: translateY(1px);
    }
    
    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: var(--gradient-accent);
      transition: var(--transition);
      z-index: -1;
      opacity: 0;
    }
    
    .btn-primary:hover::before {
      opacity: 1;
    }
    
    /* Password toggle */
    .password-toggle {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: rgba(255,255,255,0.5);
      transition: color 0.3s;
      background: none;
      border: none;
      padding: 0;
      z-index: 2;
    }
    
    .password-toggle:hover {
      color: var(--primary-light);
    }
    
    .input-group {
      position: relative;
      margin-bottom: 1.8rem;
    }
    
    .input-group label {
      display: block;
      margin-bottom: 0.8rem;
      font-weight: 500;
      color: white;
      font-size: 0.95rem;
      transition: var(--transition);
    }
    
    /* Form elements */
    .form-check {
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
    }
    
    .form-check-input {
      margin-right: 0.8rem;
      width: 18px;
      height: 18px;
      border: 2px solid rgba(255,255,255,0.3);
      transition: var(--transition);
      background-color: transparent;
    }
    
    .form-check-input:checked {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .form-check-label {
      font-size: 0.9rem;
      color: rgba(255,255,255,0.8);
    }
    
    .text-center {
      text-align: center;
    }
    
    .text-primary {
      color: var(--primary-light) !important;
      text-decoration: none;
      transition: var(--transition);
      font-weight: 500;
    }
    
    .text-primary:hover {
      color: white !important;
      text-decoration: underline;
    }
    
    .text-muted {
      color: rgba(255,255,255,0.6) !important;
    }
    
    /* Agricultural decorations */
    .agri-decoration {
      position: absolute;
      opacity: 0.1;
      z-index: -1;
      color: var(--primary-color);
      animation: float 8s infinite ease-in-out;
      pointer-events: none;
    }
    
    /* Leaf decorations */
    .leaf-1 {
      top: 10%;
      left: 5%;
      font-size: 120px;
      color: var(--primary-light);
      animation-delay: 0s;
    }
    
    .leaf-2 {
      bottom: 15%;
      right: 5%;
      font-size: 150px;
      color: var(--accent-color);
      animation-delay: 0.5s;
      animation-direction: reverse;
    }
    
    .leaf-3 {
      top: 25%;
      right: 10%;
      font-size: 80px;
      color: #8BC34A;
      animation-delay: 1s;
    }
    
    .leaf-4 {
      bottom: 25%;
      left: 10%;
      font-size: 100px;
      color: #689F38;
      animation-delay: 1.5s;
    }
    
    /* Wheat decorations */
    .wheat-1 {
      top: 5%;
      right: 15%;
      font-size: 90px;
      color: #FFC107;
      animation-delay: 0.3s;
    }
    
    .wheat-2 {
      bottom: 5%;
      left: 15%;
      font-size: 110px;
      color: #FFA000;
      animation-delay: 0.8s;
    }
    
    /* Seedling decorations */
    .seedling-1 {
      top: 70%;
      left: 20%;
      font-size: 70px;
      color: #4CAF50;
      animation-delay: 0.7s;
    }
    
    .seedling-2 {
      top: 20%;
      right: 20%;
      font-size: 60px;
      color: #8BC34A;
      animation-delay: 1.2s;
    }
    
    /* Tractor decoration */
    .tractor {
      bottom: 10%;
      right: 20%;
      font-size: 80px;
      color: #607D8B;
      animation-delay: 0.9s;
    }
    
    /* Barn decoration */
    .barn {
      top: 15%;
      left: 20%;
      font-size: 90px;
      color: #795548;
      animation-delay: 0.6s;
    }
    
    /* Input group with icons */
    .input-group-text {
      background-color: rgba(255,255,255,0.1);
      border-right: none;
      border-radius: 12px 0 0 12px !important;
      padding-right: 0;
      color: rgba(255,255,255,0.7);
      border-color: rgba(255,255,255,0.2);
    }
    
    .input-group .form-control {
      border-left: none;
      border-radius: 0 12px 12px 0 !important;
      padding-left: 10px;
    }
    
    /* Particles container */
    .particles-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
      background-color: #000000;
    }
    
    /* Keyframes */
    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    @keyframes grain {
      0%, 100% { transform: translate(0, 0); }
      10% { transform: translate(-5%, -10%); }
      20% { transform: translate(-15%, 5%); }
      30% { transform: translate(7%, -25%); }
      40% { transform: translate(-5%, 25%); }
      50% { transform: translate(-15%, 10%); }
      60% { transform: translate(15%, 0%); }
      70% { transform: translate(0%, 15%); }
      80% { transform: translate(3%, -35%); }
      90% { transform: translate(-10%, 10%); }
    }
    
    @keyframes scaleIn {
      from { transform: translateX(-50%) scaleX(0); }
      to { transform: translateX(-50%) scaleX(1); }
    }
    
    /* Responsive adjustments */
    @media (max-width: 767px) {
      .auth-card {
        border-radius: 15px;
      }
      
      .auth-form-wrapper {
        padding: 2rem;
      }
      
      .btn-primary {
        padding: 12px 25px;
      }
      
      /* Hide some decorations on mobile */
      .leaf-1, .leaf-2, .leaf-3, .leaf-4,
      .wheat-1, .wheat-2,
      .seedling-1, .seedling-2,
      .tractor, .barn {
        display: none;
      }
    }
    
    @media (max-width: 575px) {
      .auth-form-wrapper {
        padding: 1.5rem;
      }
      
      .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
      }
      
      .form-check {
        margin-bottom: 1rem;
      }
    }
    
    /* Reduced motion accessibility */
    @media (prefers-reduced-motion: reduce) {
      * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
      }
    }
  </style>
</head>
<body>
  <div class="main-wrapper" >
    <!-- Agricultural decorative elements -->
    <div class="agri-decoration leaf-1">
      <i class="fas fa-leaf"></i>
    </div>
    <div class="agri-decoration leaf-2">
      <i class="fas fa-leaf"></i>
    </div>
    <div class="agri-decoration leaf-3">
      <i class="fas fa-leaf"></i>
    </div>
    <div class="agri-decoration leaf-4">
      <i class="fas fa-leaf"></i>
    </div>
    <div class="agri-decoration wheat-1">
      <i class="fas fa-wheat-awn"></i>
    </div>
    <div class="agri-decoration wheat-2">
      <i class="fas fa-wheat-awn"></i>
    </div>
    <div class="agri-decoration seedling-1">
      <i class="fas fa-seedling"></i>
    </div>
    <div class="agri-decoration seedling-2">
      <i class="fas fa-seedling"></i>
    </div>
    <div class="agri-decoration tractor">
      <i class="fas fa-tractor"></i>
    </div>
    <div class="agri-decoration barn">
      <i class="fas fa-barn"></i>
    </div>
    
    <!-- Particles background -->
    <div style="background-color:rgb(1, 19, 5);" class="particles-container" id="particles-js"></div>
    
    <!-- Centered auth container -->
    <div class="auth-container" >
      <div class="auth-card animate__animated animate__fadeInUp">
        <div class="auth-form-wrapper">
          <div class="agri-logo">
            <span class="logo-text">AgriConnect</span>
            <span class="logo-subtext">Livestock Management System</span>
          </div>
          
          <form class="forms-sample animate__animated animate__fadeIn animate__delay-1s" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
              <label for="login" class="form-label mb-2">Email or Name</label>
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-user"></i>
                </span>
                <input type="text" class="form-control" name="login" id="login" placeholder="Enter your credentials" required>
              </div>
            </div>
            
            <div class="mb-4">
              <label for="password" class="form-label mb-2">Password</label>
              <div class="input-group position-relative">
                <span class="input-group-text">
                  <i class="fas fa-lock"></i>
                </span>
                <input 
                  type="password" 
                  class="form-control" 
                  id="password" 
                  name="password" 
                  placeholder="Enter your password" 
                  required
                  style="padding-right: 45px;"
                >
                <button 
                  type="button" 
                  class="btn password-toggle position-absolute" 
                  id="togglePassword" 
                  aria-label="Toggle password visibility"
                  style="
                    right: 15px;
                    top: 50%;
                    transform: translateY(-50%);
                    background: transparent;
                    border: none;
                    color: rgba(255,255,255,0.5);
                    z-index: 5;
                    padding: 0;
                  "
                >
                  <i class="fas fa-eye" id="eyeIcon"></i>
                </button>
              </div>
            </div>
            
            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-sign-in-alt me-2"></i> Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Core JS -->
  <script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>

  <!-- Plugins JS -->
  <script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/template.js') }}"></script>
  
  <!-- Particles.js -->
  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  
  <script>
    // Initialize feather icons
    feather.replace();
    
    // Password toggle functionality
    document.getElementById('togglePassword').addEventListener('click', function() {
      const password = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      
      // Toggle the password input type
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      
      // Toggle the eye icon
      if (type === 'password') {
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      } else {
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      }
    });
    
    // Initialize particles.js with dark theme settings
    document.addEventListener('DOMContentLoaded', function() {
      if (typeof particlesJS !== 'undefined') {
        particlesJS('particles-js', {
          "particles": {
            "number": {
              "value": 60,
              "density": {
                "enable": true,
                "value_area": 800
              }
            },
            "color": {
              "value": "#4CAF50"
            },
            "shape": {
              "type": "circle",
              "stroke": {
                "width": 0,
                "color": "#000000"
              },
              "polygon": {
                "nb_sides": 5
              }
            },
            "opacity": {
              "value": 0.5,
              "random": true,
              "anim": {
                "enable": false,
                "speed": 1,
                "opacity_min": 0.1,
                "sync": false
              }
            },
            "size": {
              "value": 3,
              "random": true,
              "anim": {
                "enable": false,
                "speed": 40,
                "size_min": 0.1,
                "sync": false
              }
            },
            "line_linked": {
              "enable": true,
              "distance": 150,
              "color": "#4CAF50",
              "opacity": 0.2,
              "width": 1
            },
            "move": {
              "enable": true,
              "speed": 1.5,
              "direction": "none",
              "random": false,
              "straight": false,
              "out_mode": "out",
              "bounce": false,
              "attract": {
                "enable": false,
                "rotateX": 600,
                "rotateY": 1200
              }
            }
          },
          "interactivity": {
            "detect_on": "canvas",
            "events": {
              "onhover": {
                  "enable": true,
                "mode": "repulse"
              },
              "onclick": {
                "enable": true,
                "mode": "push"
              },
              "resize": true
            },
            "modes": {
              "repulse": {
                "distance": 100,
                "duration": 0.4
              },
              "push": {
                "particles_nb": 4
              }
            }
          },
          "retina_detect": true
        });
      }
    });
    
    // Form validation
    const form = document.querySelector('form');
    if (form) {
      form.addEventListener('submit', function(e) {
        const login = document.getElementById('login');
        const password = document.getElementById('password');
        
        if (!login.value.trim()) {
          e.preventDefault();
          login.focus();
          login.style.borderColor = '#f44336';
          return false;
        }
        
        if (!password.value.trim()) {
          e.preventDefault();
          password.focus();
          password.style.borderColor = '#f44336';
          return false;
        }
      });
    }
  </script>
</body>
</html>