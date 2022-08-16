@extends('admin.layouts.master')
@section('content')
  @section('bodyClass')
    @parent
        hold-transition skin-blue sidebar-mini
  @stop
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <?php
$moreFilters = '';
foreach (request()->all() as $key => $input) {
	if (empty($moreFilters)) {
		$moreFilters .= $key . '=' . $input;
	} else {
		$moreFilters .= '&' . $key . '=' . $input;
	}
}
?>
                <div class="page-header">
                    <h2 class="pageheader-title">Charter Pledge Registrations
                        <a class="float-sm-right" href="{{ apa('export-registrations/charter-pledge-registrations', true) }}">
                        <button class="btn btn-success btn-flat">Download Excel</button>
                      </a>
                    </h2>
                </div>
            </div>
        </div>

        {{ Form::open(array('name'=>'filter-reg','url' => apa('registrations/charter-pledge-registrations'), 'method'=>'get' )) }}
           <div class="row">
              <div class="col-sm-3 form-group">
                  <label>Filter by Name</label>
                  <input type="text" name="cpr_name" class="form-control border" value="{{request()->get('cpr_name')}}" placeholder="e.g: John Doe" />
              </div>
              <div class="col-sm-3 form-group">
                  <label>Filter by Email Address</label>
                  <input type="text" name="cpr_email_address" class="form-control border" value="{{request()->get('cpr_email_address')}}" placeholder="e.g: example@email.com" />
              </div>
              <div class="col-sm-3 form-group">
                  <label>Filter by Nationality</label>
                  <select name="cpr_nationality" id="cpr_nationality" class="form-control border">
                    <option value="">Select nationality</option>
                    @foreach($countries as $country)
                      <option {{request()->input('cpr_nationality') == $country->getId() ? "selected" : ""}} value="{{$country->getId()}}">{{$country->getName()}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="col-sm-3 form-group">
                  <label>Filter by Age</label>
                  <select name="cpr_age_range" id="cpr_age_range" class="form-control border">
                    <option value="">Select age range</option>
                    <option {{request()->input('cpr_age_range') == "0-16" ? "selected" : ""}} value="0-16">Under 16</option>
                    <option {{request()->input('cpr_age_range') == "16-25" ? "selected" : ""}} value="16-25">16 to 25</option>
                    <option {{request()->input('cpr_age_range') == "26-40" ? "selected" : ""}} value="26-40">26 to 40</option>
                    <option {{request()->input('cpr_age_range') == "40-60" ? "selected" : ""}} value="40-60">40 to 60</option>
                    <option {{request()->input('cpr_age_range') == "60+" ? "selected" : ""}} value="60+">Over 60</option>
                  </select>
              </div>
              <div class="col-sm-3 form-group">
                  <label>Registered From</label>
                  <input type="text" name="from_date" id="from_date" autocomplete="off" class="datepicker form-control border" value="{{request()->input('from_date')}}" placeholder="From date">
              </div>
              <div class="col-sm-3 form-group">
                  <label>Registered To</label>
                  <input type="text" name="to_date" id="to_date" autocomplete="off" class="datepicker form-control border" value="{{request()->input('to_date')}}" placeholder="To date">
              </div>
          </div>
          <div class="row">
              <div class="col-sm-12 form-group">
                  <input type="submit"  class=" btn btn-success"  />
                  <a href="{{ apa('registrations/charter-pledge-registrations') }}"><input type="button" name="filterNow" class=" btn btn-primary" value="Reset" /></a>
              </div>
          </div>
      {{ Form::close()}}

        <div class="row">
			<div class="col-sm-12">
				@include('admin.common.user_message')
			</div>
            <!-- ============================================================== -->
            <!-- striped table -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="col-sm-12 card-header my-table-header">
                        <div class="row align-items-center">
                            <div class="col-sm-6"><h5 class="">{{ $submissionList->total() }} results found.</h5></div>
                            <?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Nationality</th>
                                        <th scope="col">Date Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( !empty($submissionList) && $submissionList->count() >0 )
                                        <?php $inc = getPaginationSerial($submissionList);?>
                                        @foreach($submissionList as $item)
                                            <tr>
                                                <th scope="row">{{ $inc++ }}</th>
                                                <td>{{$item->cpr_name}}</td>
                                                <td>{{$item->cpr_email_address}}</td>
                                                <td>{{!empty($item->cpr_age) ? $item->cpr_age : "N/A"}}</td>
                                                <td>{{!empty($item->getNationality) ? $item->getNationality->getName() : "N/A"}}</td>
                                                <td>{{date('d M Y', strtotime($item->created_at))}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                           <td colspan="10">{{ $submissionList->links() }}</td>
                                        </tr>
                                    @else
                                        <tr class="no-records">
											<td colspan="7" class="text-center text-danger">No records found!</td>
										</tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end striped table -->
            <!-- ============================================================== -->
        </div>



     </div>
@stop
@section('scripts')
@parent
<script>
  $('select').select2({});
  $('.datepicker').datepicker({
        autoclose:true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
    });
</script>
@stop
