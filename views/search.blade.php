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
    <section>
        <div class="container">
            <div class="row justify-content-center mb-1">
                <div class="col-auto">
                    <h1 class="h1">{{ trans('faq.search_results') }}</h1>
                </div>
                <!--end of col-->
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <!--end of section-->
    <section class="">
        <div class="container">
            <div class="col-12 col-md-8 col-lg-10">
                <ul class="row list-unstyled">
                    @forelse($aFaq as $faq)
                        <li class="space-xs">
                            <i class="icon-text-document text-muted mr-1"></i>
                            <a href="{{ route('faq.show', ['id' => $faq->id, 'slug' => Str::slug($faq->question)]) }}" class="">{{ $faq->question }}</a>
                            <p>
                                <span class="text-{{ $faq->getCategoryAttributes($faq->faq_category_id)['color'] }}">{{ trans_choice('faq.categories', $faq->faq_category_id) }}</span>
                                {!! Str::limit(strip_tags($faq->answer), $limit = 300, $end = ' ...') !!}
                            </p>
                        </li>
                    @empty
                        <li>
                            {{ trans('faq.search_no_results', ['query' => $query]) }}
                        </li>
                    @endforelse
                </ul>
                <div class="row">
                    {{ $aFaq->appends(['q' => $query])->links() }}
                </div>
            </div>
            <div class="col-12 col-md-4">
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <!--end of section-->
@endsection
