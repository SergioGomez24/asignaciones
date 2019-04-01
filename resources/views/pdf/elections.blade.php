<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/bootstrap.min.css') }}">
    <style type="text/css">
    body{
        font-size: 16px;
        font-family: "Times New Roman";
    }
    </style>

    
  </head>
  <body>
    <h1 class="text-center">Elecciones Curso {{ $course }}</h1>
    <h5 class="text-center">Universidad de Cádiz</h5>
       
    <table class="table table-bordered">
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
            <td>{{$solicitud->name}}</td>
            <td>{{$solicitud->teacher}}</td>
            <td class="text-center">{{$solicitud->cTheory}}</td>
            <td class="text-center">{{$solicitud->cPractice}}</td>
            <td class="text-center">{{$solicitud->cSeminar}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>