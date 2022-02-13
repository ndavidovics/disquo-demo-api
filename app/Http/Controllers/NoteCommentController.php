<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Note;
use App\NoteComment;
use Validator;
use Illuminate\Validation\Rule;

class NoteCommentController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($note_id)
    {
        return Auth::user()->notes->find($note_id)->comments()->paginate(15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $note_id)
    {
        //
        $input = $request->all();
        $input['note_id'] = $note_id;
        $validator = Validator::make($input, [
            'comment' => 'required|max:1000',
            'note_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $note = Auth::user()->notes()->find($note_id);
        if (!$note) {
            return $this->sendError('Note not found');
        }

        $comment = NoteComment::create($input);
   
        return $comment;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($note_id,$comment_id)
    {
        //
        $comment = Auth::user()->notes->find($note_id)->comments->find($comment_id);
        if ($comment) {
            return $comment;
        }
        return $this->sendError('Comment not found');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $note_id,$comment_id)
    {
        //
        $comment = Auth::user()->notes->find($note_id)->comments->find($comment_id);
        if (!$comment) {
            return $this->sendError('Comment not found');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'comment' => 'max:1000'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if (isset($input['comment'])) {$comment->comment = $input['comment'];}
        
        $comment->save();
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($note_id,$comment_id)
    {
        //
        $comment = Auth::user()->notes->find($note_id)->comments->find($comment_id);
        if (!$comment) {
            return $this->sendError('Note not found');
        }

        $comment->delete();
        return $this->sendResponse(1,'Comment Deleted successfully.');
    }
}
