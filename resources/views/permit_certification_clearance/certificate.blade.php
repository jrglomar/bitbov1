@extends('global.main')

@section('page-css')
{{-- For table --}}
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />


@endsection

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Permit/Certification/Clearance</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Request</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Certification</a></li>
	</ol>

	<h1 class="page-header">Request Certification<small>DILG Requirements</small></h1>

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">Resident</h4>
		</div>
		<div class="alert alert-yellow fade show">
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			</button>
			The following are the existing records of the residents within the system.
		</div>
		<div class="panel-body">
			<table id="tbl_resident_lst" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th hidden></th>
						<th style="width:20%"><center>Name</center></th>
						<th><center>Address</center></th>
						<th><center>Birthdate</center></th>
						<th><center>Sex</center></th>
						<th><center>Civil Status</center></th>
						<th hidden>fname</th>
						<th hidden>mname</th>
						<th hidden>lname</th>
						<th ><center>Actions</center></th>
						
					</tr>
				</thead>
				<tbody>
					@foreach($resident as $row)
					<tr class="gradeC" id="{{$row->RESIDENT_ID}}">
						<td hidden>{{$row->RESIDENT_ID}}</td>
						<td>{{ $row->RESIDENT_NAME }}</td>
						@if (empty($row->ADDRESS))<td> NA </td>
						@else <td style="text-transform: uppercase;"> {{ $row->ADDRESS }} </td>@endif
						<td id="birthday">{{ $row->AGE }}</td>
						<td>{{ $row->SEX }}</td>
						<td>{{ $row->CIVIL_STATUS }}</td>
						<td hidden>{{ $row->FIRSTNAME }}</td>
						<td hidden>{{ $row->MIDDLENAME }}</td>
						<td hidden>{{ $row->LASTNAME }}</td>
						<td>
							<a id="btnViewForms" class="btn btn-primary m-r-5 m-b-5" data-toggle="modal" data-target="#modal-SelectCertificate" style="color: #fff">
								<i class="fa fa-file-alt" id="btn_request" style="color:#fff">&nbsp;</i>Request Certification</a>	
							</td>
						</tr>
						
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
		<input type="text" id="txt_resident_no"  hidden />	
		<input type="text" id="txt_issuance_type" hidden/>

		{{-- SELECT FORMS --}}
		<div class="modal fade" id="modal-SelectCertificate" data-backdrop="static" >
			<div class="modal-dialog" style="max-width: 70%">
				<div class="modal-content">
					<div class="modal-header"  style="background: #000" id="modalHeader">
						<h4 class="modal-title" style="color: #fff"> Generate Resident Certificate</h4>
						<button type="button" class="close" onclick="hideModal()" aria-hidden="true" style="color: #fff">×</button>
					</div>
					<div class="modal-body">
						<h2 id="lbl_resname" >Resident:</h2>
						<input type="text" id="txt_resid" hidden />
						<div class="col-md-10">
							<label>Select Certificate:</label>
							<select class="form-control" id="sel_certificate_type" style="color: black;" >
								<option selected disabled value=""></option>
								<option value="">Barangay Certificate Residency</option>
								<option value="">Barangay Certificate Calamity Loan SSS-GSIS</option>
								<option value="">Barangay Certificate Calamity Loan OFW</option>
								<option value="">Barangay Certificate SPES</option>
								<option value="BCSP">Barangay Certificate Solo Parent</option>
								<option value="">Barangay Certificate Indigency</option>
								<option value="">Barangay Certificate Travel</option>

							</select>
						</div>
				
						{{-- Travel --}}
						<div class="col-md-10" id="divTravel">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>Purpose</label> 
							<input style="text-transform: uppercase;" name="txt_purpose" list="txt_purpose" class="form-control txt_purpose">
							<datalist  id="txt_purpose"> 
								<option>Funeral of immediate family</option>
								<option>Purchase of supplies for business under essential stores</option>
								<option>Report for work included in the exemption of ECQ/GCQ</option>
								<option>Scheduled check-up</option>
								<option>Pick-up/Drop-off at airport/seaport</option>
								<option>Purchase of medical supplies</option>
								<option>Delivery of essential products (food, medicines, hygiene kit, etc)</option>

							</datalist>
							<br>
							<label>Place of Destination</label> 
							<input class="form-control" id="txt_place_destination"></input>
							<br>
							<label>Destination Address</label> 
							<input class="form-control" id="txt_destination_address"></input>
							<br>
							<label>Date of Travel</label> 
							<input type="date" class="form-control" id="txt_travel_date"></input>
							<br>
							<label>Date of Return</label> 
							<input type="date" class="form-control" id="txt_return_date"></input>
						</div>
						{{-- Residency --}}
						<div class="col-md-10" id="divResidency">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>Purpose</label> 
							<textarea style="text-transform: capitalize;" class="form-control" id="txtarea_purpose_residency"></textarea>
						</div>
						{{-- Loan SSS-GSIS --}}
						<div class="col-md-10" id="divLoanSSSGSIS">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>SSS/GSIS No</label>
							<input type="text" id="txt_sssgsis_no_loansssgsis" class="form-control">
							<br>
							<label>Name of Calamity/Disaster</label>
							<input type="text" id="txt_calamityname_loansssgsis" class="form-control">
							<br>
							<label>Date of Calamity/Disaster</label>
							<input type="date" id="txt_calamitydate_loansssgsis" class="form-control">
						</div>
						{{-- Loan OFW --}}
						<div class="col-md-10" id="divLoanOFW">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>SSS No</label>
							<input type="text" id="txt_sss_loanofw" class="form-control">
							<br>
							<label>Name of Calamity/Disaster</label>
							<input type="text" id="txt_calamityname_loanofw" class="form-control">
							<br>
							<label>Date of Calamity/Disaster</label>
							<input type="date" id="txt_calamitydate_loanofw" class="form-control">
							<br>
							<label>Country</label>
							<input type="text" id="txt_country_loanofw" class="form-control">
						</div>
						{{-- Solo Parent --}}
						<div class="col-md-10" id="divSoloParent">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>Category of Single Parent</label>
							
							<select id="txt_single_parent_category" name="txt_single_parent_category" class="form-control"> 
								<option>A woman who gave birth as a result of rape and other crimes against chastity</option>
								<option>Parent left solo or alone with responsibility of parenthood due to death of spouse</option>
								<option>Parent left solo or alone with responsibility of parenthood while the spouse is detained or is serving sentence for criminal conviction</option>
								<option>Parent left solo or alone with responsibility of parenthood due to physical and/or mental incapacity of spouse</option>
								<option>5 Parent left solo or alone with responsibility of parenthood  due to legal separation or defacto separation from the spouse</option>
								<option>Parent left solo or alone with responsibility of parenthood  due to declaration of 
								'ity or annulment of marriage as decreed by court or by the church</option>
								<option>Parent left solo or alone with responsibility of parenthood  due to abandonment of the spouse</option>
								<option>Unmarried mother/father who has preferred to keep and rear her/his child/children instead others care for them or give them up to a welfare institution</option>
								<option>A person who solely provides parental care and support to a child or children</option>
								<option>A family member who assumes the responsibility of head of a family as a result of the death, abandonment, disapperance or prolonged absence of the parents or solo parent</option>
							</select> 
							<br>
							<label>Requestor name</label>
							<input type="text" id="txt_requester_name" class="form-control">

							<br>
							<label>Child/ren under custody</label>
							<div class="row">
								<div class="col-md-10">
									<p><button type="button" id="btnAddCustody" class="btn btn-primary">Add</button></p>
								</div>
							</div>

							<div id="divChildCustody_1" class="row-control"> Child 1<br>
								<select class="form-control" id="lbl_child_name_1">
									
								</select>
								{{-- <input type="text"  class="form-control" placeholder="Name" id="">
								<br>
								<input type="text"  class="form-control" placeholder="Age" id="">
								<br> --}}
								{{-- <div class="col-md-8" class="form-control">
									<label>Is PWD? &nbsp</label>
                                    	<div class="radio radio-css radio-inline" >
                                            <input type="radio" id="radiobtn_yes_1" name="group1" value="option1" >
											<label for="radiobtn_yes_1">Yes</label>
										</div>
                                    	<div class="radio radio-css radio-inline">
                                            <input type="radio"  id="radiobtn_no_1" name="group1" value="option2" >
                                            <label for="radiobtn_no_1">No</label>
                                        </div>
                                  </div>--}}   
							</div>

							<div id="divChildCustody_2" class="row-control"><legend class="m-t-8"></legend> Child 2<br>
								
								<select class="form-control" id="lbl_child_name_2">
									
								</select>
								{{-- <div class="col-md-8" class="form-control">
									<label>Is PWD? &nbsp</label>
                                    	<div class="radio radio-css radio-inline">
                                            <input type="radio" id="radiobtn_yes_2" value="option1" name="group2">
											<label for="radiobtn_yes_2">Yes</label>
										</div>
                                    	<div class="radio radio-css radio-inline">
                                            <input type="radio"  id="radiobtn_no_2" value="option2" name="group2" >
                                            <label for="radiobtn_no_2">No</label>
                                        </div>
                                    </div> --}}
								<div align="right"><button type="button" class="btn btn-danger btnRemoveCustody2" id="btnRemoveCustody_2" align="right">Remove</button></div>
								<br>
								
							</div>

						</div>

						{{-- Indigency --}}
						<div class="col-md-12" id="divIndigency">
							<legend class="m-t-10"></legend>
							<h5 id="divFilloutInstruction">Fill out the following information:</h5>

							<label>Purpose</label> 
							<textarea style="text-transform: capitalize;" class="form-control" id="txtarea_purpose_indigency"></textarea>

							
						</div>
						
						<div class="col-md-12" id="divHistory">
							<br>
							<div class="alert alert-danger fade show">
								<button type="button" class="close" data-dismiss="alert">
									<span aria-hidden="true">&times;</span>
								</button>
								<center>THE FOLLOWING SHOWS THE LIST OF PEOPLE WHO HAS THE SAME NAME RECORED IN BARANGAY BLOTTER.</center>
							</div>

							<table id="deregatory-table" class="table table-striped table-bordered ">
                            	<thead>
                            	<tr>
                            		<th hidden><center>Blotter ID</center></th>
                            		<th><center>Blotter No.</center></th>
                            		<th><center>Date Filed</center></th>
                                	<th><center>Complainant Name</center></th>
                                	<th><center>Respondent</center></th>
                                	<th><center>Blotter Subject</center></th>
                                	<th><center>Action</center></th>
                            	</tr>
                            	</thead>

                            	<tbody>

                            	</tbody>
                        	</table>


						</div>
						<div class="col-md-12" id="divNoDeregatory">
							<br>
							<div class="alert alert-lime fade show">
								<button type="button" class="close" data-dismiss="alert">
									<span aria-hidden="true">&times;</span>
								</button>
								No Deregatory Record.
							</div>

						</div>

						
						<div id="divApplicantName">
								<br><legend class="m-t-10"></legend>
								<div class="col-md-12" id="divBusinessPermit">
									<label>Applicant's Name</label>
									<input type="text" id="txt_applicant_name" class="form-control">
								</div>
							</div>
						<legend class="m-t-10"></legend>
						<div align="right">
							<a onclick="hideModal()" class="btn btn-white m-r-5" >Close</a>
							<button  id="btnRequest" class="btn btn-inverse m-r-9" style="background: #000">Request</button>
						</div>				

						
						<input type="text" name="count_id" hidden>
					</div>
				</div>
			</div>
		</div>



	</div>
