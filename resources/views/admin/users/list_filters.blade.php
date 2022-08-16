<div id="filterOptions" style="{{empty(Input::get('filterNow')) ? '' : ''}}">
    {{ Form::open(array('name'=>'filter-reg','url'=>Config::get('app.admin_prefix').'/users','method'=>'get' )) }}
        <div class="row">                                            
            <div class="col-md-4 form-group">
                <input type="text" name="name" class="dirChange form-control border {{ !empty(Input::get('name')) ? 'border-green' : '' }}" value="{{Input::get('name')}}" placeholder="Search by Name" /> 
            </div>  
			<div class="col-md-4 form-group">
                <input type="text" name="email" class="dirChange form-control border {{ !empty(Input::get('email')) ? 'border-green' : '' }}" value="{{Input::get('email')}}" placeholder="Search by Email" /> 
            </div>   
            
            <div class="col-md-4 form-group">
                <select name="status" class="border form-control {{ !empty(Input::get('status')) ? 'border-green' : '' }}">
                    <option value="">Search By Status</option>
                    <option value="1" {!! (Input::get('status') ==1 ) ? 'selected="selected"' : '' !!}>Active</option>
                    <option value="2" {!! (Input::get('status') ==2 ) ? 'selected="selected"' : '' !!}>Pending</option>
                </select>
            </div>            
            <input type="hidden" name="sortCol" id="sortCol" value ="" />
            <input type="hidden" name="sortOrd" id="sortOrd" value ="" />
            <div class="clearfix"></div>
            <div class="col-md-4 form-group">
                <input type="submit" name="filterNow" id="filterNow" class=" btn btn-success" value="Search" /> 
                <a href="{{ asset(Config::get('app.admin_prefix').'/users') }}"><input type="button" name="filterNow" class=" btn btn-primary" value="Reset" /></a> 
            </div>
        </div>
    {{ Form::close() }}
    
</div>