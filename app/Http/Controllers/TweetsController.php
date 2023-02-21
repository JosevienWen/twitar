<?php

namespace App\Http\Controllers;

use App\Models\tweets;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TweetsController extends Controller
{
    //function untuk post tweet
    public function posttweets(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tweets'=>'max:250',
            'tags'=>'max:250',
            'media'=>'image|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails())
        {
            return redirect()
                ->route('paddpost')
                ->with([
                'error' => 'Data anda tidak berhasil di input'
            ]);
        } else {
            $data = new tweets;
            $data->tweets = $request->input('tweets');
            $data->tags = $request->input('tags');
            $data->user_id = $request->input('user_id');

            if($request->hasFile('media'))
            {
                $file = $request->file('media');
                $namaFile = time().rand(100,999).".".$file->getClientOriginalExtension();
                $file->move(public_path().'/img', $namaFile);
                $data->media = $namaFile;
            }
            $data->save();

            return redirect()
                ->route('phome')
                ->with([
                'success' => 'Data anda berhasil di input'
            ]);
        }
    }

    //function untuk menampilkan data di editpost
    public function edittweets($id)
    {
        $data = tweets::find($id);
        return view('editpost')->with([
            'data' => $data
        ]);
    }

    //function untuk mengupdate tweets ke dalam database
    public function updatetweets(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tweets'=>'max:250',
            'tags'=>'max:250',
            'media'=>'image|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails())
        {
            return redirect()
                ->route('phome')
                ->with([
                'error' => 'Data anda tidak berhasil di input'
            ]);
        } else {
            $data = tweets::find($id);
            if($data){
                $data->tweets = $request->input('tweets');
                $data->tags = $request->input('tags');

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
                    ->route('phome')
                    ->with([
                    'success' => 'Data anda berhasil di update'
                ]);
            } else {
                return redirect()
                ->route('phome')
                ->with([
                'error' => 'Data anda tidak berhasil di update'
            ]);
            }
        }
    }

    //function untuk menghapus tweets
    public function destroytweets($id)
    {
        $data = Tweets::find($id);
        if($data){
            $path = 'img/'.$data->media;
            if(File::exists($path)){
                File::delete($path);
            }
            
            $data->delete();
            return redirect()
                ->route('phome')
                ->with([
                'success' => 'Data anda berhasil di hapus'
            ]);
        } else {
            return redirect()
                ->route('phome')
                ->with([
                'error' => 'Data anda tidak berhasil di hapus'
            ]);
        }
    }
}
