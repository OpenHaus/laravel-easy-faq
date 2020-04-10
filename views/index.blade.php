@extends('main')

@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-auto text-center">
                    <h1 class="">{{trans('laravel-easy-faq::faq.subheader_faq')}}</h1>
                    <span class="">{{trans('laravel-easy-faq::faq.header_faq')}}</span>
                </div>
                <!--end of col-->
            </div>
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
                                       placeholder="{{trans('laravel-easy-faq::faq.placeholder_search')}}" required />
                            </div>
                            <!--end of col-->
                            <div class="col-auto">
                                <button class="btn btn-lg btn-success" type="submit">{{trans('laravel-easy-faq::faq.button_search')}}</button>
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
            <div class="row justify-content-center mb-5">
                <div class="col-auto">
                    <h3 class="h4">{{trans('laravel-easy-faq::faq.header_browse_articles')}}</h3>
                </div>
                <!--end of col-->
            </div>
            <!--end of row-->
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <ul class="feature-list feature-list-sm row">

                        @foreach($aCategories as $id => $attr)
                        <li class="col-6 col-md-4">
                            <a class="card text-center" href="{{ route('faq.category', ['id' => $id, 'slug' => Str::slug(trans_choice('laravel-easy-faq::faq.categories', $id))]) }}">
                                <div class="card-body">
                                    <i class="icon-{{ $attr['icon'] }} text-{{ $attr['color'] }} display-4"></i>
                                    <h6 class="">{{ trans_choice('laravel-easy-faq::faq.categories', $id) }}</h6>
                                </div>
                            </a>
                        </li>
                        @endforeach

                    </ul>
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
            <div class="row justify-content-center mb-5">
                <div class="col-auto">
                    <h3 class="h4">{{trans('laravel-easy-faq::faq.header_popular_articles')}}</h3>
                </div>
                <!--end of col-->
            </div>
            <!--end of row-->
            <ul class="feature-list feature-list-sm row">

                @foreach($aFaq as $id => $faqs)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <span class="h6">{{ trans_choice('laravel-easy-faq::faq.categories', $id) }}</span>
                                {{--<span class="badge badge-secondary">3</span>--}}
                            </div>
                            <a href="{{ route('faq.category', ['id' => $id, 'slug' => Str::slug(trans_choice('laravel-easy-faq::faq.categories', $id))]) }}">{{trans('laravel-easy-faq::faq.link_view_all')}} &rsaquo;</a>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-spacing-sm">
                                @foreach($faqs as $faq)
                                <li>
                                    <i class="icon-text-document text-muted mr-1"></i>
                                    <a href="{{ route('faq.show', ['id' => $faq->id, 'slug' => Str::slug($faq->question)]) }}">{{ $faq->question }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--end of card-->
                </div>
                @endforeach
                <!--end of col-->

            </ul>
            <!--end of row-->
            <div class="row justify-content-center text-center section-outro">
                <div class="col-lg-4 col-md-5">
                    <h6>{{ trans('laravel-easy-faq::faq.header_answer_not_found') }}</h6>
                    <p>{{ trans('laravel-easy-faq::faq.questions_welcome') }}</p>
                    <a href="">{{ trans('laravel-easy-faq::faq.contact_support') }} &rsaquo;</a>
                </div>
                <!--end of col-->
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <!--end of section-->
@endsection
