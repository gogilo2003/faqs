<?php

namespace Ogilo\Faqs\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\Faqs\Models\Question;

use Validator;

/**
* QuestionController
*/
class QuestionController extends Controller
{

	function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getQuestions(Request $request)
	{
		$faqs = Question::all();
		return view('faqs::admin.index',compact('faqs'));
	}

	public function getAdd()
	{
		return view('faqs::admin.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'question'=>'required|unique:questions,question',
			]);

		if ($validator->fails()) {
			return redirect()->back()
							->withInput()
							->withErrors($validator)
							->with('global-warning','Some fields failed validation');
		}

		$question = new Question;

		$question->slug = str_slug($request->input('question'));
		$question->question = $request->input('question');
		$question->response = $request->input('response');

		$question->save();

		return redirect()
						->route('admin-faqs')
						->with('global-success','Package Category created');
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id'=>'required|integer|exists:questions',
				'question'=>'required|unique:questions,question,'.$request->input('id'),
			]);

		if ($validator->fails()) {
			return redirect()->back()
							->withInput()
							->withErrors($validator)
							->with('global-warning','Some fields failed validation');
		}

		$question = Question::find($request->input('id'));

		$question->question = $request->input('question');
		$question->slug = str_slug($request->input('question'));
		$question->response = $request->input('response');

		$question->save();

		return redirect()
						->route('admin-faqs')
						->with('global-success','Package Category updated');
	}

	public function getEdit(Request $request, $id)
	{
		$faq = Question::findOrFail($id);
		return view('faqs::admin.edit',compact('faq'));
	}

	public function postPublish(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id'=>'required|integer|exists:questions'
			]);

		if ($validator->fails()) {

            return response(['success'=>false,'message'=>'<h4>Some fields failed validation</h4>'.make_html_list($validator->errors()->all())])
                    ->back('Content-Type','application/json');

		}
        $question = Question::find($request->input('id'));
        $question->published = $question->published ? 0 : 1;
		$question->save();

		return response(['success'=>true,'message'=>'Question '.($question->published ? 'published' : 'un-published'),'published'=>$question->published])
				->header('Content-Type','application/json');
	}

	public function postDelete(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id'=>'required|integer|exists:questions'
			]);

		if ($validator->fails()) {

            return response(['success'=>false,'message'=>'<h4>Some fields failed validation</h4>'.make_html_list($validator->errors()->all())])
                    ->header('Content-Type','application/json');

        }

		$question = Question::find($request->input('id'));
		$question->delete();

		return response(['success'=>true,'message'=>'Question deleted'])
				->header('Content-Type','application/json');
	}
}
