@extends('layouts.app')
@section('content')

<div class="container">
<div class="font-semibold text-center text-orange-800 bg-orange-200 rounded-md p-6 profileAlert" style="display: none;">
    <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Welcome to <strong>Indian Racing Comunity!</strong> Please complete your <strong>Profile.</strong>
</div>
@if(SESSION('savedProfile'))
<div class="font-semibold text-center text-green-800 bg-blue-100 rounded-md p-6" >
    <i class="fa fa-check-circle" aria-hidden="true"></i> {{session('savedProfile')}}
    @php Session::forget('savedProfile'); @endphp
</div>
@endif

<style type="text/css">
    .errormsg{
        color: red;
        display: none;
    }
    .disabled{
        background: grey;
    }
</style>
<div class="flex  my-8 ">
    <div class="flex flex-shrink-0">
        <div>
            <img src="{{Auth::user()->avatar}}" class="rounded-md " alt="">
        </div>
        <div class="my-2">
            <div class="flex">
                <div class=" font-semibold text-gray-800 mx-4 text-4xl font-bold">{{Auth::user()->name}}</div>
            </div>
        </div>
    </div>
    <!-- <div class="ml-8 leading-none ">
        <div class="font-semibold text-gray-700 mb-4">
            <i class="fas fa-trophy mr-1"></i> Trophies
        </div>
        <div class="flex flex-wrap">
            <div class=" flex-col text-center mr-2">
                <div class="text-5xl text-indigo-700">👑</div>
                <div class="font-semibold mt-2 p-2 bg-indigo-700 rounded-md text-white">Tier 1</div>
            </div>
            <div class=" flex-col text-center mr-2">
                <div class="text-5xl text-indigo-700">⛔</div>
                <div class="font-semibold mt-2 p-2 bg-red-600 rounded-md text-white">Penalty King</div>
            </div>
            <div class=" flex-col text-center mr-2">
                <div class="text-5xl text-indigo-700">🛺</div>
                <div class="font-semibold mt-2 p-2 bg-blue-600 rounded-md text-white">Season 1</div>
            </div>
            <div class=" flex-col text-center mr-2">
                <div class="text-5xl text-indigo-700">🚜</div>
                <div class="font-semibold mt-2 p-2 bg-blue-600 rounded-md text-white">Season 2</div>
            </div>

        </div>
    </div> -->
