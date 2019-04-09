<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/bootstrap.min.css') }}">
    <style type="text/css">
    body{
        font-size: 14px;
        font-family: "Times New Roman";
    }
    </style>
    
  </head>
  <body>
    <img src="{{ asset('img/logoUCA.png') }}" align="left"  />
    <h6 style="text-align: center; margin-right: 100px;">ESCUELA SUPERIOR DE INGENIERÍA</h6>
    <h6 style="text-align: center; margin-right: 100px;">Grado en Ingeniería Informática</h6>
    <h6 style="text-align: center; margin-right: 100px;">Elecciones Curso {{ $course }}</h6>
       
    <table class="table table-bordered" style="margin-top: 40px;">
      <thead class="thead-light">
        <tr>
          <th scope="col">Asignatura</th>
          <th scope="col">Profesor</th>
          <th scope="col" class="text-center">Créditos Teoría</th>
          <th scope="col" class="text-center">Créditos Prácticas</th>
          <th scope="col" class="text-center">Créditos Seminarios</th>
        </tr>
      </thead>
      <tbody>
        @foreach( $arraySolicitudes as $key => $solicitud )
          <tr>
            <td>{{$solicitud->asig}}</td>
            <td>{{$solicitud->prof}}</td>
            <td class="text-center">{{$solicitud->cTheory}}</td>
            <td class="text-center">{{$solicitud->cPractice}}</td>
            <td class="text-center">{{$solicitud->cSeminar}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>