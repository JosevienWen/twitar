<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\tweets;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class TweetController extends Controller
{
    //function untuk pages detail post dan direturn dengan data dari model tweets dan model comments
    public function tweetpost(Request $request, $id)
    {
        $data = tweets::with('user')->where('id', $id)->get();
        $data1 = comments::with('user')->where('tweet_id', $id)->latest()->get();

        return view('post')->with([
            'data' => $data,
            'data1' => $data1
        ]);
    }

    //function untuk add comment
    public function addcomment($id){
        $data = tweets::with('user')->where('id', $id)->get();
        return view('addcomment')->with([
            'data' => $data
        ]);
    }

    public function postcomment(Request $request){
        $validator = Validator::make($request->all(), [
            'comment'=>'max:250',
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
            $data = new comments;
            $data->comment = $request->input('comment');
            $data->tags = $request->input('tags');
            $data->user_id = $request->input('user_id');
            $data->tweet_id = $request->input('tweet_id');

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
                'success' => 'Data anda berhasil di input'
            ]);
        }
    }

    //function untuk munculkan data di halaman editcomment
    public function editcomment($id)
    {
        $data = comments::find($id);
        return view('editcomment')->with([
            'data' => $data
        ]);
    }

    //function untuk mengupdate comment
    public function updatecomment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment'=>'max:250',
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
            $data = comments::find($id);
            if($data){
                $data->comment = $request->input('comment');
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

    //function untuk menghapus comment
    public function destroycomment($id)
    {
        $data = comments::find($id);
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
