<html>
<head>
    <title>Lead Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
<div class="container">
    <h2>Lead Details</h2>

    <div class="card p-3">
        <p><strong>Name:</strong> {{ $lead->name }}</p>
        <p><strong>Email:</strong> {{ $lead->email }}</p>
        <p><strong>Phone:</strong> {{ $lead->phone ?? 'N/A' }}</p>
        <p><strong>Source:</strong> {{ $lead->source }}</p>
        <p><strong>Status:</strong> 
            <span class="badge bg-info">{{ $lead->status }}</span>
        </p>
        <p><strong>Created At:</strong> {{ $lead->created_at->format('d M Y, h:i A') }}</p>
        <p><strong>Updated At:</strong> {{ $lead->updated_at->format('d M Y, h:i A') }}</p>
    </div>

    <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('leads.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>

</body>
</html>

