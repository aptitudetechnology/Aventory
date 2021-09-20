<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Tags</title>
  <style>
    @page {
      margin: 0px;
    }

    body {
      margin: 0px;
    }

    .details {
      display: flex;
      flex-direction: column;
    }

    .py-5 {
      padding-top: 3px;
      padding-bottom: 3px;
    }

    .mr-20 {
      margin-right: 20px;
    }

    .w-full {
      width: 100%;
    }

    .code {
      margin-left: auto;
      margin-right: auto;
      width: 100px;
      text-align: center;
      vertical-align: middle;
    }

  </style>

</head>

<body>

  <table width="100%" style="width:100%;">
    @foreach ($inventories->chunk(4) as $page)
    @foreach ($page as $inventory)

    <tr height="25%">
      <td width="30%"></td>
      <td width="30%">
        <div class="py-5">
          <b>{{$inventory->product->name}}</b>
          <div class="py-5">
            <span class="mr-20">Zone: {{ $inventory->product->plant->zone }} </span>
            <span class="mr-20">Height: {{ $inventory->product->plant->height }} </span>
            <span>Spread: {{ $inventory->product->plant->spread }}</span>
          </div>

          <div>{{ $team->name }}</div>
        </div>


      </td>
      <td width="20%">
        <div class="code py-5">
          <div class="mx-auto">{!! DNS1D::getBarcodeHTML(strval($inventory->id), 'CODABAR', 2,40) !!}</div>
          <div>{{ $inventory->id }}</div>
        </div>
      </td>


      <td width="20%">
        <div class="code py-5">
          <div>{!! DNS1D::getBarcodeHTML(strval($inventory->id), 'CODABAR', 2,40) !!}</div>
          <div>{{ $inventory->id }}</div>
        </div>
      </td>


    </tr>


    @endforeach

    <div class="page-break"></div>
    @endforeach
  </table>
</body>

</html>
