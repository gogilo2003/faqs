<?php
namespace Ogilo\Faqs\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\Faqs\Models\Question;
use Ogilo\Faqs\Models\Page;

use Validator;
/**
 *
 */
class HomeController extends Controller
{

	function __construct()
	{
		$this->middleware('guest');
	}

    public function getQuestion($slug,$page_name=null)
	{

		$faq = Question::where('slug','=',$slug)->first();

		// dd($faq);

		$faq = $faq ? $faq : Question::where('slug','=',$slug)->first() ;

		$page = $page_name ? Page::where('name','=',$page_name)->first() : $faq->categories->first()->pages->first();

		$faqs = Question::where('published',1)->where('id','<>',$faq->id)->orderBy('created_at','DESC')->get();

		// $template = file_exists(resource_path('views/web/faq.blade.php')) ? 'web.faq' : (file_exists(resource_path('views/faq.blade.php')) ? 'faq' : 'admin::web.faq');

		return view()->first(['web.faq','faq','faqs::web.faq','admin::web.faq'],compact('faq','page','faqs'));
	}

	public function getQuestions(Request $request)
	{
		// dd($request->all());
		$faqs = Question::where('published',1)->orderBy('created_at','DESC')->get();
		$page = Page::where('name','=','faqs')->first() ? Page::where('name','=','faqs')->first() : $faqs->first()->categories->first()->pages->first();
		return view()->first(['faqs','web.faqs','faqs::web.faqs','admin::web.home'],compact('faqs','page'));
	}
}
