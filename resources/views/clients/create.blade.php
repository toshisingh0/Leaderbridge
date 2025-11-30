<html>
<head>
    <title>Clients List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
<div class="container">
<h2>Add New Client</h2>

<form method="POST" action="{{ route('clients.store') }}" class="mt-4">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Company</label>
        <input type="text" name="company" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Source</label>
        <select name="source" class="form-control">
            <option value="Web">Web</option>
            <option value="Import">Import</option>
            <option value="Manul">Manul</option>
            <option value="Campaign">Campaign</option>
            <option value="Linkedin-ads">Linkedin-ads</option>
            <option value="other">Other</option>

        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control"></textarea>
    </div>


    <button class="btn btn-primary">Save</button>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back</a>
</form>

</div>
</body>
</html>
