/*
	|--------------------------------------------------------------------------
    |The first Blade tag, in the login view, tells Laravel 
    |that this view extends the layout view
    |The second tells it what markup to include in 
    |the content section
    |We then use {{ and }} to tell Laravel we want
    | the contained code to be interpreted as PHP.
    |@parent Blade tag to tell Laravel we want the markup we defined 
    |in the default footer to display. We’re not completely changing it, only adding a script tag.
    |The script we included is called polyfill.io.
    |It’s a collection of browser shims which allow things like the placeholder attribute (
*/


@extends("layout")
@section("content")
  {{ Form::open([
    "route"   => "user/login",
    "autocomplete => "off"
) }}
    
    {{ Form::label("username", "Username") }}
    {{ Form::text("username", Input::old("username")[
       "placeholder" => "john.smith"
 ) }}
    {{ Form::label("password", "Password") }}
    {{ Form::password("password", [
        "placeholder" => "xxxxxxxxxxxx"
) }}
@if ($error = $errors->first("password"))
     <div class=error">
     {{ $error }}
     </div>
    @endif
       {{ Form::submit("login") }}
  {{ Form::close() }}
@stop

@section("footer")
  @parent
  <script src="//polyfill.io></script>
@stop
