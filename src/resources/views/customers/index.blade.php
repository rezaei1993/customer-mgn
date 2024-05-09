<html>
<body>
<header>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            color: #333;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px;
            margin: 30px 0;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            background: #333;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 0;
            font-size: 24px;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            min-width: 50px;
            border-radius: 2px;
            margin-left: 10px;
        }

        .table-title .btn i {
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            margin-top: 2px;
        }

        table.table th,
        table.table td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #b70404; /* typo fixed */
        }

        table.table td i {
            font-size: 19px;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            border-color: #ddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }
    </style>
</header>

<div class="container-fluid p-5">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        @if (session('message'))
            <div class="alert alert-{{ session('alert-type') }}">
                {{ session('message') }}
            </div>
        @endif


        <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Customers</h2>
                </div>
                <div class="col-sm-6">
                    <a href="#addCustomerModal"  class="btn btn-success add-btn-success" data-toggle="modal"> <span>Add New </span></a>

                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Bank Account Number</th>
                <th>Date Of Birth</th>
            </tr>
            </thead>
            <tbody>


            @foreach($customers as $customer)
                <tr>

                    <td> {{ $customer->first_name .' '. $customer->last_name }}</td>
                    <td> {{ $customer->email }}</td>
                    <td> {{ $customer->phone_number }}</td>
                    <td> {{ $customer->bank_account_number }}</td>
                    <td> {{ $customer->date_of_birth }}</td>

                    <td>
                        <a href="/customers/{{$customer->id}}" class="edit edit-btn" > Edit </a>

                        <form action="{{route('customers.destroy', $customer->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" id="delete_{{$customer->id}}" >Delete</button>

                        </form>
                    </td>
                </tr>



            @endforeach


            </tbody>
        </table>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="addCustomerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content add-modal-content">
            <form action="{{route('customers.store')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add Model</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body add-modal-body">

                    <div class="form-group">
                        <label>First Name</label>
                        <input value="{{old('first_name')}}" name="first_name" id="add_first_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input value="{{old('last_name')}}" name="last_name"  id="add_last_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{old('email')}}" type="email" name="email" id="add_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input value="{{old('phone_number')}}" name="phone_number" id="add_phone_number" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Bank Account Number</label>
                        <input value="{{old('bank_account_number')}}" type="text" id="add_bank_account_number" name="bank_account_number"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Date Of Birth</label>
                        <input value="{{old('date_of_birth')}}" type="date" id="add_date_of_birth" name="date_of_birth" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
