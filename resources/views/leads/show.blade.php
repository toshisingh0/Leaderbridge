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
        <p><strong>Follow Up Date:</strong> {{ $lead->follow_up_date->format('d M Y, h:i A') }}</p>
       <form action="{{ route('leads.updateStatus', $lead->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <label for="status">Status:</label>
    <select id="status" name="status">
        @foreach(\App\Models\Lead::getStatuses() as $status)
            <option value="{{ $status }}" {{ $lead->status == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
    <button type="submit">Update Status</button>
</form>
        <p><strong>Created At:</strong> {{ $lead->created_at->format('d M Y, h:i A') }}</p>
        <p><strong>Updated At:</strong> {{ $lead->updated_at->format('d M Y, h:i A') }}</p>
    </div>

    <div class="card p-3 mt-4">
        <h5>Add Follow-Up Reminder</h5>

       <form method="POST" action="/leads/{{ $lead->id }}/follow-up">
            @csrf

            <input type="datetime-local" name="follow_up_at" required>

            <textarea name="note" placeholder="Follow-up note"></textarea>

            <button type="submit">Add Follow-Up</button>
        </form>

    </div>


    <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('leads.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>

</body>
</html>

