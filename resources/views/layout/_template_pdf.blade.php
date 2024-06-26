<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <title>
    @if(isset($title)){{$title}}
    @else 'Print to PDF - Quickcount'
    @endif
  </title>

  <style>
  
    .table{
        border: 2px solid black;
      }

      .table thead th {
          border-top: 2px solid black;
          border-left: 2px solid black;
          border-right: 2px solid black;
          border-bottom: 0!important;
      }

      .table tbody td, .table tfoot td {
          border: 1px dashed black;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }
    .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .col-6 {
        flex: 0 0 100%;
        max-width: 50%;
    }
    .col-4 {
        flex: 0 0 100%;
        max-width: 33%;
    }
    .col-3 {
        flex: 0 0 100%;
        max-width: 25%;
    }
    .text-center {
        text-align: center !important;
    }
    .text-right {
        text-align: right !important;
    }
    .p-4 {
      padding: 1.5rem !important;
    }
    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .container {
        width: 95%;
        padding-right: 10px;
        padding-left: 10px;
        margin-right: auto;
        margin-left: auto;
    }

    .no-border{
        border: none!important;
    }
    .no-border td{
        border: none!important;
    }
    .mb-4{
        margin-bottom: 12px;
    }

    h4, h5{
        margin-bottom:0!important;
        margin-block-start: 0!important;
    }

    .table thead th {
        border-bottom: 2px solid black!important;
        font-weight: 800!important;
    }
    /* @media (min-width: 1200px){
      .container {
          max-width: 1140px;
      }
    }
    @media (min-width: 992px){
      .container {
          max-width: 960px;
      }
    }
    @media (min-width: 768px){
      .container {
          max-width: 720px;
      }
    }
    @media (min-width: 576px){
      .container {
          max-width: 540px;
      }
    } */
    
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        margin-bottom: 0;
    }
    table {
        border-collapse: collapse;
    }
    
    .table thead th {
        border-top: 0;
        font-weight: 500;
        font-size: 1rem;
        vertical-align: bottom;
        border-bottom: 2px solid #f3f3f3;
    }
    .table th, .table td {
        padding: 0.75rem 0.45rem;
        font-size: 12px!important;
        vertical-align: middle;
        line-height: 1;
    }
    .table th, .table td {
        padding: 0.75rem 0.45rem;
        font-size: 12px!important;
        vertical-align: middle;
        line-height: 1;
    }
    .table td {
        font-size: 0.875rem;
    }
    h5, .h5 {
        font-size: 1.25rem;
    }
    .my-4 {
        margin-bottom: 1.5rem !important;
        margin-top: 1.5rem !important;
    }

    .text-end{
        text-align: right;
    }
  </style>
</head>
<body>

  <div class="container my-4">
  
    <div class="row">
        <div class="col-12 text-center">
            <h5><strong>{{$title}}</strong></h5>
        </div>
    </div>

    @yield('content')

  </div>
  
</body>

</html>

