<html>
<head>
    <title>Leads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">

              <h3>Today's Follow-Ups</h3>

                @if($todayFollowUps->count())
                    <div style="background:#fff3cd; padding:10px; margin-bottom:15px;">
                        🔔 You have {{ $todayFollowUps->count() }} pending follow-up(s)
                    </div>
                    <a href="/follow-ups">
                        🔔  {{ $todayFollowUps->count() }}
                    </a>




                     
                    @foreach($todayFollowUps as  $followUp)
                        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px">
                            <strong>Lead:</strong> {{  $followUp->lead->name ?? 'N/A' }}<br>

                            <strong>Note:</strong> {{  $followUp->note ?? 'No note' }}<br>

                            <strong>Time:</strong>
                            {{  $followUp->follow_up_at->format('d M Y H:i') }}

                            <form method="POST" action="{{ url('/follow-up/'.$followUp->id.'/done') }}">
                                @csrf
                                @method('PATCH')

                                <button type="submit">Mark Done</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p>🎉 No follow-ups pending</p>
                @endif



        </div>
    </div>

    {{-- Dashboard Widgets --}}
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>Total Leads</h5>
                <h3>{{ \App\Models\Lead::count() }}</h3>

                
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>Pending Follow-Ups</h5>
                <h3>{{ \App\Models\FollowUp::where('is_done', 0)->count() }}</h3>
            </div>
        </div>

        {{-- Add more widgets as needed --}}
    </div>

    {{-- Recent Follow-Up Notifications --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <h5>Recent Follow-Up Reminders</h5>
            <div class="list-group">
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <div class="list-group-item">
                        {{ $notification->data['message'] }}
                        <br>
                        <small class="text-muted">{{ ($notification->data['scheduled_at'])->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>




</body>
</html>
