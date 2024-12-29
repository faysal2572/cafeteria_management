  <!--  gallary Section  -->
  <div id="gallary" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
        <h2 class="section-title">OUR MENU</h2>
    </div>
    <div class="gallary row">
        @if(isset($foods) && count($foods) > 0)
        @foreach($foods as $food)
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="foodimage/{{ $food->image }}" alt="{{ $food->title }}" class="gallary-img">
            <div class="gallary-overlay">
                <h4>{{ $food->title }}</h4>
                <p>{{ $food->details }}</p>
                <p>Price: ${{ $food->price }}</p>
                <form action="{{ url('add_cart', $food->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="number" name="quantity" value="1" min="1" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-12 text-center">
            <p>No food items available</p>
        </div>
        @endif
    </div>