<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="./css/index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#dataTable').dataTable({
                'searching': false,
                'order': [[0, 'DESC']]
            });
        });
    </script>
</head>
<body>

<div class="container">
    <form method="get" class="d-flex mb-2">
        <input class="form-control" type="text" placeholder="Your Country e.x Poland, poland" name="country">
        <button type="submit" class="btn btn-primary ml-2 font-size-1" id="submitButton">Check</button>
    </form>
    <div class="row">
        <div class="col-12">
            @if($formSubmitted == true)
                @if(!empty($infections))
                    <table id="dataTable" class="table table-strpied">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Confirmed</th>
                            <th>Deaths</th>
                            <th>Recovered</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($infections as $element)
                            <tr>
                                <td> {{  $element['date'] }}</td>
                                <td> Confirmed :  {{  $element['confirmed']  }}</td>
                                <td> Deaths  : {{  $element['deaths']  }}</td>
                                <td> Recovered  : {{  $element['recovered']  }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">Country not found!</div>
                @endif
            @endif
        </div>
    </div>
</div>
</body>
</html>
