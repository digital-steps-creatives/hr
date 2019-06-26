<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Award;
use App\Http\Requests\AwardRequest;
use App\User;
use Auth;

class AwardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
		if(Auth::user()->role->role_permission('view_awards')){
			if(Auth::user()->role->role_permission('view_awards')->level == 'all'){
				$awards = Award::paginate(30);
			}elseif(Auth::user()->role->role_permission('view_awards')->level == 'team'){
				$users = User::where('department_id', Auth::user()->department_id)->pluck('id');
				$awards = Award::whereIn('user_id', $users)->paginate(30);
			}else{
				$awards = Award::where('user_id', Auth::user()->id)->paginate(30);
			}
			return view('awards.index', compact('awards'));
		}else{
			abort(403);
		}
    }
	
	public function search(Request $request)
	{
		if(Auth::user()->role->role_permission('view_awards')){
			if(Auth::user()->role->role_permission('view_awards')->level == 'all'){
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->pluck('id');
				$awards = Award::whereIn('user_id', $users)->paginate(30);
			}elseif(Auth::user()->role->role_permission('view_awards')->level == 'team'){
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->where('department_id', Auth::user()->department_id)->pluck('id');
				$awards = Award::whereIn('user_id', $users)->paginate(30);
			}else{
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->where('id', Auth::user()->id)->pluck('id');
				$awards = Award::whereIn('user_id', $users)->paginate(30);
			}
			return view('awards.index', compact('awards'));
		}else{
			abort(403);
		}
	}
    
    public function create()
    {

			return view('awards.create')->with('employees',User::all());

    }
	
    public function store(Request $request)
    {

			Award::create($request->all());
			return redirect('awards')->withSuccess('Award has been saved.');

    }
	
    public function show(Award $award)
    {
		if(Auth::user()->role->role_permission('view_awards')){
			if(Auth::user()->role->role_permission('view_awards')->level == 'team'){
				$users = User::where('department_id', Auth::user()->department_id)->pluck('id');
				$award = Award::where('id', $award->id)->whereIn('user_id', $users)->first();
			}elseif(Auth::user()->role->role_permission('view_awards')->level == 'self'){
				$award = Award::where('id', $award->id)->where('user_id', Auth::user()->id)->first();
			}
			return $award ? $award : abort(403);
		}else{
			abort(403);
		}
    }
	
    public function edit($id)
    {

			return view('awards.edit')->with('award',Award::findOrFail($id))->with('employees',User::all());

    }
	
    public function update(Request $request,$id)
    {

			Award::findOrFail($id)->update($request->all());
			return redirect('awards')->withSuccess($request->award_name.' has been updated.');

    }
	
    public function destroy(Award $award)
    {
		if(Auth::user()->role->role_permission('delete_awards')){
			$award->delete();
			return redirect('awards')->withSuccess($award->award_name.' has been deleted.');
		}else{
			abort(403);
		}
    }
}
