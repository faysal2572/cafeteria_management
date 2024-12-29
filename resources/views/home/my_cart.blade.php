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
                    <a class="nav-link" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/#about')}}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/#gallary')}}">Gallary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/#book-table')}}">Book-Table</a>
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
        @if(count($data) > 0)
        <table>
            <tr>
                <th>Food Title</th>
                <th>Food Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Remove</th>
            </tr>

            <?php $total_price = 0; ?>

            @foreach($data as $data)
            <tr>
                <td>{{$data->title}}</td>
                <td>{{$data->price}}</td>
                <td>{{$data->quantity}}</td>
                <td>
                    <img width="150" src="food_img/{{$data->image}}" alt="">
                </td>
                <td>
                    <a onclick="return confirm('Are you sure to remove this?')" class="btn btn-danger" href="{{url('remove_cart',$data->id)}}">Remove</a>
                </td>
            </tr>
            
            <?php $total_price = $total_price + $data->price; ?>
            @endforeach

            <h3 style="margin-top: 20px;">Total Price: ${{$total_price}}</h3>

            <div class="payment-buttons" style="margin: 20px;">
                <form action="{{ url('cash_payment') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn" style="background-color: red; color: white; margin: 10px; padding: 10px 30px; font-size: 16px;">Cash Payment</button>
                </form>

                <form action="{{ url('card_payment_page') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="margin: 10px; padding: 10px 30px; font-size: 16px;">Card Payment</button>
                </form>
            </div>
        </table>
        @else
            @if(session()->has('message'))
                <div class="alert alert-success" style="margin: 20px; padding: 20px;">
                    {{ session()->get('message') }}
                </div>
            @else
                <div style="padding: 50px;">
                    <h3>Your cart is empty</h3>
                    <a href="{{url('/')}}" class="btn btn-primary" style="margin-top: 20px;">Continue Shopping</a>
                </div>
            @endif
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
