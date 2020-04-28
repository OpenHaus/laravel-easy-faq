<?php

namespace OpenHaus\LaravelEasyFaq\Http\Controllers;

use Illuminate\Support\Facades\DB;
use OpenHaus\LaravelEasyFaq\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SEO;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        SEO::setTitle(trans('faq.title_seo_faq'));

        $aFaq = DB::select(DB::raw('select id, faq_category_id, question, likes FROM ( select id, faq_category_id, question, likes, (@rn:=if(@prev = category_id, @rn +1, 1)) as rownumb, @prev:= faq_category_id FROM ( select id, faq_category_id, question, likes FROM faqs order by faq_category_id ,  likes desc, id ) as sortedlist JOIN (select @prev:=NULL, @rn :=0) as vars ) as groupedlist where rownumb<=3 order by faq_category_id, likes desc, id'));

        $aSorted = [];

        foreach($aFaq as $oFaq) {
            if (!array_key_exists($oFaq->faq_category_id, $aSorted)) {
                $aSorted[$oFaq->faq_category_id] = [];
            }
            $aSorted[$oFaq->faq_category_id][] = $oFaq;
        }

        return view('faq.index', ['aFaq' => $aSorted, 'aCategories' => (new Faq())->getCategories()]);
    }

    public function category($slug, $id)
    {
        SEO::setTitle(trans('faq.title_seo_category', ['name' => trans_choice('faq.categories', $id)]));

        $aFaq = Faq::where('faq_category_id', '=', $id)->orderBy('question', 'asc')->paginate();

        return view('faq.category', ['id' => $id, 'aFaq' => $aFaq]);
    }

    public function search(Request $request)
    {
        SEO::metatags()->addMeta(['robots' => 'noindex']);

        $this->validate($request, [
            'q' => 'required',
        ]);
        $query = $request->get('q');

        SEO::setTitle(trans('faq.title_seo_search', ['query' => $query]));

        $aFaq = Faq::whereRaw("match(question,answer) against (? in boolean mode)", [$query])->paginate();

        return view('faq.search', ['query' => $query, 'aFaq' => $aFaq]);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $faq = Faq::findOrFail($id);
        $aFaq = Faq::where('faq_category_id', '=', $faq->faq_category_id)
            ->where('id', '!=', $faq->id)
            ->orderBy('likes', 'desc')
            ->get();
        $cFaq = $aFaq->count()+1;

        SEO::setTitle($faq->question);

        return view('faq.show', ['faq' => $faq, 'aFaq' => $aFaq->take(5), 'cFaq' => $cFaq]);
    }

    public function like($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->increment('likes');

        return response()->json($faq->likes);
    }

    public function dislike($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->increment('dislikes');

        return response()->json($faq->dislikes);
    }
}
