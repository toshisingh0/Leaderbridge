<html>
<head>
    <title>Clients List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
<div class="container">

    <h1 class="mb-4">Clients</h1>

    {{-- 🔍 Search Form --}}
    <form method="GET" class="mb-3 d-flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control"
               placeholder="Search name, email, company">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    {{-- 🟩 Add Client --}}
    <a href="{{ route('clients.create') }}" class="btn btn-success mb-3">Add Client</a>

    {{-- 📥 Import Form --}}
    <form action="{{ route('clients.import') }}" method="POST" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="d-flex gap-2">
            <input type="file" name="file" required class="form-control">
            <button type="submit" class="btn btn-secondary">Import Clients</button>
        </div>
    </form>

    {{-- 📤 Export --}}
    <a href="{{ route('clients.export') }}" class="btn btn-info mb-4 text-white">Export Clients</a>

    {{-- 🧾 Clients Table --}}
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Source</th>
                <th>Notes</th>
                <th>Owner</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($clients as $c)
                <tr>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->company }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->phone }}</td>
                     <td>{{ $c->source }}</td>
                    <td>{{ $c->notes }}</td>
                    <td>{{ optional($c->owner)->name }}</td>

                    <td class="d-flex gap-2">
                        <a href="{{ route('clients.show', $c) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('clients.edit', $c) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('clients.destroy', $c) }}" method="POST"
                              onsubmit="return confirm('Delete this client?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $clients->links() }}
    </div>

    <form action="{{ route('logout') }}" method="POST" class="d-inline">
    @csrf
    <button class="btn btn-danger">Logout</button>
   </form>


</div>
</body>
</html>

