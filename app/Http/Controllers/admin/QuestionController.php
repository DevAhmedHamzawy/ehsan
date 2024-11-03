<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Imports\QuestionImport;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $questions = Question::all();

            return DataTables::of($questions)->addIndexColumn()
            ->addColumn('action', function($row){$btn = '<a href="'.route("questions.edit", [$row->id]).'" class="edit btn btn-primary btn-sm">تعديل</a>';return $btn;})
            ->addColumn('actionone', function($row){$btn = '<a href="'.route("questions.delete", [$row->id]).'" class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['action','actionone'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('admin.questions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.add', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }
        $question = Question::create($request->except('_token','answers','right'));
        foreach($request->answers as $key => $value)
        {
            if($request->right == $key+1) { $right = 1; }else{ $right = 0; }
            $question->answers()->create(['name' => $value, 'right' => $right]);
        }
        return redirect()->route('questions.index')->with(['message' => 'تم الإضافة بنجاح', 'alert' => 'alert-success']);  
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(question $question)
    {
        return view('admin.questions.edit', ['question' => $question, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, question $question)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }
        $question->update($request->except('answers','right'));
        $question->answers()->delete();
        foreach($request->answers as $key => $value)
        {
            if($request->right == $key+1) { $right = 1; }else{ $right = 0; }
            $question->answers()->create(['name' => $value, 'right' => $right]);
        }
        return redirect()->route('questions.index')->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);  
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function excel() 
    {
        $excel = Excel::toArray(new QuestionImport,request()->file('file'));
        
        foreach($excel[0] as $record){
            $question = Question::create(['category_id' => $record['category_id'] , 'name' => $record['name']]);

            $answers = $this->strtoarray($record['answers']);

            foreach($answers as $key => $value){
                if($record['right'] == $key+1) { $right = 1; }else{ $right = 0; }

                $question->answers()->create(['name' => $value, 'right' => $right]);
            }
        }
        
        return back()->with(['message' => 'تم إضافة الأسئلة بنجاح', 'alert' => 'alert-success']);;
    }


    private function strtoarray($a, $t = ''){
        $arr = [];
        $a = ltrim($a, '[');
        $a = ltrim($a, 'array(');
        $a = rtrim($a, ']');
        $a = rtrim($a, ')');
        $tmpArr = explode(",", $a);
        foreach ($tmpArr as $v) {
            if($t == 'keys'){
                $tmp = explode("=>", $v);
                $k = $tmp[0]; $nv = $tmp[1];
                $k = trim(trim($k), "'");
                $k = trim(trim($k), '"');
                $nv = trim(trim($nv), "'");
                $nv = trim(trim($nv), '"');
                $arr[$k] = $nv;
            } else {
                $v = trim(trim($v), "'");
                $v = trim(trim($v), '"');
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with(['message' => 'تم الحذف بنجاح', 'alert' => 'alert-success']);
    }
}
