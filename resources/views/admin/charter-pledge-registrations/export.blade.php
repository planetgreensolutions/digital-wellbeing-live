<table>
	<thead>
		<tr>
			<th>Sl.No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Age</th>
			<th>Nationality</th>
			<th>Dated</th>
		</tr>
	</thead>
	<tbody>
	    @if( !empty($submissionList) && $submissionList->count() >0 )
			<?php $inc = 1;?>
			@foreach($submissionList as $item)
					<tr>
						<td>{{$inc++}}</td>
						<td>{{$item->cpr_name}}</td>
						<td>{{$item->cpr_email_address}}</td>
						<td>{{!empty($item->cpr_age) ? $item->cpr_age : "N/A"}}</td>
						<td>{{!empty($item->getNationality) ? $item->getNationality->getName() : "N/A"}}</td>
						<td>{{date('d M Y',strtotime($item->created_at))}}</td>
					</tr>
			@endforeach
	    @endif
	</tbody>
</table>