<!DOCTYPE html>
<html lang=”en”>
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/css/layout.css" />
    <title>Tutorial</title>
  </head>
  /*
	|--------------------------------------------------------------------------
	| The @include() tags tell Laravel to include the views 
    |(named in those strings; as header and footer) from the views directory.
	|
	*/

  <body>
    @include("header")
    <div class="content">
      <div class="container">
        @yield("content")
      </div>
    </div>
    @include("footer")
  </body>
</html>
