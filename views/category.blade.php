@extends('main')

@section('content')
    <section class="bg-info text-light">
        <div class="container">

            <!--end of row-->
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <form action="{{ route('faq.search') }}" method="get" class="card card-sm">
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="icon-magnifying-glass h4 text-body"></i>
                            </div>
                            <!--end of col-->
                            <div class="col">
                                <input class="form-control form-control-lg form-control-borderless" type="search" name="q"
                                       placeholder="{{trans('faq.placeholder_search')}}" value="{{ $query }}" required />
                            </div>
                            <!--end of col-->
                            <div class="col-auto">
                                <button class="btn btn-lg btn-success" type="submit">{{trans('faq.button_search')}}</button>
                            </div>
                            <!--end of col-->
                        </div>
                    </form>
                </div>
                <!--end of col-->
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <!--end of section-->

    <!--end of section-->
    <section>
        <div class="container">
            <div class="row justify-content-center mb-2">
                <div class="col-auto">
                    <h1 class="h1">{{--<i class="icon-{{ $aFaq[0]->getCategoryAttributes($id)['icon'] }} text-{{ $aFaq[0]->getCategoryAttributes($id)['color'] }} display-4"></i>--}} {{trans_choice('faq.categories', $id)}}</h1>
                    {{--<h2 class="h5">{{ trans('faq.title_seo_category', ['name' => trans_choice('faq.categories', ['id' => $id])]) }}</h2>--}}
                </div>
                <!--end of col-->
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <!--end of section-->
    <section class="flush-with-above">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!--end of row-->
                    <ul class="row list-unstyled">
                        @foreach($aFaq as $faq)
                        <li class="space-xs">
                            <i class="icon-text-document text-muted mr-1"></i>
                            <a href="{{ route('faq.show', ['id' => $faq->id, 'slug' => Str::slug($faq->question)]) }}" class="">{{ $faq->question }}</a>
                            <p>
                                {!! Str::limit(strip_tags($faq->answer), $limit = 300, $end = ' ...') !!}
                            </p>
                        </li>
                        @endforeach
                    </ul>
                    <!--end of row-->

                </div>
            </div>
        </div>
        <!--end of container-->
    </section>
    <!--end of section-->
@endsection
