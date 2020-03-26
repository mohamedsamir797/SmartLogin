<html>
<head>

</head>
<body>


      <form action="{{ url('excel') }}" enctype="multipart/form-data" method="post">
         @csrf
          <h1> select the excel file to upload </h1>
          <br> <br>
          <input type="file" name="file">
          <br>
          @error('file')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          <br>
          <button type="submit">Upload</button>
      </form>

          <a href="{{ url('/sample/students.xlsx') }}">download file</a>
</body>
</html>