<!doctype html>
<html><head><meta charset="utf-8"><title>Ticket #{{ $ticket->id }}</title></head><body>
<h2>Ticket #{{ $ticket->id }}</h2>
<p><strong>Name:</strong> {{ $ticket->customer->name }}</p>
<p><strong>Phone:</strong> {{ $ticket->customer->phone }}</p>
<p><strong>Email:</strong> {{ $ticket->customer->email }}</p>
<p><strong>Subject:</strong> {{ $ticket->subject }}</p>
<p><strong>Body:</strong> {{ $ticket->body }}</p>
<p><strong>Files:</strong></p>
<ul>
@foreach($ticket->getMedia('files') as $file)
  <li><a href="{{ $file->getFullUrl() }}">{{ $file->file_name }}</a></li>
@endforeach
</ul>
<form method="post" action="{{ route('admin.tickets.updateStatus',$ticket->id) }}">
  @csrf
  <select name="status">
    <option value="new" {{ $ticket->status=='new'?'selected':'' }}>new</option>
    <option value="in_progress" {{ $ticket->status=='in_progress'?'selected':'' }}>in_progress</option>
    <option value="processed" {{ $ticket->status=='processed'?'selected':'' }}>processed</option>
  </select>
  <button type="submit">Change</button>
</form>
</body></html>
