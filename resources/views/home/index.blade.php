<!DOCTYPE html>
<html lang="en">
<head>
	@include('home.css')
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    
   @include('home.navbar_header')

  @include('home.about')

  @include('home.gallary')

    @include('home.book')
    @include('home.blog')
   
    @include('home.footer')

	<!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- wow.js -->
    <script src="assets/vendors/wow/wow.js"></script>
    
    <!-- google maps -->
    <script async defer src="https:maps/place/BRAC+University/@23.7730866,90.423981,18.21z/data=!4m14!1m7!3m6!1s0x3755c7715a40c603:0xec01cd75f33139f5!2sBRAC+University!8m2!3d23.7725001!4d90.4252945!16s%2Fg%2F120vm_vk!3m5!1s0x3755c7715a40c603:0xec01cd75f33139f5!8m2!3d23.7725001!4d90.4252945!16s%2Fg%2F120vm_vk?entry=ttu&g_ep=EgoyMDI0MTIwOC4wIKXMDSoASAFQAw%3D%3D"></script>

    <!-- urban Table js -->
    <script src="assets/js/urbantable.js"></script>

</body>
</html>
