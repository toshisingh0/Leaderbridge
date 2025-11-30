<html>
<head>
    <title>Clients List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
<div class="container">

<h2>Edit Client</h2>

<form method="POST" action="{{ route('clients.update', $client->id) }}" class="mt-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ $client->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Company</label>
        <input type="text" name="company" value="{{ $client->company }}" class="form-control" required>
    </div>


    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ $client->email }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" value="{{ $client->phone }}" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Source</label>
            <select name="source" class="form-control">
                <option {{ $client->source=='Web'?'selected':'' }}>Web</option>
                <option {{ $client->source=='Import'?'selected':'' }}>Import</option>
                <option {{ $client->source=='Manul'?'selected':'' }}>Manul</option>
                <option {{ $client->source=='Campaign'?'selected':'' }}>Campaign</option>
                <option {{ $client->source=='Linkedin-ads'?'selected':'' }}>Linkedin-ads</option>
                <option {{ $client->source=='Other'?'selected':'' }}>Other</option>
            </select>
        </div>

    <div class="mb-3">
        <label class="form-label">Notes</label>
        <textarea name="text" value="{{ $client->notes }}" class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back</a>
</form>

</div>
</body>
</html>
