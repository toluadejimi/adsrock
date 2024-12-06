<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function keyword()
    {
        $pageTitle = 'Manage Keywords';
        $keywords  = Keyword::searchable(['keywords'])->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.keywords.index', compact('keywords', 'pageTitle'));
    }

    public function storeKeyword(Request $request, $id = 0)
    {
        $request->validate([
            'keywords' => 'required',
        ]);
        if ($id) {
            $keyword           = Keyword::findOrFail($id);
            $notification      = 'Keywords updated successfully';
            $keyword->keywords = $request->keywords;
            $keyword->update();
        } else {
            $keyword      = new Keyword();
            $notification = 'Keywords added successfully';
            $text         = str_replace('"', '', json_encode($request->keywords));
            $keywords     = explode("\\r\\n", $text);
            foreach ($keywords as $keyword) {
                Keyword::create([
                    'keywords' => $keyword
                ]);
            }
        }
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function removeKeyword($id)
    {
        Keyword::findOrFail($id)->delete();
        $notify[] = ['success', 'Keyword has been removed'];
        return back()->withNotify($notify);
    }
}
