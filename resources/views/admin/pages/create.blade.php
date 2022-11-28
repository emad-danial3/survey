@extends('admin.layouts.app')
@inject('model', 'App\Models\Page')
@section('page_title')
    {{trans('admin.pageCreate')}}
@endsection
@section('small_title')
    {{trans('admin.pages')}}
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.pageCreate')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\PageController@pageStore'],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}

                        <div class="form-group col-md-6">
                            <label for="name">{{trans('admin.name')}}</label>
                            {!! Form::text('name', null , ['class' => 'form-control', 'required' => 'required','id'=>'main_page_title']) !!}
                        </div>

                        <div class="form-group col-md-3">
                            <label for="date">{{trans('admin.from_date')}}</label>
                            {!! Form::date('date', null , ['class' => 'form-control', 'required' => 'required','id'=>'date']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label for="to_date">{{trans('admin.to_date')}}</label>
                            {!! Form::date('to_date', null , ['class' => 'form-control', 'required' => 'required','id'=>'to_date']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_1_percent">Option {{$question_options['option_1']}}  percent (%)</label>
                            {!! Form::number('option_1_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_1_percent']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_2_percent">Option {{$question_options['option_2']}} percent (%)</label>
                            {!! Form::number('option_2_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_2_percent']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_3_percent"> Option {{$question_options['option_3']}} percent (%)</label>
                            {!! Form::number('option_3_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_3_percent']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_4_percent"> Option {{$question_options['option_4']}} percent (%)</label>
                            {!! Form::number('option_4_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_4_percent']) !!}
                        </div>

<br>
                        <div class="col-md-12" id="LocationsCategories">
                            <h4>
                                <label>Saved Locations Categories</label>
                            </h4>
                            <div id="LocationsCategoriesStore" class="row">

                            </div>
                            <br>
                        </div>


                        <div class="form-group col-md-12" id="questions_container_body">
                          <div  id="">
                              <div class="row">
                                  <div class="col-md-12">
                                      <h4>
                                          <label>Add Locations Categories</label>
                                      </h4>
                                  </div>
                                  <div class="col-md-6 ">
                                      @inject('locations', 'App\Models\Locations')
                                      @if($locations->where('id','>', 0)->where('status', '1')->count() != 0)
                                          <div class="form-group">
                                              <h4>
                                                  <label for="location_id">{{trans('admin.location_id')}} *</label>
                                              </h4>

                                              <select class="form-control select2" id="location_id" required
                                                      name="location_id">
                                                  <option value="0">{{trans('admin.location_id')}}</option>
                                                  @foreach($locations->where('id','>', 0)->where('status', '1')->get() as $location)
                                                      <option
                                                          value="{{$location->id}}">
                                                          <td>{{$location->name}}</td>
                                                      </option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      @endif
                                  </div>
                                  <div class="col-md-6 ">
                                      @inject('categories', 'App\Models\Category')
                                      @if($categories->where('id','>', 0)->where('status', '1')->count() != 0)
                                          <div class="form-group">
                                              <h4>
                                                  <label for="category_id">{{trans('admin.category_id')}} *</label>
                                              </h4>

                                              <select class="form-control select2" id="category_id" required
                                                      name="category_id">
                                                  <option value="0">{{trans('admin.category_id')}}</option>
                                                  @foreach($categories->where('id','>', 0)->where('status', '1')->get() as $category)
                                                      <option
                                                          value="{{$category->id}}">
                                                         {{$category->name}}
                                                      </option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      @endif
                                  </div>

                                  <div class="col-md-12 row" id="questions_users_container">
                                      <div class="col-md-12">
                                          <h4>
                                              <label>Users</label>
                                          </h4>
                                         <div id="questions_users_store" class="row">

                                         </div>
                                      </div>


                                          <div class=" col-md-6">

                                              @inject('users', 'App\User')
                                              @if($users->where('id','>', 0)->where('status', 'active')->where('user_type', 'worker')->count() != 0)
                                                  <div class="form-group col-md-12">
                                                      <label for="user_id">Chose {{trans('admin.user_id')}} </label>
                                                     <div class="row" style="display: flex">
                                                        <div class="col-md-10">
                                                         <select class="form-control " id="selected_user" required
                                                                 name="users">
                                                             <option value="">Chose User</option>
                                                             @foreach($users->where('id','>', 0)->where('status', 'active')->where('user_type', 'worker') ->get() as $user)
                                                                 <option
                                                                     value="{{$user->id}}">
                                                                     {{$user->name}}
                                                                 </option>
                                                             @endforeach
                                                         </select>
                                                        </div>
                                                         <div class="col-md-2">
                                                         <a class="btn btn-info " id="add_uesr" > +  <i class="fa fa-user"></i>  Add  </a>
                                                         </div>
                                                     </div>

                                                  </div>
                                              @endif
                                          </div>

                                  </div>

                              </div>

                          </div>
                            <br>
                            <div class="form-group col-md-12">
                                <a class="btn btn-info" id="add_question" > +  Add Location</a>
                            </div>
                            <br>
                        </div>



                        <div class="form-group">
                            <a href="{{ url('admin/pages') }}" class="btn btn-primary">Finish & {{trans('admin.submit')}} </a>
{{--                            <button class="btn btn-primary" type="submit">Finish & {{trans('admin.submit')}} </button>--}}
                        </div>

                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

@push('js')

    <script>
        $(document).ready(function () {
            var page_id='';
            var question_users=[];
            var base_url = window.location.origin;

            $('.select2').select2();
            $('#LocationsCategories').hide();

            $("#location_id").change(function (){

                let location_id = $("#location_id").val();
                let formData = new FormData();
                    formData.append('location_id',location_id);
                let path = base_url+"/admin/getUsersByLocation";

                if((location_id > 0 )){
                    $("#selected_user").html('');
                    $('#selected_user').append('<option value="">Chose User</option>');
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (response) {
                            if(response.data){
                                if(response.data.length >0){
                                    for (var ind=0;ind <response.data.length ;ind++){
                                        let opj=response.data[ind];
                                        let elm='<option value="'+opj.id+'">'+opj.name+'</option>'
                                        $('#selected_user').append(elm);
                                    }
                                }
                            }
                        },
                        error: function (response) {
                            console.log(response)
                            alert('error');
                        }
                    });
                }
            });

            $("#add_question").click(function (){

                let main_page_title= $("#main_page_title").val();
                let main_page_date= $("#date").val();
                let main_page_to_date= $("#to_date").val();
                let main_page_option_1_percent= $("#option_1_percent").val();
                let main_page_option_2_percent= $("#option_2_percent").val();
                let main_page_option_3_percent= $("#option_3_percent").val();
                let main_page_option_4_percent= $("#option_4_percent").val();
                let location_id = $("#location_id").val();
                let category_id = $("#category_id").val();

                var location_name=$("#location_id option:selected").text();
                var cat_name=$("#category_id option:selected").text();
                let formData = new FormData();
                    formData.append('page_id', page_id);
                    formData.append('main_page_title',main_page_title);
                    formData.append('main_page_date',main_page_date);
                    formData.append('main_page_to_date',main_page_to_date);
                    formData.append('main_page_option_1_percent',main_page_option_1_percent);
                    formData.append('main_page_option_2_percent',main_page_option_2_percent);
                    formData.append('main_page_option_3_percent',main_page_option_3_percent);
                    formData.append('main_page_option_4_percent',main_page_option_4_percent);
                    formData.append('location_id',location_id);
                    formData.append('category_id',category_id);
                    formData.append('question_users',  JSON.stringify(question_users));

                let path = base_url+"/admin/addNewQuestion";

                if((question_users.length ==0 ) || (page_id == '' && main_page_title=='') ){
                    if((page_id == '' && main_page_title=='')){
                        swal({
                            title: 'Oops...',
                            text: 'Should Enter Page Name',
                            type: "warning",
                        })
                    }else {
                        swal({

                            title: 'Oops...',
                            text: 'Should Choice User',
                            type: "warning",
                        })
                    }
                }else {
                //   page_id == '' main this add page first time
                if(page_id==''){
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (response) {
                            if(response.data.id){

                                page_id=response.data.id;
                                $( "#main_page_title" ).prop( "disabled", true );
                                $( "#date" ).prop( "disabled", true );
                                $( "#to_date" ).prop( "disabled", true );
                                $( "#option_1_percent" ).prop( "disabled", true );
                                $( "#option_2_percent" ).prop( "disabled", true );
                                $( "#option_3_percent" ).prop( "disabled", true );
                                $( "#option_4_percent" ).prop( "disabled", true );
                                $("#questions_users_store").text('');

                                $('#LocationsCategories').show();
                                $("#LocationsCategoriesStore").append(
                                    '<div class="col-md-4" style="background: #eee;padding: 5px;border: 1px solid #ddd;border-radius: 5px; "> <label > '+location_name+ ' - '+cat_name+' </label>'+' <\div> \n'
                                );

                                $('#location_id option[value=""]').attr('selected','selected');
                                $('#category_id option[value=""]').attr('selected','selected');
                                swal({
                                    position: 'top-end',
                                    type: "success",
                                    title: 'Your Question has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                               question_users=[];

                            }
                        },
                        error: function (response) {
                            console.log(response)
                            alert('error');
                        }
                    });
                }else {

                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (response) {
                            if(response.data.id){

                                page_id=response.data.id;
                                $( "#main_page_title" ).prop( "disabled", true );
                                $( "#date" ).prop( "disabled", true );
                                $("#questions_users_store").text('');

                                $('#LocationsCategories').show();
                                $("#LocationsCategoriesStore").append(
                                    '<div class="col-md-4" style="background: #eee;padding: 5px;border: 1px solid #ddd;border-radius: 5px; "> <label > '+location_name+ ' - '+cat_name+' </label>'+' <\div> \n'
                                );

                                $('#location_id option[value=""]').attr('selected','selected');
                                $('#category_id option[value=""]').attr('selected','selected');
                                swal({
                                    position: 'top-end',
                                    type: "success",
                                    title: 'Your Question has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                question_users=[];

                            }
                        },
                        error: function (response) {
                            console.log(response)
                            alert('error');
                        }
                    });
                }
                }


            });

            $("#add_uesr").click(function (){
               var newuser=  $("#selected_user").val();
               var newusernem=$("#selected_user option:selected").text();
               var checkuser= question_users.includes(newuser);
               if(newuser > 0 && checkuser ==false){
                   question_users.push(newuser);

                   $("#questions_users_store").append(
                       '<div class="col-md-3" style="background: #eee;padding: 5px;border: 1px solid #ddd;border-radius: 5px; "> <label > '+newusernem+' </label>'+' <\div> \n'
               );

                   $("#selected_user").val('');
               }
            });

            $("#questions_container_body").css('border','1px solid #e7e7e7');
            $("#questions_container_body").css('border-radius','5px');
        });
    </script>
@endpush
