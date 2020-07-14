@extends('layouts.welcomeLayout')


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
		<div class="font-semibold bg-green-100 rounded-md p-2 my-1 text-black-500"><strong>Indian Racing Community</strong> is one of the largest hubs for Indian racing enthusiasts & sim racers. This is the place for all discussions related to motorsports and IRC events. We engage into all the real life motorsport chatter, memes, and everything in between. You will find one of the best Indian motorsport fanbase in our community to interact with, and make friends with.
		</div>
	</div>
	<div class="flex">
		<div class="font-semibold bg-gray-100 rounded-md p-2 my-1 text-gray-700"><span class="text-green-600 ml-2 mr-2">●</span><strong>IRC eSports</strong> is a wholly owned subsidiary of IRC currently hosted on our Discord server. IRC eSports division holds league races on the Latest Official F1 Game on PC (currently, F1 2020) which is open for all players regardless to signup and participate in.
		</div>
	</div>
	<div class="flex">
		<div class="font-semibold bg-orange-100 rounded-md p-2 my-1 text-gray-700"><span class="text-green-600 ml-2 mr-2">●</span>Major Racing games featured across the community include the Official F1, Assetto Corsa, Assetto Corsa Competizione etc, as well as other non-racing games, each having a space to interact on our Discord server. We have a dedicated space for members on PS4 and XBOX console platforms to interact with each other and host online races.
		</div>
	</div>

	<div class="my-8">
		<p class="font-semibold mb-2 text-gray-700">Get in touch with us on:</p>
		<a href="https://steamcommunity.com/groups/indianracingcommunity" target="_blank">
			<i style='color:#1f3d7a;' class='fab fa-steam text-3xl '></i> 
		</a>		
		<a href="https://twitter.com/racing_indian" target="_blank">
			<i class='fab fa-twitter text-blue-500 text-3xl mx-2'></i> 
		</a>
		<a href="https://www.youtube.com/channel/UC2Li3g3zak9gQ6YtE3YThXw" target="_blank">
			<i style='color:red;' class='fab fa-youtube text-3xl'></i>
		</a>	
		 <a href="https://www.instagram.com/indianracingcommunity/" target="_blank">
            <i class="fab fa-instagram mx-2 text-pink-800 text-3xl"></i>
        </a>
	</div>
	<a href="https://discord.gg/dWG2bX6">
		<img class="rounded mt-3" style="position: absolute;" src="https://discord.com/api/guilds/533143665921622017/widget.png?style=banner1">
	</a>
</div>


@endsection
