
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
    <div class="row">
            <h2> <a href="{{ route('dashboard') }}" class="pull-left">Dashboard</a></h2>
        </div>
    <h2>D. The total number of products and the average value of products for each supplier.</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Supplier Name</th> 
                    <th> Total Number Of Products</th>
                    <th>Average Value Of Products</th>
                </tr>
            </thead>
            <tbody>
            @if(count($data)>0)
               @foreach($data as $row)
                <tr>
                    <td>{{ $row->supplier_name}}</td>
                    <td>{{ $row->product_count}}</td>
                    <td>{{ $row->avg_price}}</td>                 
                </tr>
                @endforeach
       @else
           <tr><td colspan="3">No data found</td></tr>
           @endif
            </tbody>
        </table>
        {{ $data->links('pagination::bootstrap-4') }}
    </div>
    <script src=""></script>
</body>

</html>
