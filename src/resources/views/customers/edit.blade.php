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

<div class="container p-5">
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


    <form action="{{route('customers.update', $customer->id)}}" method="post">
        @csrf
        @method('put')

        <h4 class="modal-title">Edit Customer</h4>

        <br>
        <div class="form-group">
            <label>First Name</label>
            <input value="{{$customer->first_name}}" name="first_name" id="edit_first_name"
                   class="form-control">
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input value="{{$customer->last_name}}" name="last_name" id="edit_last_name"
                   class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input value="{{$customer->email}}" type="email" id="edit_email" name="email"
                   class="form-control">
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input value="{{$customer->phone_number}}" name="phone_number" id="edit_phone_number"
                   type="text"
                   class="form-control">
        </div>

        <div class="form-group">
            <label>Bank Account Number</label>
            <input value="{{$customer->bank_account_number}}" type="text"
                   name="bank_account_number" id="edit_bank_account_number" class="form-control">
        </div>

        <div class="form-group">
            <label>Date Of Birth</label>
            <input value="{{$customer->date_of_birth}}" type="date" id="edit_date_of_birth"
                   name="date_of_birth"
                   class="form-control">
        </div>

        <input type="submit" class="btn btn-info" value="Update" id="UpdateCustomer">

    </form>
</div>

</body>
</html>
