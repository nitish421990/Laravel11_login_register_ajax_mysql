
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
    <h2>C. All products, their category names, supplier names, and their current prices (do not show the ones that do not have a price).</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Supplier Name</th>  
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            @if(count($data)>0)
               @foreach($data as $row)
                <tr>
                    <td>{{ $row->product_name}}</td>
                    <td>{{ $row->category_name}}</td>
                    <td>{{ $row->supplier_name}}</td>
                    <td>{{ $row->price}}</td>                   
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
