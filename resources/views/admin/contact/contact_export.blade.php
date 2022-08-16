<table>
	<thead>
		<tr>
			<th>Sl.No</th>

			<th>Name</th>
			
			<th>Email</th> 
			
			<th>Phone Number</th>                                          
			<th>Subject</th>                                          

			<th>Message</th>

			<th>Submitted Date</th>
			
		</tr>
	</thead>
	<tbody>
	    @if( !empty($contact) && $contact->count() >0 )
			<?php $inc = 1; ?>
			@foreach($contact as $item)
					<tr>
						<td>{{$inc++}}</td>
						<td>{{$item->contact_name}}</td>
						<td>{{$item->contact_email}}</td>
						<td>{{$item->contact_phone}}</td>
						<td>{{$item->contact_subject}}</td>
						<td>{{$item->contact_message}}</td>
						<td>{{date('d M Y h:i A',strtotime($item->contact_created_at))}}</td>					
					</tr>
			@endforeach
	    @endif
	</tbody>
</table>
