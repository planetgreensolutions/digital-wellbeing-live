<table>
	<thead>
		<tr>
			<th>Sl.No</th>

			<th>Name</th>
			<th>Username</th>
			<th>Title</th>
			<th>Entity</th>
			
			<th>Phone</th>
			<th>Country</th>
			
			<th>Email</th>

			<th>Date</th>
			
		</tr>
	</thead>
	<tbody>
		@if( !empty($registrationList) && $registrationList->count() >0 )
			<?php $inc = 1; 	?>
			@foreach($registrationList as $regList)
				<tr>
					<td>{{  $inc++ }}</td>
					<td>{{ $regList->user_first_name.' ',$regList->user_last_name }}</td>
					<td>{{ $regList->username }}</td>
					<td>{{ $regList->user_title }}</td>
					<td>{{ $regList->user_entity }}</td>
					<td>{{ $regList->user_phone_number }}</td>
					<td>{{ $regList->country_name }}</td>
					<td>{{ $regList->email }}</td>
					<td>{{  date('dS F, Y H:i a',strtotime($regList->created_at)) }}</td>					
				</tr>
			@endforeach
		@else
			<tr>
				<td>No records found!</td>
			</tr>
		@endif
	</tbody>
</table>
