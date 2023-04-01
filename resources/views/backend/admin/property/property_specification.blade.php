@extends('backend.layouts.master')

@section('title','Admin Dashboard - News Category')

@section('breadcrumb')
<div class="row">
    <div class="col-lg-10">
        <h4><strong>Welcome Back, {{ Auth::user()->name ?? 'N/A' }}</strong></h4>
        <p>Lorem ipsum c'iest paris du saint germain.</p>
    </div>
    <div class="col-lg-2">
        <div class="text-right">
        <a href="" data-bs-toggle="modal" data-bs-target="#addCategory" class="btn btn-primary"><i class="fa fa-building"></i> Add New Specification</a>
        </div>
    </div>
</div>
@endsection

@section('content')

 <!-- White Box -->
 <div class="white-box">
    <h5>List Of All Specification</h5>
    {{-- <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
        <select class="form-select shadow-none row border-top">
            <option>View All</option>
            <option>Function 1</option>
            <option>Function 2</option>
            <option>Function 3</option>
        </select>
    </div> --}}
    <br/>
    <!-- Table with the list of all Tenants -->  
    <div id="agents">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Property</th>
                    <th>Specificaton</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($specifications as $specification)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $specification->relationwithPropertySpecification->short_title ?? '' }}</td>
                    <td>{{ $specification->specification ?? '' }}</td>
                    <td>{!! $specification->icon !!}</td>
                    <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#editNews{{ $specification->id }}" class="btn btn-primary">Edit</a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#deleteNews{{ $specification->id }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>

                {{-- news Edit Modal --}}
                @push('modals')
                <div class="modal fade" id="editNews{{ $specification->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"> Property Specification</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('property_specification.update', $specification->id) }}" method="post" class="form-group" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">Property Specification <span class="text-danget">*</span></label>
                                        <select name="property_id" id="" class="form-control">
                                            <option value selected>--select one--</option>
                                            @foreach ($properties as $property)
                                                <option value="{{ $property->id }}" {{ $specification->property_id == $property->id ? 'selected' : '' }}>{{ $property->short_title }}</option>
                                            @endforeach    
                                        </select>  
                                        @error('property_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                    
                                    <div class="form-group">
                                        <label for=""> Specification</label>
                                        <input type="text" value="{{ $specification->specification }}" name="specification" placeholder="" class="form-control">  
                                        @error('specification')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Icon</label>
                                        <input type="text" value="{{ $specification->icon }}" name="icon" placeholder="" class="form-control">
                                        @error('icon')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endpush
                <!-- news Delete Modal -->
                @push('modals')
                <div class="modal fade" id="deleteNews{{ $specification->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="card-body text-center">
                                <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 24 24">
                                <path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"/><circle cx="12" cy="17" r="1" fill="#e62a45"/><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"/></svg></span>
                                <h4 class="h4 mb-0 mt-3">Warning</h4>
                                {{-- @if ($count_sub > 0)
                                    <strong class="card-text text-red">Topics are available in this category, please delete those first</strong>
                                @else --}}
                                    <p class="card-text">Are you sure you want to delete data?</p>
                                    <strong class="card-text text-danger">Once deleted, you will not be able to recover this data!</strong>
                                {{-- @endif --}}
                            </div>
                            <div class="card-footer text-center border-0 pt-0">
                                <div class="row">
                                    <div class="text-center p-3 d-flex justify-content-center">
                                        <a href="javascript:void(0)" class="btn btn-dark me-2" data-bs-dismiss="modal">Cancel</a>
                                        <form action="{{ route('property_specification.destroy', $specification->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endpush
                @endforeach
                
            </tbody>
        </table> 
    </div>
</div>
<!-- End of white box -->

@push('modals')
    <!-- News Add Modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Property Specification</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('property_specification.store') }}" method="post" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for=""> Property </label>
                            <select name="property_id" id="" class="form-control">
                                <option value selected>--select one--</option>
                                @foreach ($properties as $property)
                                    <option value="{{ $property->id }}">{{ $property->short_title }}</option>
                                @endforeach    
                            </select>  
                            @error('property_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label for="">Specification</label>
                            <input type="text"  name="specification" placeholder="specification" class="form-control">  
                            @error('specification')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="">Icon</label>
                            <input type="text"  name="icon" placeholder='<i class="fa-sharp fa-light fa-house"></i>' class="form-control">
                            @error('icon')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@endsection