</div>
<div class="flex">
    <div>
        <div class="font-semibold text-gray-600 mb-4">
            <i class="far fa-user-circle mr-1"></i> User Details
        </div>
        <table>
            <tr>
                <td class="font-semibold text-gray-600">USERNAME</td>
                <td class=" font-bold text-gray-800 px-4 py-1">{{Auth::user()->name}}</td>
            </tr>
            <tr>
                <td class="font-semibold text-gray-600">EMAIL</td>
                <td class=" font-bold text-gray-800 px-4 py-1">{{Auth::user()->email}}</td>
            </tr>
            <tr>
                <td class="font-semibold text-gray-600">DISCORD</td>
                <td class=" font-bold text-gray-800 px-4 py-1">{{Auth::user()->name}}#{{Auth::user()->discord_discrim}}</td>
            </tr>
        </table>
        <div class="pl-4 bg-gray-800 rounded-md p-4 inline-block my-4">
            <div class="font-semibold text-gray-100 mb-4 border-b border-gray-600 pb-2">
                <i class="fab fa-discord mr-1 text-gray-100"></i> User Roles
            </div>
            <div class="flex w-64 flex-wrap font-semibold text-sm">
                @if(is_array($roles))
                    @for ($i= 0; $i < count($roles) ; $i++)
                        @php
                        $color = str_pad($roles[$i]['color'],6,"0",STR_PAD_LEFT);
                        @endphp
                    <div class="px-1 border rounded-full mr-1 mb-1 border-600 text-gray-300" style="border-color:#{{$color}};"><i class="fas fa-circle mr-1 text-500" style="color:#{{$color}}"></i>{{$roles[$i]['name']}} </div>

                    @endfor
                @else
                    <!-- {{$roles}} -->
                @endif
            </div>
        </div>
        <div class="">
            <form method="POST" action="setsteam/{{Auth::user()->id}}">
                @csrf
                @if (Auth::user()->steam_id == NULL)
                <span class="text-xs font-semibold text-gray-600 mt-1">STEAM PROFILE LINK</span>
                <a href="/login/steam"> <img src="{{url('/img/steam.png')}}" alt=""> </a>
                <span class="text-black-600 mr-2">●</span><span class="text-xs font-semibold text-gray-700 leading-none">To verify your account please Sign in with your Steam account</span>
                @endif
            </form>
        </div>
        </div>

    <div class="border-l mx-4 px-4 w-full">
        <div class="font-semibold text-gray-600 mb-4 px-4">
            <i class="fas fa-edit mr-1"></i> More Details
        </div>
        <form action="/user/profile/save/{{Auth::user()->id}}" method="POST" id="submitProfileForm">
            @csrf
            <div class="flex">
                <div class="w-1/2 flex-grow-0 px-4">
                    <div class="mb-4">
                        <div>
                            <label for="Nationality" class="font-semibold text-gray-800">Are you an Indian?<span class="text-red-600 ml-2">●</span></label>
                        </div>
                        <div>
                            <input type="radio" id="Yes" name="Nationality" class="nationalityOption" value="Yes" @if ("{{Auth::user()->mothertongue}}" != "") checked @endif>
                            <label for="male">Yes</label>
                            <input type="radio" id="No" name="Nationality" class="nationalityOption" value="No">
                            <label for="female">No</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="MotherToungue" class="font-semibold text-gray-800" ">What is your Mother Tongue?<span class="text-red-600 ml-2">●</span></label>
                        </div>
                        <input maxlength="30" type="text" class="border shadow-inner px-2 py-1 mt-1 w-full mandatory rounded border-gray-700" placeholder="Hindi/Bengali/Tamil" name="mothertongue" value="{{Auth::user()->mothertongue}}">
                        <span class="errormsg errormsgMothTon">Please enter your Mother Tongue.</span>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="City" class="font-semibold text-gray-800">City</label>
                        </div>
                        @php
                        if(isset(Auth::user()->location))
                        {
                            $data = Auth::user()->location;
                            $city = preg_replace('/^([^,]*).*$/', '$1', $data);
                            $state =   preg_replace('/^[^,]*,\s*/', '', $data);
                        }
                        else{$city = ""; $state="";}
                        @endphp

                        <input maxlength="30" type="text" name="city" class="border shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700" placeholder="Kolkata" value={{$city}} >
                        <span class="errormsg errormsgCity">Please enter your City.</span>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="State" class="font-semibold text-gray-800">State<span class="text-red-600 ml-2">●</span></label>
                        </div>
                        <input maxlength="30" type="text" name="state" class="border shadow-inner mandatory px-2 py-1 mt-1 w-full rounded border-gray-700" placeholder="West Bengal" value="{{$state}}">
                        <span class="errormsg errormsgState">Please enter your State.</span>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="State" class="font-semibold text-gray-800">Which motorsport do you follow?<span class="text-red-600 ml-2">●</span><i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                        </div>
                        <input maxlength="30" type="text" name="motorsport" class="border mandatory shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700" placeholder="F1" value="{{Auth::user()->motorsport}}">
                        <span class="errormsg errormsgMotersports">Please enter required details.</span>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="State" class="font-semibold text-gray-800">Which driver do you support?<span class="text-red-600 ml-2">●</span><i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                        </div>
                        <input maxlength="30" type="text" name="driversupport" class="border mandatory shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700" placeholder="Lando Norris" value="{{Auth::user()->driversupport}}">
                        <span class="errormsg errormsgDriver">Please enter required details.</span>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="State" class="font-semibold text-gray-800">Where did you hear about IRC?<span class="text-red-600 ml-2">●</span><i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                        </div>
                        <input maxlength="30" type="text" name="source" class="border shadow-inner mandatory px-2 py-1 mt-1 w-full rounded border-gray-700" placeholder="Discord, Youtube, etc." value="{{Auth::user()->source}}">
                        <span class="errormsg errormsgIrc">Please enter required details.</span>
                    </div>
                    <div>
                    <div class="mb-4">
                        <div>
                            <label for="youtube" class="font-semibold text-gray-800"><i class="fab fa-youtube text-red-500 mr-1"></i>Youtube<i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                        </div>
                        <input maxlength="40" type="text" name="youtube" placeholder="https://www.youtube.com/xyz" class="border shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700 youtubeLink" value='@if(isset(Auth::user()->youtube)) {{Auth::user()->youtube}} @endif'>
                        <span class="errormsg">Enter a valid link</span>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="instagram" class="font-semibold text-gray-800"><i class="fab fa-instagram text-indigo-500 mr-1"></i>Instagram<i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                        </div>
                        <input maxlength="40" type="text" name="instagram" placeholder="https://www.instagram.com/xyz" class="border shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700 instaLink" value='@if(isset(Auth::user()->instagram)) {{Auth::user()->instagram}} @endif'>
                        <span class="errormsg">Enter a valid link</span>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="twitch" class="font-semibold text-gray-800"><i class="fab fa-twitch text-purple-700 mr-1"></i>Twitch<i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                        </div>
                        <input maxlength="40" type="text" name="twitch" placeholder="https://www.twitch.com/xyz" class="border shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700 twitchLink" value='@if(isset(Auth::user()->twitch)) {{Auth::user()->twitch}} @endif'>
                        <span class="errormsg">Enter a valid link</span>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="twitter" class="font-semibold text-gray-800"><i class="fab fa-twitter text-blue-500 mr-1"></i>Twitter<i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                        </div>
                        <input maxlength="40" type="text" name="twitter" placeholder="https://www.twitter.com/xyz" class="border shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700 twitterLink" value='@if(isset(Auth::user()->twitter)) {{Auth::user()->twitter}} @endif'>
                        <span class="errormsg">Enter a valid link</span>
                    </div>

                    <div class="mb-4">
                        <div>
                            <label for="psn" class="font-semibold text-gray-800"><i class="fab fa-playstation text-blue-700 mr-1"></i></i>Playstation Network ID<i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                        </div>
                        <input maxlength="40" type="text" name="psn" placeholder="Username" class="border shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700 playstLink" value='@if(isset(Auth::user()->psn)) {{Auth::user()->psn}} @endif'>
                    </div>
                    <div class="mb-4">
                        <div>
                            <label for="xbox" class="font-semibold text-gray-800"><i class="fab fa-xbox mr-1 text-green-500"></i>XBox Network ID<i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                        </div>
                        <input maxlength="40" type="text" name="xbox" placeholder="Username" class="border shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700 xboxLink" value='@if(isset(Auth::user()->xbox)) {{Auth::user()->xbox}} @endif'>
                    </div>
                </div>
                </div>
                <div class="flex-grow-0 w-1/2 px-4">
                        <?php
                          if(isset(Auth::user()->games))
                          {
                              $games = unserialize(Auth::user()->games);
                          }
                          else
                          {
                             $games = NULL;
                          }

                        ?>
                    <div class="mb-4">
                        <input type="checkbox" required id="playgameid" name="playgame" value="playsgame" @if ($games != NULL) checked @endif>
                        <label for="games" class="font-semibold text-gray-800"> I play racing games or am interested in esports.<span class="text-red-600 ml-2">●</span></label>
                    </div>
                    <div id="restfieldsid" style="display : block;">


                        <div class="mb-4">
                            <label for="games" class="font-semibold text-gray-800">Which Games do you Play?<span class="text-red-600 ml-2">●</span><i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                            <div class="flex flex-wrap">
                                @foreach($series as $gameList)
                                <span class="rounded bg-gray-200 px-2 py-1 my-1 mr-2">
                                    <input class="gameList" type="checkbox" id="gameid" name="game[]" value="{{$gameList->code}}" @if($games!=NULL) @if (in_array($gameList->code, $games)) checked @endif @endif>
                                    <label for="games" class="mr-2">{{$gameList->name}}</label>
                                </span>
                                @endforeach
                            </div>
                            <span class="errormsg errormsgGame">Please select atleast 1.</span>

                        </div>
                        <?php
                        if(isset(Auth::user()->platform))
                        {
                           $platform = unserialize(Auth::user()->platform);
                        }
                        else
                        {
                            $platform = NULL;
                        }
                        ?>
                        <div class="mb-4">
                            <label for="games" class="font-semibold text-gray-800">Which platform do you play on?<span class="text-red-600 ml-2">●</span><i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                            <div class="flex flex-wrap">
                                <span class="rounded bg-gray-200 px-2 py-1 my-1 mr-2">
                                    <input class="platformList" type="checkbox" id="vehicle1" name="platform[]" value="PC" @if($platform!=NULL) @if (in_array("PC", $platform)) checked @endif @endif>
                                    <label for="games" class="mr-2">PC</label>
                                </span>
                                <span class="rounded bg-gray-200 px-2 py-1 my-1 mr-2">
                                    <input class="platformList" type="checkbox" id="vehicle1" name="platform[]" value="PlayStation" @if($platform!=NULL) @if (in_array("PlayStation", $platform)) checked @endif @endif>
                                    <label for="games" class="mr-2">PlayStation</label>
                                </span>
                                <span class="rounded bg-gray-200 px-2 py-1 my-1 mr-2">
                                    <input class="platformList" type="checkbox" id="vehicle1" name="platform[]" value="Xbox" @if($platform!=NULL) @if (in_array("Xbox", $platform)) checked @endif @endif>
                                    <label for="games" class="mr-2">XBox</label>
                                </span>
                            </div>
                            <span class="errormsg errormsgPlatform">Please select atleast 1.</span>
                        </div>
                        <div>
                            <label for="games" class="font-semibold text-gray-800">What Controller do you use to play Games?<span class="text-red-600 ml-2">●</span><i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                            <div class="flex flex-wrap">
                                <?php
                                  if(isset(Auth::user()->device))
                                  {
                                      $device = unserialize(Auth::user()->device);
                                  }
                                  else
                                  {
                                      $device = NULL;
                                  }
                                ?>
                                <span class="rounded bg-gray-200 px-2 py-1 my-1 mr-2">
                                    <input class="deviceList" type="checkbox" id="vehicle1" name="device[]" value="Keyboard/Mouse" @if($device!=NULL) @if (in_array("Keyboard/Mouse", $device)) checked @endif @endif>
                                    <label for="games" class="mr-2">Keyboard/Mouse</label>
                                </span>
                                <span class="rounded bg-gray-200 px-2 py-1 my-1 mr-2">
                                    <input class="deviceList" type="checkbox" id="vehicle1" name="device[]" value="Controller" @if($device!=NULL) @if (in_array("Controller", $device)) checked @endif @endif>
                                    <label for="games" class="mr-2">Controller</label>
                                </span>
                                <span class="rounded bg-gray-200 px-2 py-1 my-1 mr-2">
                                    <input class="deviceList" type="checkbox" id="vehicle1" name="device[]" value="Wheel" @if($device!=NULL)  @if (in_array("Wheel", $device)) checked @endif @endif>
                                    <label for="games" class="mr-2">Wheel</label>
                                </span>
                            </div>
                            <span class="errormsg errormsgDevice">Please select atleast 1.</span>
                        </div>
                        <div class="mt-4">
                            <div>
                                <label for="State" class="font-semibold text-gray-800">Device name of controller or wheel<span class="text-red-600 ml-2">●</span><i class="fas fa-globe-americas text-gray-600 ml-2"></i></label>
                            </div>
                            <input maxlength="30" type="text" name="devicename" id="deviceName" class="border shadow-inner px-2 py-1 mt-1 w-full rounded border-gray-700" placeholder="T300, xbox controller, g29, Red Legend, etc." value="{{Auth::user()->devicename}}">
                            <span class="errormsg errormsgDeviceName">Please enter device details.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="font-semibold text-gray-700 mb-4 ml-4">
                    <div>
                        <span class="text-red-600 mr-2">●</span>Mandatory Fields
                    </div>
                    <div>
                        <i class="fas fa-globe-americas text-gray-600 mr-2"></i>Publicly visible fields
                    </div>
                </div>
                <button type="button" id="enabledbuttonid" class="bg-blue-500 rounded ml-4 text-white font-semibold px-8 py-2 hover:bg-blue-800" style="display: block;">Submit</button>
                <span class="errormsg errormsgSubmit">You need to be an Indian to fill this Form.</span>
            </div>
        </form>
    </div>
    </div>
    </div>
