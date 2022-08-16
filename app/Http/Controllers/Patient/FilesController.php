<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\UploadedFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\DeclareDeclare;

class FilesController extends Controller
{
    public function index(){
        $files = auth()->user()->uploadedFiles()->orderBy('created_at', 'DESC')->get();
        return view('patient.uploaded-files', ['files' => $files]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'file' => 'file|required',
        ]);

        $data['name'] = $data['file']->getClientOriginalName();
        $data['file'] = Storage::disk('public')->put('/files/'.auth()->user()->id, $data['file']);
        auth()->user()->uploadedFiles()->create($data);

        return redirect()->route('patient.files');
    }

    public function remove(Request $request){
      $data = $request->validate([
        'id' => 'required|numeric'
      ]);

      auth()->user()->uploadedFiles()->where('id', $data['id'])->delete();

      return back();
    }
}
