@extends('layouts.master')

@section('content')
<style type="text/css">
	form {
    float: left;
    margin-top: 0em;
}

 /*text-transform: uppercase;*/
</style>
<div class="container">
home\Cart
<div class="row">
   <div class="col-lg-9 col-sm-6 col-xs-12">

@if(Cart::count() > 0)
	<h2>YOUR BAG <span class="title_cartpage">{{Cart::count()}} ITEMS </span></h2> 

	
	{{-- success error msg start --}}
	@if(session()->has('success_message'))
		<div class="alert alert-success">
			{{session()->get('success_message')}}
		</div>
		@endif

		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		@endif
	{{-- success error msg end --}}
	<hr>
	
		<br>
		@foreach(Cart::content() as $item)
		<div class="container cart_item">
			<div class="row">
				<div class="col-lg-2"><img src="{{asset('img/addiasbag.png')}}" class="img_cartpage"></div>
				<div class="col-lg-5" ><a href="{{route('shop.show', $item->model->slug)}}" class="cart_a"> {{$item->model->name}}</a>
				<p class="cart_p">Color: Black <br>
			       Size: 9.5   <b style="margin-left: 7px;">In Stock</b> <i class="far fa fa-check"></i></p>
			       <p>
					
			       		<form action="" method="POST">
			 		
			 		<button type="submit" class="btn btn-link">Edit</button>
			 	</form>

					<form action="{{route('cart.destroy',$item->rowId)}}" method="POST">
			 		{{csrf_field()}}
			 		{{method_field('DELETE')}}
			 		<button type="submit" class="btn btn-link">Delete</button>
			 	</form>
			       
					<form action="{{route('cart.switchsaveforlater',$item->rowId)}}" method="POST">
			 		{{csrf_field()}}
			 		
			 		<button type="submit" class="btn btn-link">SaveForLater</button>
			 	</form>
			   </p>

				</div>
				<div class="col-lg-2">
					<select name="" class="form-control" style="width: 70px; font-size:12px; font-weight: 700; border-radius: 1px;">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
					</select>
				</div>
				<div class="col-lg-1"></div>
				<div class="col-lg-2">$ {{$item->model->price}}</div>
			</div>
		</div>
		<hr>
		@endforeach
		<div class="row">
			<div class="col-md-10">
				<a href="{{route('shop.index')}}" style="margin-right: 8px">Continue Shopping</a>
				<a href="{{route('checkout')}}" class="btn btn-dark">Checkout <i class="fa fa-arrow-right" style="width: 60px;"></i></a>
			</div>
			<div class="col-md-2">
				<p>Subtotal : {{Cart::subtotal()}}</p>
	<p>Tax(13%) : {{Cart::tax()}}</p>
	<p><b>Total: {{Cart::total()}} </b></p>
			</div>
		</div>
	
		
	
@else
	<h3>No items in Cart!</h3>
@endif

</div> {{-- col-lg-9 col-sm-6 col-xs-12 end --}}
<div class="col-lg-3 col-sm-6 col-xs-12">
			<div class="cart_sidebar">
				<br>
				<button type="button" class="btn btn-dark btn-lg btn-block" style=" margin-right: :4px;">Checkout <i class="fa fa-arrow-right" style="margin-left: 35px;"></i></button>
				<p class="text-center" style="padding: 7px;">By placing your order, you agree to <br>the Delivery Terms</p>
				<h4 style="font-weight: 600; font-size: 22px; margin-left: 9px;">ORDER SUMMARY:</h4>
				<div class="cart-calculator">
					<table class="table">
					<tr>
						<td>{{Cart::count()}} PRODUCTS</td>
						<td></td>
					</tr>		
					<tr>
						<td>Product total</td>
						<td>${{Cart::subtotal()}}</td>
												
					</tr>
					<tr>
						<td>Tax(13%)</td>
						<td>${{Cart::tax()}}</td>
					</tr>
					<tr>
						<td>Delivery</td>
						<td>FREE</td>
					</tr>
					<tr style="font-weight: bold">
						<td>Total</td>
						<td>${{Cart::total()}}</td>
					</tr>
					</table>
				</div>
			</div>
			<br>
			<div class="cart_needhelp">
			<h4>NEED HELP?</h4>
			<p><a href="" style="color: #000;">Shipping</a></p>
			<p><a href="" style="color: #000;">Returns & Exchanges</a></p>
			<p><a href="" style="color: #000;">Contact Us</a></p>
			</div>
		</div> {{-- col-lg-3 col-sm-6 col-xs-12 end --}}
	</div>{{--  row end --}}

<div class="row">
	<div class="col-lg-9">
@if(Cart::instance('saveforlater')->count() > 0)

<h2 class="title_cartpage">{{Cart::instance('saveforlater')->count()}} items Saved For Later</h2>
@foreach(Cart::instance('saveforlater')->content() as $item)

	<div class="container cart_item">
			<div class="row">
				<div class="col-lg-2"><img src="{{asset('img/addiasbag.png')}}" class="img_cartpage"></div>
				<div class="col-lg-5" ><a href="{{route('shop.show', $item->model->slug)}}">{{$item->model->name}}</a>
				<p class="cart_p">Color: Black <br>
			       Size: 9.5   <b style="margin-left: 7px;">In Stock</b> <i class="far fa fa-check"></i></p>
			       <p>
						<form action="{{route('saveforlater.destroy',$item->rowId)}}" method="POST">
			 		{{csrf_field()}}
			 		{{method_field('DELETE')}}
			 		<button type="submit" class="btn btn-link">Remove</button>
			 	</form>
			
			 
			  
			   </p>

				</div>
				<div class="col-lg-2">
					
				</div>
				
				<div class="col-lg-3">$ {{$item->model->price}}<br><br><br>
					<form action="{{route('saveforlater.switchtocart',$item->rowId)}}" method="POST">
			 		{{csrf_field()}}
			 		
			 		<button type="submit" class="btn btn-primary">Move To cart <i class="fa fa-shopping-bag"></i></button>
			 	</form>
				</div>
			</div>
		</div>
		<hr>



			 	
@endforeach
@else

{{-- <h3>You have no items Saved for Later. </h3> --}}

@endif
		
	</div> {{-- col-lg-9 end --}}
	<div class="col-lg-3">
		<div class="cart_sidebar2">
		<h4>ACCEPTED PAYMENT METHODS</h4>
		<img src="https://www.adidas.com/on/demandware.static/-/Sites-adidas-US-Library/en_US/dw88ec105e/us_payment_methods.png" width="300px">

		<p> <div class="cart-fontstyle">FREE SHIPPING, NO MINIMUM.
</div>
<a href="" style="color: #000;">Learn More</a></p>

<p> <div class="cart-fontstyle">SECURE CHECKOUT</div>
Pay safely with SSL technology.</p>

<p> <div class="cart-fontstyle">FREE RETURNS*
</div>
Within 30 days<br>
<a href="" style="color: #000;">read more</a></p>
		</div>
	</div>
</div> {{-- row end --}}	


</div>
<br><br>
@include('layouts.footer');
{{-- <img src="https://assets.adidas.com/images/w_600,h_600,f_auto,q_auto:sensitive,fl_lossy/396c603972dd4882acaba97401399dc8_9366/adidas_NMD_Gym_Sack_Black_DU6812_01_standard.jpg"> --}}
@endsection