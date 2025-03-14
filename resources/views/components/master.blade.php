<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Medicio</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="d-none d-md-flex align-items-center">
          <i class="bi bi-clock me-1"></i> Monday - Saturday, 8AM to 10PM
        </div>
        <div class="d-flex align-items-center">
          <i class="bi bi-phone me-1"></i> Call us now +1 5589 55488 55
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-end">
        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <img src="{{asset('assets\img\logo.png')}}" alt="">
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="{{route('home')}}" class="active">Home</a></li>
            @guest
            <li><a href="{{route('login')}}">Login</a></li>
            <li><a href="{{route('register')}}">Register</a></li>
            @endguest
            @auth
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            @endauth
            
            @auth
            <li class="dropdown">
              <a href="#">
                  <span>Notifications</span>
                  <i class="bi bi-chevron-down toggle-dropdown"></i>
              </a>
              <ul id="notification-list">
                  @if(auth()->user()->unreadNotifications->count() > 0)
                      @foreach(auth()->user()->unreadNotifications as $notification)
                          <li class="notification-item" data-id="{{$notification->id}}">
                            <a href="#" class="mark-as-read">{{ $notification->data['message'] }} at {{$notification->data['time']}}</a>  
                          </li>
                      @endforeach
                  @else
                      <li class="alert alert-secondary">No new notifications</li>
                  @endif
              </ul>
          </li>
          @endauth

           <li><a href="#doctors">Doctors</a></li>
            <li class="dropdown"><a href="#"><span>Departments</span> <i
                  class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#">Neurologist</a></li>
                <li><a href="#">Ophthalmologist</a></li>
                <li><a href="#">Cardiologist</a></li>
                <li><a href="#">Abdominologist</a></li>
              </ul>
            </li>
            
            <li><a href="#contact">Contact</a></li>
            @auth
            <li>
              <form action="logout" method="POST" class="w-full">
                @csrf
                <button type="submit"
                  class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-200">Logout</button>
              </form>
            </li>
            @endauth

          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        @can('create_appointment')
        <a class="cta-btn" href="{{route('appointments.create')}}">Make an Appointment</a>
        @endcan
        @can('create_slot')
        <a class="cta-btn" href="{{route('slots.create')}}">Make an Slots</a>
        @endcan
      </div>

    </div>

  </header>
  <main class="container mx-auto p-6">
    {{ $slot }}
  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Medicio</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Medicio</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.notification-item .mark-as-read').on('click', function (e) {
            e.preventDefault();

            var notificationItem = $(this).closest('.notification-item');
            var notificationId = notificationItem.data('id');

            $.ajax({
                url: "{{ route('notifications.read') }}",
                type: "POST",
                data: {
                    id: notificationId,
                    _token: "{{ csrf_token() }}" // CSRF protection
                },
                success: function (response) {
                    if (response.success) {
                        notificationItem.fadeOut(); // Hide the notification after marking it as read
                    }
                }
            });
        });
    });
</script>


</body>

</html>