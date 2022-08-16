<table>
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Youth ID</th>
			<th>Email</th>
			<th>Total Applications</th>
			<th>Phone</th>
			<th>Prefix</th>
			<th>First Name [EN]</th>
			<th>Middle Name [EN]</th>
			<th>Last Name [EN]</th>
			<th>First Name [AR]</th>
			<th>Middle Name [AR]</th>
			<th>Last Name [AR]</th>
			<th>DOB</th>
			<th>Gender</th>
			<th>Nationality</th>
			<th>Place Of Residence</th>
			<th>Emirate</th>
			<th>Education Level</th>
			<th>Education Level Other</th>
			<th>Field Of Study</th>
			<th>Working Status</th>
			<th>Working Entity</th>
			<th>Nationality ID Num.</th>
			<th>Newsletter Status</th>
			<th>Organization Name</th>
			<th>Organization Brief</th>
			<th>Email Confirmed</th>
			<th>User Role</th>	
			<th>Date Of registration</th>
			</tr>
	</thead>
	<tbody>
		@if( !empty($users) && $users->count() >0 )
			<?php $inc = getPaginationSerial($users); 	?>
			@foreach($users as $user)
				<tr>
					<th>{{ $inc++ }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->user_unique_code }}</td>
					<td>{{ $user->email }}</td>
					<td>{!! $user->getSubmissionAnchor() !!}</td>
					<td>{{ $user->user_phone_number }}</td>
					<td>{{ $user->user_prefix }}</td>
					<td>{{ $user->user_first_name }}</td>
					<td>{{ $user->user_middle_name }}</td>
					<td>{{ $user->user_last_name }}</td>
					<td>{{ $user->user_first_name_ar }}</td>
					<td>{{ $user->user_middle_name_ar }}</td>
					<td>{{ $user->user_last_name_ar }}</td>
					<td>{{ date('d M Y',strtotime($user->user_dob)) }}</td>
					<td>{{ ($user->gender == 'm') ? 'Male' : 'Female' }}</td>
					<td>{{ @$user->userNationality->country_name}}</td>
					<td>{{ $user->place_of_residence }}</td>
					<td>{{ @$user->userEmirate->uae_state_name }}</td>
					<td>{{ @$user->userEducationLevel->el_title }}</td>
					<td>{{ $user->user_education_level_other }}</td>
					<td>{{ $user->user_field_of_study }}</td>
					<td>{{ $user->user_working_status == 1 ? 'Yes' : 'No' }}</td>
					<td>{{ $user->user_working_entity }}</td>
					<td>{{ $user->user_national_id }}</td>
					<td>{{ $user->user_newsletter == 1 ? 'Yes' : 'No' }}</td>
					<td>{{ $user->user_organization_name }}</td>
					<td>{{ $user->user_organization_brief }}</td>
					<td>{{ $user->user_email_confirmed == 1 ? 'Yes' : 'No' }}</td>
					<td>
						@if($user->roles->count())
							@foreach($user->getRoleNames() as $userRole)
								<span class="border-gray badge badge-light">{{ $userRole }}</span>
							@endforeach
						@else 
							NA 
						@endif  
						
					</td>
					<td>{{ date('d M Y',strtotime($user->created_at)) }}</td>
					
				</tr>
			@endforeach
		@else
			<tr>
				<td>No records found!</td>
			</tr>
		@endif
	</tbody>
</table>
