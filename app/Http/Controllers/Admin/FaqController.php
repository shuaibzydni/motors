<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use Illuminate\Support\Facades\Route;

class FaqController extends Controller
{
    protected $type;

    public function __construct()
    {
        $this->type = Route::current()->parameter('model');
    }

    public function index()
    {
        $faqs = Faq::where('type', $this->type)->paginate(
            config("motorTraders.paginate.perPage")
        );

        $model = $this->type;

        return view("faqs.index", compact("faqs", "model"));
    }

    public function create()
    {
        $model = $this->type;
        return view("faqs.create", compact("model"));
    }

    public function store(FaqRequest $request)
    {
        $request->merge(['type' => $this->type]);
        Faq::create($request->only(['question', 'answer', 'type']));

        return redirect()
            ->route("faqs.index", ['model' => $this->type])
            ->with("success", "Faq created successfully.");
    }

    public function edit($model, $id)
    {
        $faq = Faq::findOrFail($id);

        $model = $this->type;
        return view("faqs.edit", compact("faq", "model"));
    }

    public function update(FaqRequest $request, $model, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->merge(['type' => $this->type]);
        $faq->update($request->only(['question', 'answer', 'type']));

        return redirect()
            ->route("faqs.index", ['model' => $this->type])
            ->with("success", "Faq updated successfully");
    }

    public function destroy($model, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()
            ->route("faqs.index", ['model' => $this->type])
            ->with("success", "Faq deleted successfully");
    }
}
