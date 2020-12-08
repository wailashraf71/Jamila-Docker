@extends('layouts.dashboard')

@section('content')
    <a href="{{route('admin.categories.create')}}">
        <button type="button" class="btn btn-primary mb-3 mx-3">اضافة فئة<i
                class="ti-plus mx-1 font-weight-bolder" style="vertical-align: middle"></i></button>
    </a>
    <div class="row" dir="rtl">
        @foreach ($categories as $category)
            <div class="col-md-3">
                <div class="card card-bordered" style="overflow: hidden">
                    <a href="{{ route('admin.categories.show', ['category' => $category->id])}}">
                        <div class="card-block"
                             style="height: 270px;background-image: url({{@Storage::disk('public')->url('app/public/images/categories/'. $category->image)}});background-size: cover;background-position: center;">
                        </div>
                    </a>
                    <div class="p-3 card-body">
                        <div class="col">
                            <div class="col align-self-center">
                                <p class="box-title text-right"
                                   style="color: #313131; font-family: 'Tajawal',sans-serif; font-weight: 700">{{ $category->title}}</p>
                                <div class="card-block">
                                </div>
                            </div>
                            <div class="row" dir="ltr">
                                <a href="#" class="text-danger bg-transparent delete-category" itemid="{{$category->id}}" data-toggle="modal" data-target="#deleteModal" title="delete">
                                    <span>حذف<i class="ti-trash" style="vertical-align: middle;"
                                                aria-hidden="true"></i></span>
                                </a>
                                <a href="{{ route('admin.categories.edit', ['category' => $category->id])}}" class="text-primary bg-transparent px-2" title="edit">
                                    <span>تعديل<i class="ti-pencil" style="vertical-align: middle;"
                                                  aria-hidden="true"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body"></div>
            </div>
        @endforeach

        <!-- Delete Modal -->
            <div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog"
                 aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title px-2" id="mediumModalLabel" style="font-size: 18px"><b>حذف الفئة</b></p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                            <p>
                                حذف هذه الفئة من قاعدة البيانات؟
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-disabled" data-dismiss="modal">رجوع</button>
                            <form id="dynForm" action="{{route('admin.categories.destroy', ['category' => 0])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><p class="text-white">حذف الفئة</p></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.delete-category').click(function () {
                $('#dynForm').attr('action', $(location).attr('href') + '/' + $(this).attr('itemid'));
            });
        });
    </script>
@endsection
