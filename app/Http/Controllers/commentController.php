<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\commentResource;
use carbon\carbon;
use App\comment;
class commentController extends Controller
{
    //
    public function index(){

        $comments = DB::table('comments')
                    ->orderBy('comment_created_at','desc')
                    ->get();

        return commentResource::collection($comments);
    }

    public function store(Request $request)
    {
        //
        $comment=new comment();
        $comment->comment= $request->comment;
        // $comment->comment_creted_by=Auth;;user()->id;
        $comment->user_comment=$request->user_comment;
        $comment->comment_created_at=carbon::now();
        $comment->save();
        

    }

    public function delete($comment_id){

        comment::destroy($comment_id);
        return 'yes';

    }

    public function update(request $request){
        
        // dd($request->comment_id);
        $comment=DB::table('comments')
                ->where([['comments.comment_id','=',$request->comment_id]])
                ->get();

        foreach($comment as $c){
            $commentid= $c->comment_id;
        }
        
// dd($commentid);
        $comment=comment::find($commentid);
        $comment->user_comment = $request->user_comment;
        $comment->comment = $request->comment;
        $comment->comment_created_at=carbon::now();
        $comment->save();


    }
}
