<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SimpleBankingPRO</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    {{-- printing css --}}
    <!-- print css -->
<style type="text/css" rel="stylesheet" media="print" ></style>
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
    <style type="text/css">
    .form-control{
      color: black !important; 
      background-color:white !important; 
    }

    .button:hover {
  background-color: lightseagreen !important;
  color: white !important;
}
.button1{
  background-color: #808080 !important;
  color: black !important;
}

.zip{
	overflow-wrap: normal;
  font-weight: bold;
}

hr.tf{
	border-top: 2px dotted white;
	width: 100%;
	margin-top: .8rem;
	margin-bottom: 1rem;

}
    </style>

<style type="text/css" rel="stylesheet" media="print" >

.navbar{
	display: none;
}

.sidebar{
	display: none;
}

.remove1{
	display: none;
}
.remove2{
	display: none;
}


</style>
 
  </head>
  <body style="padding-top: 30px; padding-bottom:30px" onhover="tillbalance()">