@extends('layouts.dashboard')

@section('content')
    <a href="{{route('admin.adverts.create')}}">
        <button type="button" class="btn btn-primary mb-3 mx-3">اضافة إعلان<i
                class="ti-plus mx-1 font-weight-bolder" style="vertical-align: middle"></i></button>
    </a>
    <div class="row" dir="rtl">
        @foreach ($adverts as $advert)
            <div class="col-md-6">
                <div class="card card-bordered" style="overflow: hidden">
                    <a href="{{ route('admin.adverts.show', ['advert' => $advert->id])}}">
                        <div class="card-block"
                             style="height: 270px;background-image: url({{@Storage::disk('public')->url('app/public/images/adverts/'. $advert->image)}});background-size: cover;background-position: center;">
                        </div>
                    </a>
                    <div class="p-3 card-body">
                        <div class="col">
                            <div class="col align-self-center">
                                <p class="box-title text-right"
                                   style="color: #313131; font-family: 'Tajawal',sans-serif; font-weight: 700">{{ $advert->title}}</p>
                                <div class="card-block">
                                </div>
                            </div>
                            <div class="row" dir="ltr">
                                <a href="#" class="text-danger bg-transparent delete-advert" itemid="{{$advert->id}}" data-toggle="modal" data-target="#deleteModal" title="delete">
                                    <span>حذف<i class="ti-trash" style="vertical-align: middle;"
                                                aria-hidden="true"></i></span>
                                </a>
                                <a href="{{ route('admin.adverts.edit', ['advert' => $advert->id])}}" class="text-primary bg-transparent px-2" title="edit">
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
                            <form id="dynForm" action="{{route('admin.adverts.destroy', ['advert' => 0])}}" method="post">
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
            $('.delete-advert').click(function () {
                $('#dynForm').attr('action', $(location).attr('href') + '/' + $(this).attr('itemid'));
            });
        });
    </script>
@endsection
