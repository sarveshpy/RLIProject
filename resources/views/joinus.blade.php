@extends('layouts.welcomeLayout')
<style>
      body {
         min-height: 100vh;
         background-image:url('https://cdn.dribbble.com/users/1189560/screenshots/5795496/alfa-romeo-f1_4x.png?compress=1&resize=800x600');
         background-size: 950px;
         background-repeat:no-repeat;
         background-position:right bottom;
      }
    </style>
@section('body')
<div class="px-32 py-16">
	<h2 class="text-4xl font-bold text-gray-900 mb-4">Join Us</h2>
	<p class="font-semibold text-2xl text-gray-800 mb-2">Before You Join</p> 
	<div class="flex">
		<div class="font-semibold bg-blue-100 rounded-md p-2 my-1 text-green-800"><span class="text-green-600 ml-2 mr-2">●</span>Permanent Membership of IRC requires you to be an Indian.</div>
	</div>
	<div class="flex">
		<div class="font-semibold bg-blue-100 rounded-md p-2 my-1 text-green-800"><span class="text-green-600 ml-2 mr-2">●</span>Indians residing overseas are also eligible for Permanent Membership.</div>
	</div>
	<div class="my-8">
		<p class="font-semibold mb-2 text-gray-700"><strong>You may now proceed by joining our Discord Server below</p>
		<a href="https://discord.gg/dWG2bX6">
			<img class="rounded mt-3" style="position: absolute;width:16%;" src="https://discord.com/api/guilds/533143665921622017/widget.png?style=banner1">
		</a>	
	</div>
</div>

@endsection
