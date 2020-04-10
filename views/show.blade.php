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
                                       placeholder="{{trans('laravel-easy-faq::faq.placeholder_search')}}" value="{{ $query }}" required />
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
    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4">{{ $faq->question }}</h1>
                </div>
                <!--end of col-->
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <!--end of section-->
    <section class="space-sm">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-8 col-lg-7">
                    <article id="faq-container">
                        {!! $faq->answer !!}
                    </article>
                    <hr>
                    <h5 class="mb-4">{{ trans('laravel-easy-faq::faq.header_likes') }}</h5>
                    <form class="d-flex justify-content-between">
                        <div id="app" data-type="faq">
                            <faq-like-button :likes="{{ $faq->likes }}" id="{{ $faq->id }}"></faq-like-button>
                            <faq-like-button :likes="{{ $faq->dislikes }}" id="{{ $faq->id }}" type="dislike"></faq-like-button>
                        </div>
                        <div>
                            <a href="{{ route('contactus.create') }}" class="btn btn-outline-primary">{{ trans('laravel-easy-faq::faq.contact_support') }}</a>
                        </div>
                    </form>
                </div>
                <!--end of col-->
                <div class="col-12 col-md-4">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div><i class="icon-text-document mr-1"></i> {{ trans('laravel-easy-faq::faq.created') }}</div>
                                    <span>{{ $faq->created_at->diffForHumans() }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div><i class="icon-edit mr-1"></i> {{ trans('laravel-easy-faq::faq.last_updated') }}</div>
                                    <span>{{ $faq->updated_at->diffForHumans() }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <span class="h6">{{trans_choice('laravel-easy-faq::faq.categories', $faq->faq_category_id)}}</span>
                                <span class="badge badge-secondary">{{ $cFaq }}</span>
                            </div>
                            <a href="{{ route('faq.category', ['id' => $faq->faq_category_id, 'slug' => Str::slug(trans_choice('laravel-easy-faq::faq.categories', $faq->faq_category_id))]) }}">{{ trans('laravel-easy-faq::faq.link_view_all') }} &rsaquo;</a>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-spacing-sm">
                                @foreach($aFaq as $oFaq)
                                    <li>
                                        <i class="icon-text-document text-muted mr-1"></i>
                                        <a href="{{ route('faq.show', ['id' => $oFaq->id, 'slug' => Str::slug($oFaq->question)]) }}">{{ $oFaq->question }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--end of card-->
                    <div class="card">
                        <div class="card-header">
                            <span class="h6">{{ trans('laravel-easy-faq::faq.header_categories') }}</span>
                        </div>
                        <div class="list-group list-group-flush">

                            @foreach($faq->getCategories() as $id => $attr)
                            <a class="list-group-item d-flex justify-content-between" href="{{ route('faq.category', ['id' => $id, 'slug' => Str::slug(trans_choice('laravel-easy-faq::faq.categories', $id))]) }}">
                                <div>
                                    <i class="icon-{{ $attr['icon'] }} text-{{ $attr['color'] }} mr-1"></i>
                                    <span>{{ trans_choice('laravel-easy-faq::faq.categories', $id) }}</span>
                                </div>
                                <div>
                                    <i class="icon-chevron-right"></i>
                                </div>
                            </a>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!--end of col-->
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <!--end of section-->
@endsection
