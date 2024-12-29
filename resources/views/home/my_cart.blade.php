<!DOCTYPE html>
<html lang="en">
<head>
	@include('home.css')
    <style>
        table
        {
            margin:40px;
            border:1px solid skyblue;
            padding:40px;
        }
        
        th
        {
            padding:10px;
            text-align:center;
            background-color:red;
            color:white;
            font-weight:bold;
        }

        td
        {
            padding:10px;
            color:white;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    
<!-- Navbar -->
<nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallary">Gallary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#book-table">Book-Table</a>
                </li>
            </ul>
            <a class="navbar-brand m-auto" href="#">
                <img width=150 src="assets/imgs/logo2.png" class="brand-img" alt="">
                <span class="brand-txt">Urban Table</span>
            </a>
            <ul class="navbar-nav">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#blog">Blog<span class="sr-only">(current)</span></a>
                </li> -->

                @if (Route::has('login'))

                @auth

                <li class="nav-item">
                    <a class="nav-link" href="{{url('my_cart')}}">Cart</a>
                </li>

                <form action="{{route('logout')}}"method="Post">
                    @csrf
                    <input class="btn btn-primary ml-xl-4" type="submit" value="Logout">
                </form>

                @else


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>

                    @endauth
                @endif

            </ul>
        </div>
    </nav>

    </br> </br> </br> </br>

    <div id="gallary" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
        <table>
            <tr>
                <th>Food Title</th>
                <th>Food Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Image</th>
                <th>Remove</th>
            </tr>

            @foreach($cart_items as $item)
            <tr>
                <td>{{$item->title}}</td>
                <td>${{$item->price}}</td>
                <td>{{$item->quantity}}</td>
                <td>${{$item->price * $item->quantity}}</td>
                <td><img height="100" width="100" src="food_img/{{$item->image}}"></td>
                <td><a class="btn btn-danger" href="{{url('remove_cart',$item->id)}}">Remove</a></td>
            </tr>
            @endforeach

            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total Price:</strong></td>
                <td colspan="3"><strong>${{$total_price}}</strong></td>
            </tr>
        </table>

        @if(count($cart_items) > 0)
        <div style="padding: 10px; display: flex; justify-content: center; gap: 10px;">
            <form action="{{url('confirm_order')}}" method="POST">
                @csrf
                <input type="submit" class="btn btn-primary" value="Confirm Order">
            </form>
            <a href="#" class="btn btn-danger" onclick="handlePayment()">Pay Now</a>
        </div>

        <script>
            function handlePayment() {
                // You can customize this function to integrate with your payment gateway
                alert('Redirecting to payment gateway...');
                // Add your payment gateway integration code here
            }
        </script>
        @endif
    </div>

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
