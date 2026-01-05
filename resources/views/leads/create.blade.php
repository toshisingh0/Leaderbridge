<html>
<head>
    <title>Leads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
<div class="container">
<h2>Add New Lead</h2>

    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Lead Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Lead Source</label>
            <select name="source" class="form-control">
                <option value="Website">Website</option>
                <option value="Facebook">Facebook</option>
                <option value="Google Ads">Google Ads</option>
                <option value="Referral">Referral</option>
                <option value="Campaign">Campaign</option>
                <option value="Linkedin-ads">Linkedin-ads</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Follow Up Date</label>
            <input type="datetime-local" name="follow_up_date" class="form-control" value="{{ old('follow_up_date') }}">
        </div>

        <button class="btn btn-primary">Save Lead</button>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>