</div>
<script>
    var games = <?php echo json_encode($games); ?>;
    var platform = <?php echo json_encode($platform); ?>;
    var device = <?php echo json_encode($device); ?>;
    console.log(games);

    $( document ).ready(function() {
        $('#restfieldsid').hide();

        $('.youtubeLink').change(function(event) {
            $(this).siblings(".errormsg").hide();

            var linkCheck = new RegExp(/^https:\/\/www.youtube.com\/.+/);
            var linkValid = linkCheck.test($(this).val());
            if(linkValid == false){
                $(this).val('');
                $(this).siblings(".errormsg").show('slow/400/fast', function() {});
            }
        });
        $('.instaLink').change(function(event) {
            $(this).siblings(".errormsg").hide();
            var linkCheck = new RegExp(/^https:\/\/www.instagram.com\/.+/);
            var linkValid = linkCheck.test($(this).val());
            if(linkValid == false){
                $(this).val('');
                $(this).siblings(".errormsg").show('slow/400/fast', function() {});
            }
        });
        $('.twitterLink').change(function(event) {
            $(this).siblings(".errormsg").hide();
            var linkCheck = new RegExp(/^https:\/\/www.twitter.com\/.+/);
            var linkValid = linkCheck.test($(this).val());
            if(linkValid == false){
                $(this).val('');
                $(this).siblings(".errormsg").show('slow/400/fast', function() {});
            }
        });
        $('.twitchLink').change(function(event) {
            $(this).siblings(".errormsg").hide();
            var linkCheck = new RegExp(/^https:\/\/www.twitch.com\/.+/);
            var linkValid = linkCheck.test($(this).val());
            if(linkValid == false){
                $(this).val('');
                $(this).siblings(".errormsg").show('slow/400/fast', function() {});
            }
        });

        $('.nationalityOption').change(function(event) {
            $('.errormsgSubmit').hide();
            $('#enabledbuttonid').removeAttr('disabled');
            $('#enabledbuttonid').removeClass('disabled');
            if($('#No').is(':checked')){
                $('.errormsgSubmit').show();
                $('#enabledbuttonid').addClass('disabled');
                $('#enabledbuttonid').attr('disabled', 'disabled');
            }
        });

        $('#playgameid').change(function(event) {
            if( $(this).is(':checked') ){
                $('#restfieldsid').show('slow/400/fast', function() {});
                $('#deviceName').addClass('mandatory');
            }else{
                $('#restfieldsid').hide('slow/400/fast', function() {});
                $('#deviceName').removeClass('mandatory');
            }
        });

        $('.nationalityOption').trigger('change');
        $('#playgameid').trigger('change');

        $('.mandatory').each(function(index, el) {
            if( $(this).val() == '' ){
                $('.profileAlert').show('slow/400/fast', function() {});
            }
        });

        $('#enabledbuttonid').click(function(event) {
            $('.errormsg').hide();
            var dontSubmit = false;
            $('.mandatory').each(function(index, el) {
                if( $(this).val() == '' ){
                    $(this).siblings(".errormsg").show('slow/400/fast', function() {});
                    dontSubmit = true;
                    // return false;
                }
            });
            if(dontSubmit == false){
                if( $('#playgameid').is(':checked') ){
                    var gameList = false;
                    var platformList = false;
                    var deviceList = false;
                    $('.gameList').each(function(index, el) {
                        if($(this).is(':checked')){
                            gameList = true;
                        }
                    });
                    $('.platformList').each(function(index, el) {
                        if($(this).is(':checked')){
                            platformList = true;
                        }
                    });
                    $('.deviceList').each(function(index, el) {
                        if($(this).is(':checked')){
                            deviceList = true;
                        }
                    });
                    setTimeout(function()
                    {
                        if(gameList == false){
                            $('.errormsgGame').show();
                            return false;
                        }
                        if(platformList == false){
                            $('.errormsgPlatform').show();
                            return false;
                        }
                        if(deviceList == false){
                            $('.errormsgDevice').show();
                            return false;
                        }
                        if(gameList == true && platformList == true && deviceList == true){
                            $('#submitProfileForm').submit();
                        }
                    }, 500);
                }else{
                    $('#submitProfileForm').submit();
                }
            }
        });
    });

</script>

@endsection
