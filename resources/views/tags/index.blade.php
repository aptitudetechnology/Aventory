<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Tags</title>
  <style>
    @page {
      margin: 0px;
      padding: 0px;
    }

    * {
      margin: 0;
      padding: 0;
    }


    table {
      table-layout: fixed;
      border: outset 0pt;
      border-spacing: 0pt;
    }

    tbody {
      border-spacing: 0pt;
    }


    tr {
      padding: 0px;
      margin: 0px;
      border: outset 0pt;
    }

    td {
      height: 72pt;
      margin: 0pt;
      border: 0pt;
      vertical-align: middle;
    }

    .mr-20 {
      margin-right: 20px;
    }

    .py-5 {
      padding-top: 5px;
      padding-bottom: 5px
    }

    .code {
      margin-left: auto;
      margin-right: auto;
      width: 100px;
      text-align: center;
      vertical-align: middle;
    }

    .h1 {
      font-size: 10pt;
      vertical-align: middle;
      line-height: normal;
    }

  </style>

</head>

<body>
  <table width="100%" style="width:100%;">

    @foreach ($inventories->chunk(4) as $page)

    @foreach ($page as $inventory)
    <tr>
      <td width="30%"></td>
      <td width="30%">
        <div class="h1">
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
        <div class="code h1">
          <div>{!! DNS1D::getBarcodeHTML(strval($inventory->id), 'CODABAR', 2,40) !!}</div>
          <div>{{ $inventory->id }}</div>
        </div>
      </td>


      <td width="20%">
        <div class="code h1">
          <div>{!! DNS1D::getBarcodeHTML(strval($inventory->id), 'CODABAR', 2,40) !!}</div>
          <div>{{ $inventory->id }}</div>
        </div>
      </td>

    </tr>
    @endforeach


    @endforeach
  </table>

</body>

</html>
