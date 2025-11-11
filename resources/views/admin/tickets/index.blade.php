<!doctype html>
<html><head><meta charset="utf-8"><title>Admin - Tickets</title></head><body>
<h2>Tickets</h2>
<table border="1" cellpadding="6" cellspacing="0">
<tr><th>ID</th><th>Name</th><th>Phone</th><th>Subject</th><th>Status</th><th>Created</th><th>Action</th></tr>
@foreach($tickets as $t)
<tr>
  <td>{{ $t->id }}</td>
  <td>{{ $t->customer->name }}</td>
  <td>{{ $t->customer->phone }}</td>
  <td>{{ $t->subject }}</td>
  <td>{{ $t->status }}</td>
  <td>{{ $t->created_at }}</td>
  <td><a href="{{ route('admin.tickets.show',$t->id) }}">View</a></td>
</tr>
@endforeach
</table>
{{ $tickets->links() }}
</body></html>
