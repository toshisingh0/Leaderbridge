<html>
<head>
    <title>Leads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
<div class="container">
    <h2>Edit Lead</h2>

    <form action="{{ route('leads.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Lead Name</label>
            <input type="text" name="name" class="form-control" required value="{{ $lead->name }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required value="{{ $lead->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" value="{{ $lead->phone }}">
        </div>

    <div class="mb-3">
    <label class="form-label">Lead Source</label>
    <select name="source" class="form-control">
        <option value="Website" {{ $lead->source=='Website' ? 'selected' : '' }}>Website</option>
        <option value="Facebook" {{ $lead->source=='Facebook' ? 'selected' : '' }}>Facebook</option>
        <option value="Google Ads" {{ $lead->source=='Google Ads' ? 'selected' : '' }}>Google Ads</option>
        <option value="Referral" {{ $lead->source=='Referral' ? 'selected' : '' }}>Referral</option>
        <option {{ $lead->source=='Campaign'?'selected':'' }}>Campaign</option>
                <option {{ $lead->source=='Linkedin-ads'?'selected':'' }}>Linkedin-ads</option>
        <option value="Other" {{ $lead->source=='Other' ? 'selected' : '' }}>Other</option>
    </select>
    </div>


        <div class="mb-3">
            <label class="form-label">Lead Status</label>
            <select name="status" class="form-control">
                <option {{ $lead->status=='new'?'selected':'' }}>new</option>
                <option {{ $lead->status=='contacted'?'selected':'' }}>contacted</option>
                <option {{ $lead->status=='converted'?'selected':'' }}>converted</option>
                <option {{ $lead->status=='lost'?'selected':'' }}>lost</option>
            </select>
        </div>

    <div class="mb-3">
       <label class="form-label">Follow Up Date</label>
       <input type="datetime-local" name="follow_up_date" class="form-control" 
           value="{{ $lead->follow_up_date }}">
    </div>


        <button class="btn btn-success">Update Lead</button>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>    