@endsection

@section('page-js')
{{-- Tables --}}
<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
{{--Modals--}}
<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>

<script>
	$(document).ready(function() {
		App.init();
		TableManageDefault.init();
		// $("table[id='tbl_resident_lst']").DataTable();	
		$("table[id='tbl_resident_lst']").DataTable({
			"bSort" : false
		});
		$("table[id='deregatory-table']").DataTable({
			"bSort" : false
		});
		
		$('#divResidency').hide();
		$('#divTravel').hide();
		$('#divLoanSSSGSIS').hide();
		$('#divLoanOFW').hide();
		$('#divSoloParent').hide()
		$('#divIndigency').hide();
		$('#divChildCustody_2').hide();
		$('#divIndividualNonBusiness').hide();
		$('#divValidUntil').hide();
		$('#divMaiden').hide();
		$('#divHistory').hide();
		$('#divNoDeregatory').hide();
	});

	

	//ADD CHILD CUSTODY
	$('#btnAddCustody').on('click', function(){
		$('#divChildCustody_2').show();
	});

	$('#btnRemoveCustody_2').on('click', function(){
		$('#divChildCustody_2').hide();
		$('#lbl_child_name_2').val("");
		$('#lbl_child_age_2').val("");
		$("#radiobtn_yes_2").prop("checked", false);
		$("#radiobtn_no_2").prop("checked", false);
	});
	var civil_status, gender, resident_id;
	//VIEW CERTIFICATE
	$('#deregatory-table').on('click','#btn_confirm', function() {
		let row = $(this).closest("tr")
		,blot_id = $(row.find("td")[0]).text();

		
		swal({
	            title: "Wait!",
	            text: "This person will have deregatory record, continue?",
	            icon: "warning",
	            buttons: true,
	            dangerMode: true,
	        })
            .then((willResolve) => {
                if (willResolve) 
                {
                    swal("Data have been successfully added!", {
                        icon: "success",
                        buttons:false,
                       timer: 600
                    });

                    $.ajax({
						url: "{{route('addDeregatory')}}",
						method: 'post',
						data:{
							blot_id:blot_id
							, resident_id:resident_id
							, _token:"{{csrf_token()}}"
						},
						success:function(response) {
							console.log(response)

						},
						error:function(response) {
							console.log(response)
						},
					});
                } 
                else 
                {
                   swal("Operation Cancelled.", {
                       icon: "error",
                       buttons:false,
                       timer: 600
                   });
               	}
            })
	});

	$('#tbl_resident_lst').on('click', '#btnViewForms', function()
	{

		var table = $("table[id='deregatory-table'] tbody");
		let row = $(this).closest("tr")
		,name = $(row.find("td")[1]).text();
		resident_id = $(row.find("td")[0]).text();
		gender = $(row.find("td")[4]).text();
		civil_status = $(row.find("td")[5]).text();
		firstname = $(row.find("td")[6]).text();
		middlename = $(row.find("td")[7]).text();
		lastname = $(row.find("td")[8]).text();

		$("input[id='txt_resid']").val(row.attr("id"));
		$('#lbl_resname').text(name);
		$('#txt_applicant_name').val(name);
		
		$.ajax({
			url: "{{route('searchDeregatory')}}",
			method:'post',
			data:
			{
				firstname:firstname,
				middlename:middlename,
				lastname:lastname,
				_token:"{{csrf_token()}}"
			},
			success:function(response) {
				
				
				if(!$.trim(response['search_data'])) 
				{
					$('#divNoDeregatory').show();
					$('#divHistory').hide();
				}
				else 
				{
					var i = 0, j = 0; var actions = []; 
					$("table[id='deregatory-table'] tbody tr").remove();
					for (var y=0; y<response['search_data'].length; y++) 
					{

						var return_first = function () 
						{
						    var tmp = null;
						    $.ajax({
						        async: false,
						        type: "POST",
						        'global': false,
						        url:"{{route('checkDeragatory')}}",
						        data:{
									blot_id:response['search_data'][y]['BLOTTER_ID'],
									_token:"{{csrf_token()}}"
								},
						        'success': function (data) {
						            tmp = data['count'];
						        }
						    });
						    return tmp;
						}();
						
						if(parseInt(return_first) > 0)
						{
							actions[j] = '<a class="btn btn-success m-r-5 m-b-5" style="color: #fff; pointer-events:none; cursor:default;" ><i class="fa fa-thumbs-up"  style="color:#fff">&nbsp;</i>Confirmed</a>';	
						} 
						else
						{
							actions[j] = '<a class="btn btn-danger m-r-5 m-b-5 " style="color: #fff" id="btn_confirm"><i class="fa fa-thumbs-up" style="color:#fff">&nbsp;</i>Confirm Deregatory</a>';
						}
					
						
						table.append('<tr >'
								+'<td hidden><center>'+response['search_data'][y]['BLOTTER_ID']+'</center></td>'
								+'<td style="width: 16%;"><center>'+response['search_data'][y]['BLOTTER_CODE']+'</center></td>'
								+'<td style="width: 12%"><center>'+response['search_data'][y]['INCIDENT_DATE']+'</center></td>'
								+'<td style="width: 15%"><center>'+response['search_data'][y]['COMPLAINT_NAME']+'</center></td>'
								+'<td style="width: 15%"><center>'+response['respondents'][i]+'</center></td>'
								+'<td style="width: 12%"><center>'+response['search_data'][y]['BLOTTER_SUBJECT']+'</center></td>'
								+'<td style="width: 12%">'
								+'<center>'
								+ actions[j]
								+'</center></td>'
								+'</tr>');
								i++;
								j++;	
					}

					$('#divHistory').show();
					$('#divNoDeregatory').hide();
				}
				
				
			},
			error:function(response) {

			}
		});

		
		// $.ajax({
		// 	url : "{{ route('getAllRelative') }}",
		// 	method : 'POST',
		// 	data : {
		// 		res_id: resident_id,
		// 		'_token' : " {{ csrf_token() }}"
		// 	},
		// 	success : function(response) {
		// 		$("#lbl_child_name_1").empty()
		// 		$("#lbl_child_name_2").empty()
		// 		$("#lbl_child_name_2").append('<option></option>');
		// 		if(response == 0){
		// 			$("#sel_certificate_type option[value='BCSP']").remove();
		// 		}
		// 		else{
		// 			$("#sel_certificate_type option[value='BCSP']").remove();
		// 			$("#sel_certificate_type").append('<option value="BCSP">Barangay Certificate Solo Parent</option>');
		// 			for(i = 0; i< response.child.length; i++){
		// 				console.log(response.child.length)
		// 				if(response.child.length == 1){
		// 					text = response['child'][i]['RESIDENT_ID'] + '.' + response['child'][i]['DISABILITY']
		// 					$("#lbl_child_name_1").append('<option value='+text+'>'+response['child'][i]['FIRSTNAME']+' '+response['child'][i]['MIDDLENAME']+' '+response['child'][i]['LASTNAME']+'</option>');
		// 					$("#lbl_child_name_2").append('<option value='+text+'>'+response['child'][i]['FIRSTNAME']+' '+response['child'][i]['MIDDLENAME']+' '+response['child'][i]['LASTNAME']+'</option>');
		// 					$("#btnAddCustody").hide()
		// 				}
		// 				else{
		// 					$("#btnAddCustody").show()
		// 					$("#lbl_child_name_1").append('<option value='+text+'>'+response['child'][i]['FIRSTNAME']+' '+response['child'][i]['MIDDLENAME']+' '+response['child'][i]['LASTNAME']+'</option>');
		// 					$("#lbl_child_name_2").append('<option value='+text+'>'+response['child'][i]['FIRSTNAME']+' '+response['child'][i]['MIDDLENAME']+' '+response['child'][i]['LASTNAME']+'</option>');
		// 				}

		// 			}
		// 		}
		// 	},
		// 	error : function(error){
		// 		console.log("error: " + error);
		// 	}
		// });


	});
	//SELECT CERTIFICATE
	$('#sel_certificate_type').on('change', function(){

			var certificate_type = $('#sel_certificate_type option:selected').text();


			if(certificate_type == "Barangay Certificate Residency")
			{
				//show
				$('#divResidency').show();
				//hide
				$('#divValidUntil').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divLoanOFW').hide();
				$('#divSoloParent').hide()
				$('#divIndigency').hide();
				$('#divTravel').hide();
				$('#divMaiden').hide();
				
			}

			else if(certificate_type == "Barangay Certificate Travel"){
				//show
				$('#divTravel').show();
				//hide
				$('#divValidUntil').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divLoanOFW').hide();
				$('#divSoloParent').hide()
				$('#divIndigency').hide();
				$('#divResidency').hide();
				$('#divMaiden').hide();
				
			}

			else if(certificate_type == "Barangay Certificate Calamity Loan SSS-GSIS"){
				//show
				$('#divLoanSSSGSIS').show();
				// hide
				$('#divValidUntil').hide();
				$('#divResidency').hide();
				$('#divLoanOFW').hide();
				$('#divSoloParent').hide()
				$('#divIndigency').hide();
				$('#divTravel').hide();
				$('#divMaiden').hide();
				
			}

			else if(certificate_type == "Barangay Certificate Calamity Loan OFW"){
				//show
				$('#divLoanOFW').show();
				//hide
				$('#divValidUntil').hide();
				$('#divResidency').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divSoloParent').hide()
				$('#divIndigency').hide();
				$('#divTravel').hide();
				$('#divMaiden').hide();
				
			}
			else if(certificate_type == "Barangay Certificate SPES"){
				//show
				$('#divValidUntil').hide();
				$('#divResidency').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divLoanOFW').hide();
				$('#divSoloParent').hide()
				$('#divIndigency').hide();
				$('#divTravel').hide();
				$('#divMaiden').hide();
				
				//hide
			}
			else if(certificate_type == "Barangay Certificate Solo Parent"){
				//hide
				$('#divMaiden').hide();
				$('#divValidUntil').hide();
				$('#divResidency').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divLoanOFW').hide();
				$('#divIndigency').hide();
				$('#divTravel').hide();
				
				//show
				$('#divSoloParent').show()
			}
			else if(certificate_type == "Barangay Certificate Indigency") 
			{
				//show
				$('#divIndigency').show();
				//hide
				$('#divMaiden').hide();
				$('#divResidency').hide();
				$('#divLoanSSSGSIS').hide();
				$('#divLoanOFW').hide();
				$('#divSoloParent').hide()
				$('#divTravel').hide();
				$('#divValidUntil').hide();
				
			}
			
	});

	$('#btnRequest').on('click', function(){

		var certificate_type = $('#sel_certificate_type option:selected').text();
		var form_type = "Request Barangay Certification Form";
		

		var isCheckedYes1 = $('#radiobtn_yes_1:checked').val()?true:false;
		var isCheckedYes2 = $('#radiobtn_yes_2:checked').val()?true:false;
		var isCheckedNo1 = $('#radiobtn_no_1:checked').val()?true:false;
		var isCheckedNo2 = $('#radiobtn_no_2:checked').val()?true:false;
		var is_pwd_1, is_pwd_2;


		if(certificate_type == 'Barangay Certificate Solo Parent')
		{
			solo_parent = $('#lbl_child_name_1').find(":selected").val().split('.')
			solo_id_1 = solo_parent[0]
			solo_pwd_1 = solo_parent[1]
			solo_parent = $('#lbl_child_name_2').find(":selected").val().split('.')
			solo_id_2 = solo_parent[0]
			solo_pwd_2 = solo_parent[1]

			if(solo_pwd_2 == 'null' ) {
				
				solo_pwd_2 = 'No'

			} else if(solo_pwd_1 == 'null' ) {
				
				solo_pwd_1 = 'No'
			}
			else if(solo_id_2 == '') {

				solo_pwd_2 = ''

			}
			else {

				solo_pwd_1 = 'Yes'
				solo_pwd_2 = 'Yes'
			}
		}
		else
		{
			solo_pwd_1 = ''
			solo_pwd_2 = ''
			solo_id_1 = ''
			solo_id_2 = ''

		}
		// alert(form_type+' '+certificate_type);

		let data = {
			'_token' : " {{ csrf_token() }}"
			// residency - A
			,'A_PURPOSE' : $('#txtarea_purpose_residency').val()
			// calamity loan sss-gsis -B
			,'B_SSS_NO' : $("input[id='txt_sssgsis_no_loansssgsis']").val() 
			,'B_CALAMITY_NAME' : $("input[id='txt_calamityname_loansssgsis']").val() 
			,'B_CALAMITY_DATE' : $("input[id='txt_calamitydate_loansssgsis']").val() 
			//calamity loan  ofw - C
			,'C_SSS_NO' : $("input[id='txt_sss_loanofw']").val() 
			,'C_CALAMITY_NAME' : $("input[id='txt_calamityname_loanofw']").val() 
			,'C_CALAMITY_DATE' : $("input[id='txt_calamitydate_loanofw']").val() 
			,'C_COUNTRY' : $("input[id='txt_country_loanofw']").val() 
			//solo parent - E
			,'E_CATEGORY_SINGLE_PARENT' : $('#txt_single_parent_category option:selected').text() 
			,'E_REQUESTOR_NAME' : $("input[id='txt_requester_name']").val() 
			,'E_CHILD_NAME' : solo_id_1

			,'E_IS_PWD' : solo_pwd_1
			,'E_CHILD_NAME_2' : solo_id_2
			,'E_IS_PWD_2' : solo_pwd_2
			//indigency - F
			,'F_PURPOSE' : $('#txtarea_purpose_indigency').val()
			//general 
			,'CERTIFICATE_TYPE' : certificate_type
			,'FORM_TYPE' : form_type
			,'RESIDENT_ID' : $("input[id='txt_resid']").val()
			,'APPLICANT_NAME' : $("input[id='txt_applicant_name']").val()
			// Travel
			,'PLACE_DESTINATION' : $("input[id='txt_place_destination']").val()
			,'DESTINATION_ADDRESS' : $("input[id='txt_destination_address']").val()
			,'TRAVEL_DATE' : $("input[id='txt_travel_date']").val()
			,'RETURN_DATE' : $("input[id='txt_return_date']").val()
			,'PURPOSE' : $("input[name='txt_purpose']").val()
			
		};

	
		$.ajax({
			url : "{{ route('CRUDRequestCertificate') }}",
			method : 'POST',
			data : data,
			success : function(response) {
				swal({
					title: 'Success',
					text: 'Request Done!',
					icon: 'success',
				});
				window.location.reload();
				//console.log(response["message"]);
			},
			error : function(error){
				console.log("error: " + error);
			}
		});	
	});

	function Cancelled(){
		swal({
			title: 'Cancelled',
			text: "Cancelled Generating Certificate",
			icon:'error',
			buttons: false,
			timer: 1000,
		});
	};


	function hideModal(){

		$("#modal-SelectCertificate").modal('hide');
	}

	</script>
	
	@endsection
