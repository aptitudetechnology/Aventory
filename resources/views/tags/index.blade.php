<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Tags</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Libre+Barcode+39+Text&display=swap');

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
      text-align: center;
      vertical-align: middle;
    }

    .type {
      text-align: center;
      position: absolute;
      top: 10;
      right: 0;
      transform: rotate(-90deg);
    }

    .barcode {
      font-family: 'Libre Barcode 39 Text', cursive;
      font-size: 50px;
      line-height: 50px;
      text-align: center;
      vertical-align: middle;
      margin-top: -20px;
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

    @foreach ($inventories as $inventory)
    @for($tag = 1; $tag <=$inventory->quantity; $tag ++)
      <tr>
        <td width="30%"></td>
        <td width="30%">
          <div style="position:relative">
            @if($inventory->type == "group")
            <div class="type">Group</div>
            @endif
            <div class="h1 mr-20">
              <b>{{$inventory->product->name}}</b>
              <div class="py-5">
                <span class="mr-20">Zone: {{ $inventory->product->plant->zone }} </span>
                <span class="mr-20">Height: {{ $inventory->product->plant->height }} </span>
                <span>Spread: {{ $inventory->product->plant->spread }}</span>
              </div>

              <div>{{ $team->name }}</div>
            </div>

          </div>



        </td>
        <td width="20%">
          <div class="code">
            <div class="barcode">{{$inventory->id}}</div>
          </div>

        </td>


        <td width="20%">
          <div class="barcode">{{$inventory->id}}</div>
        </td>

      </tr>
      @endfor
      @endforeach
  </table>

</body>

</html>
