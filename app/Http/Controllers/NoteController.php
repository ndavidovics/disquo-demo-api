<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use App\Note;
use Validator;

class NoteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::enableQueryLog();
        $notes = Auth::user()->notes;
        dd(DB::getQueryLog());
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'text' => 'max:1000',
            'title' => 'required|max:50'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input['user_id'] = Auth::user()->id; //attached to logged in User
        $note = Note::create($input);
   
        return $note;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $note = Auth::user()->notes->find($id);
        if ($note) {
            return $note;
        }
        return $this->sendError('Note not found');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $note = Auth::user()->notes->find($id);
        if (!$note) {
            return $this->sendError('Note not found');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'text' => 'max:1000',
            'title' => 'max:50'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if ($input['text']) {$note->text = $input['text'];}
        if ($input['title']) {$note->title = $input['title'];}
        
        $note->save();
        return $note;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $note = Auth::user()->notes()->find($id);
        if (!$note) {
            return $this->sendError('Note not found');
        }

        $note->delete();
        return $this->sendResponse($success, 'Note Deleted successfully.');
    }
}
