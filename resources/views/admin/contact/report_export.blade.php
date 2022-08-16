<table>
	<thead>
		<tr>
			<th>Sl.No</th>

			<th>Report By</th>                                          

			<th>Message</th>

			<th>Report Data</th>			

			<th>Submitted Date</th>
			
		</tr>
	</thead>
	<tbody>
	    @if( !empty($report) && $report->count() >0 )
			<?php $inc = 1; ?>
			@foreach($report as $item)
					<tr>
						<td>{{$inc++}}</td>
						<td>{{$item->report_by}}</td>
						<td>{{$item->report_message}}</td>
						<td>{{$item->report_data}}</td>
						<td>{{date('d M Y h:i A',strtotime($item->report_created_at))}}</td>					
					</tr>
			@endforeach
	    @endif
	</tbody>
</table>
