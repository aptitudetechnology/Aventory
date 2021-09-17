<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Tags</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>

  <div class="container mt-4 max-w-lg mx-auto">
    @foreach ($inventories->chunk(4) as $page)
    <div class="mb-20">
      @foreach ($page as $inventory)

      <div class="flex justify-end items-center mb-4">

        <div class="mr-4">{!! DNS1D::getBarcodeHTML(strval($inventory->id), 'CODABAR') !!} <div>{{ $inventory->id }}</div>
        </div>

        <div>{!! DNS1D::getBarcodeHTML(strval($inventory->id), 'CODABAR') !!} <div>{{ $inventory->id }}</div>
        </div>
      </div>
      @endforeach
    </div>
    @endforeach
  </div>
</body>

</html>
