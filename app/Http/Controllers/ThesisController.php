<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\ProjectFiles;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Session;
use DB;
use Storage;
use Illuminate\Support\Facades\Auth;


class ThesisController extends Controller
{
    public function thesis()
    {
        $files = ProjectFiles::paginate(8);
        $user = Auth::User();
        $file_unique = DB::table('project_files')->distinct()->select('supervisor_name')->get();
        return view('student.thesis',compact('files','user','file_unique'));
    }

    public function thesis_search(Request $request){
                $file_all = ProjectFiles::all();
                $user = Auth::user();
                $technology = $request->input('technology');
                $Supervisor = $request->input('Supervisor');
                $name = $request->input('name');
                $file_unique = DB::table('project_files')->distinct()->select('supervisor_name')->get();
                $files = ProjectFiles::where('required_technology','LIKE',"%$technology%")
                  ->Where('supervisor_name', 'LIKE', "%$Supervisor%")
                  ->Where('name', 'LIKE', "%$name%")
                  ->get();
                return view('student.thesis_search',compact('files','user','file_unique'));
    }

    public function detail($id){
        // $user = Auth::user();
    	$files = ProjectFiles::find($id);
        $filesKey = 'files_' . $files->id;
        if (!Session::has($filesKey)) {
            $files->increment('view_count');
            Session::put($filesKey,1);
        }

       $category = Category::find($id);
       $user = Auth::User();
       // dd($category);

         
    	return view('student.thesis_detail',compact('files','category','user'));
    }



    public function downloadDocFile(Request $request)
    {
        $request->validate([
            'fileId' => 'required|integer'
        ]);

        $res = DB::table('project_files')->select('doc')->where('id', $request->input('fileId'))->get();

        foreach ($res as $key => $value) {
            $fileName = $value->doc;
        }

        $DownloadPath = storage_path('app/public/docs/'.$fileName);

        return response()->download($DownloadPath);


    }
    public function downloadZipFile(Request $request)
    {
        $request->validate([
            'fileId' => 'required|integer'
        ]);

        $res = DB::table('project_files')->select('path')->where('id', $request->input('fileId'))->get();

        foreach ($res as $key => $value) {
            $fileName = $value->path;
        }

        $DownloadPath = storage_path('app/public/uploads/'.$fileName);

        return response()->download($DownloadPath);


    }

    
}
