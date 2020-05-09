@extends('layout')


<style>
	body {
		min-height: 100vh;
		background-image:url('https://cdn.dribbble.com/users/2463018/screenshots/5415613/image.png');
		background-size: 800px;
		background-repeat:no-repeat;
		background-position:right;
	}
</style>
@section('body')

<div class="px-32 py-16 w-3/5">
	<h2 class="text-4xl font-bold text-gray-900 mb-4">About Us</h2>
	<div class="flex">
		<div class="font-semibold bg-gray-100 rounded-md p-2 my-1 text-gray-800">If you're an Indian and a motorsport enthusiast, you are in the right place. Join us on Discord where we have 100+ members now! We run a F1 2019 League currently which is already into Season 4, as well as have members who are into Assetto Corsa, iRacing and other racing games. Cheers!</div>
	</div>
	<div class="my-8">
		<p class="font-semibold mb-2 text-gray-700">Get in touch with us on:</p>
		<a href="https://steamcommunity.com/groups/indianracingcommunity">
			<i style='color:#1f3d7a;' class='fab fa-steam text-3xl '></i> 
		</a>		
		<a href="">
			<i class='fab fa-twitter text-blue-500 text-3xl mx-2'></i> 
		</a>
		<a href="https://www.youtube.com/channel/UC2Li3g3zak9gQ6YtE3YThXw">
			<i style='color:red;' class='fab fa-youtube text-3xl '></i>
		</a>	
	</div>
</div>


@endsection