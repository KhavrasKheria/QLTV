<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Book Library</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/icomoon.css') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/transitions.css') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/color.css') }}">
  <link rel="stylesheet" href="{{ asset('book_library/css/responsive.css') }}">
  <script src="{{ asset('book_library/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
</head>

<body class="tg-home tg-homeone">

  <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
    <!--************************************
				header Start
		*************************************-->
    @include('trangchu.partials.header')
    <!--************************************
				Header End
		*************************************-->

    <!--************************************
					Best_Selling Start
			*************************************-->
    @include('trangdanhsach.partials.sach')
    <!--************************************
					Best Selling End
			*************************************-->

    <!--************************************
					featured_item Start
			*************************************-->

    <!--************************************
					Featured Item End
			*************************************-->
    <!--************************************
					new_release Start
			*************************************-->

    <!--************************************
					New Release End
			*************************************-->
    <!--************************************
					collection_count Start
			*************************************-->

    <!--************************************
					Collection Count End
			*************************************-->
    <!--************************************
					picked_by_author Start
			*************************************-->

    <!--************************************
					Picked By Author End
			*************************************-->
    <!--************************************
					testimonials Start
			*************************************-->

    <!--************************************
					Testimonials End
			*************************************-->

    <!--************************************
					call_to_action Start
			*************************************-->
    @include('trangchu.partials.collection_count')
    <!--************************************
					Call to Action End
			*************************************-->
    <!--************************************
					latest_news Start
			*************************************-->
    @include('trangchu.partials.testimonials')
    <!--************************************
					Latest News End
			*************************************-->
    </main>
    <!--************************************
				Main End
		*************************************-->
    <!--************************************
				footer Start
		*************************************-->
    @include('trangchu.partials.footer')
    <!--************************************
				Footer End
		*************************************-->
  </div>
  <!--************************************
			Wrapper End
	*************************************-->
  <script src="{{ asset('book_library/js/vendor/jquery-library.js') }}"></script>
  <script src="{{ asset('book_library/js/vendor/bootstrap.min.js') }}"></script>
  <script src="{{ asset('https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en') }}"></script>
  <script src="{{ asset('book_library/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js') }}"></script> <!-- Thêm dòng này -->
  <script src="{{ asset('book_library/js/jquery.vide.min.js') }}"></script>
  <script src="{{ asset('book_library/js/countdown.js') }}"></script>
  <script src="{{ asset('book_library/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('book_library/js/parallax.js') }}"></script>
  <script src="{{ asset('book_library/js/countTo.js') }}"></script>
  <script src="{{ asset('book_library/js/appear.js') }}"></script>
  <script src="{{ asset('book_library/js/gmap3.js') }}"></script>
  <script src="{{ asset('book_library/js/main.js') }}"></script>

  <!--************************************
				Start API Sach
		*************************************-->



  <!--************************************
				End API Sach
		*************************************-->

</body>

</html>