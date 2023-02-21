<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    //function untuk membuka file editprofile dan direturn data dari user yang mau di edit
    public function editprofile($id)
    {
        $data = users::find($id);
        return view('editprofile')->with([
            'data' => $data
        ]);
    }

    //function untuk mengupdate profile dan diupdate ke database
    public function updateprofile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username'=>'max:20',
            'email'=>'max:50',
            'bio'=>'max:250',
            'media'=>'image|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails())
        {
            return redirect()
                ->route('phome')
                ->with([
                'error' => $validator->messages()
            ]);
        } else {
            $data = Users::find($id);
            if($data){
                $data->username = $request->input('username');
                $data->email = $request->input('email');
                $data->bio = $request->input('bio');

                if($request->hasFile('media'))
                {
                    $path = 'img/'.$data->media;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }

                    $file = $request->file('media');
                    $namaFile = time().rand(100,999).".".$file->getClientOriginalExtension();
                    $file->move(public_path().'/img', $namaFile);
                    $data->media = $namaFile;
                }
                $data->save();
    
                return redirect()
                    ->route('phome');
            } else {
                return redirect()
                ->route('phome')
                ->with([
                'error' => 'Data anda tidak berhasil di update'
            ]);
            }
        }
    }
}
