<html>
<head>
    <title>Clients List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
<div class="container">
    <h2>Client Details</h2>

<div class="card mt-4">
    <div class="card-body">
        <h4>{{ $client->name }}</h4>
        <p><strong>Email:</strong> {{ $client->email }}</p>
        <p><strong>Phone:</strong> {{ $client->phone }}</p>

        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
</div>
</body>
</html>    